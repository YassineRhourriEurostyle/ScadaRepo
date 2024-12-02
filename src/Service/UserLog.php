<?php

/*
 * Classe de contrôle d'accès :
 * - logué ou non
 * - existe ou non
 * - droit ou non
 */

namespace App\Service;

use App\Entity\Site;
use App\Controller\ApiController;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Ldap\Exception\ConnectionException;
use Symfony\Component\Ldap\Exception\LdapException;
use Symfony\Component\Ldap\Ldap;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use App\Entity\BusinessUnit;

class UserLog {

    const CAPEX_BUDGETING = 'G_CAPEX_BUDGETING';
    const CAPEX_BUYER = 'G_CAPEX_BUYER';
    const CAPEX_IAR = 'G_CAPEX_IAR';
    const CAPEX_PLS = 'G_CAPEX_PLS';
    const CAPEX_REPORTS = 'G_CAPEX_REPORTS';
    const CAPEX_UPLOAD = 'G_CAPEX_UPLOAD';
    const COMEX_PLS = 'G_COMEX_PLS';
    const CUPLAN = 'G_CUPLAN';
    const DEV_ADMIN = 'G_DEV_ADMIN';
    const IT_FULLACCESS = 'G_IT_FULLACCESS';
    const IT_PRIORITY = 'G_IT_PRIORITY';
    const IT_REDACTOR = 'G_IT_REDACTOR';
    const MARKETPLACE = 'G_MARKET';
    const PLS_COMEX = 'G_PLS_COMEX';
    const ZEROPAPER = 'G_ZEROPAPER';
    const TIME_ENTRY = 'G_TIME_SPENTTIME';
    const TIME_REPORT = 'G_TIME_REPORT';
    const TIME_SETTINGS = 'G_TIME_SETTINGS';

    public static $COMEX = array(
        "Cortal, Francois",
        "Deloup, Benoit",
        "Junck, Stefan",
        "Gaumont, Bruno",
        "Leherle, Christophe",
        "Lemasson, Francois-Xavier",
        "Marcault, Yves",
        "Mathorel, Fabrice",
        "Rafidimanantsoa, Michael",
        "Schubert, Markus",
        "Valentin, Isabelle",
        "Michel, Julien",
        "Grimault, Lea",
        "Beugre, Etienne",
    );

    /*
     * Constructeur
     */
    private $session;
    private $em;

    public function __construct(SessionInterface $session, EntityManager $em) {
        $this->session = $session;
        $this->em = $em;
    }

    /*
     * Contrôle d'accès
     */

    public function checkAccess($login = null, $password = null, $site_id = null, $logASFromAdmin = false, $touchScreen = false) {
        /*
         * Test 3: User exists on a site
         */
        $this->session->invalidate();

        $inputLogin = $login;
        if (strpos($login, '/') !== false):
            $site_code = strtolower(explode('/', $login)[0]);
            $login = explode('/', $login)[1];
            $sites = $this->em->getRepository(Site::class)->findBy([], ['Code' => 'DESC']);
        elseif (strpos($login, '\\') !== false):
            $site_code = strtolower(explode('\\', $login)[0]);
            $login = explode('\\', $login)[1];
            $sites = $this->em->getRepository(Site::class)->findBy([], ['Code' => 'DESC']);
        else:
            if ($site_id)
                $sites = $this->em->getRepository(Site::class)->find($site_id);
            else
                $sites = $this->em->getRepository(Site::class)->findBy([], ['Code' => 'DESC']);
        endif;

        $userSite = null;
        $userSiteId = null;
        $userSiteCode = null;
        $userDomainSite = null;
        $userIP = null;
        $userCurrency = null;
        $userDomain = null;


        foreach ($sites as $site):
            if (is_null($site->getLdapIp()))
                continue;

//            if (!$site->ping())
//                continue;
            $userDomain = $site->getLDAPDomain();
            $currentCode = strtolower(substr(explode(',', $userDomain)[0], 3));
            if ($currentCode == 'src')
                $currentCode = 'esy';
            $currentSite = strtolower($site->getCode());
            if (isset($site_code) && $site_code != $currentCode && $site_code != $currentSite)
                continue;

            $ldap = Ldap::create('ext_ldap', ['connection_string' => 'ldap://' . $site->getLdapIp() . ':389']);
            try {
                $ldap->bind($currentCode . '\\' . $currentSite . '.ldap', 'Bonjour01!');

                if ($logASFromAdmin)
                    $query = $ldap->query($userDomain, '(&'
                            . '(name=' . $login . ')'
                            . ')');
                else
                    $query = $ldap->query($userDomain, '(&'
                            . '(sAMAccountName=' . $login . ')'
                            . ')');
                $results = $query->execute();
                unset($ldap);
                if ($results->count()):
                    $userSite = $this->getUserSites($userDomain, $sites);
                    $userSiteCode = $site->getCode();
                    $userSiteId = $site->getId();
                    $userDomainSite = $currentCode;
                    $userIP = $site->getLdapIp();
                    if (method_exists($site, 'getCurrency'))
                        $userCurrency = $site->getCurrency();

                    break;
                endif;
            } catch (LdapException $ex) {
                /*
                 * Bad search filter
                 */
                //echo "Bad search filter. Error details: " . $ex->getMessage() .$currentCode.$currentSite. "\n";
                continue;
            } catch (ConnectionException $ex) {
                /*
                 * User XXX.ldap not created
                 */
                //echo "Connection Exception:Error details: " . $ex->getMessage() .$currentCode.$currentSite."\n";
                continue;
            }

        endforeach;

        if (is_null($userSite)):
            throw new AuthenticationException('User not found (' . $inputLogin . ' // ' . $currentCode . '\\' . $currentSite . '.ldap' . ')');
            return false; //array('route' => 'security_login', 'error' => 'User not found');
        endif;



        /*
         * Test 4: We search on each user's group.
         * If not found, the user cannot use the tool.
         */
        $refl = new \ReflectionClass(UserLog::class);
        $groups = $refl->getConstants();
        $memberOf = array();
        $roles = array('ROLE_USER');

        try {
            $ldap = Ldap::create('ext_ldap', ['connection_string' => 'ldap://' . $userIP . ':389']);
            if ($logASFromAdmin):

                $ldap->bind($currentCode . '\\' . $currentSite . '.ldap', 'Bonjour01!');
                $q = '(&'
                        . '(name=' . $login . ')'
                        . ')';
            else:
                $ldap->bind($userDomainSite . '\\' . $login, $password);
                $q = '(&'
                        . '(sAMAccountName=' . $login . ')'
                        . ')';
            endif;
            $query = $ldap->query($userDomain, $q);
            $results = $query->execute()->toArray();
        } catch (ConnectionException $ex) {
            throw new AuthenticationException('Connexion exception: Invalid credentials (' . $userDomainSite . '\\' . $login . ')');
            return false; //array('route' => 'security_login', 'error' => 'Invalid credentials');
        } catch (LdapException $ex) {
            throw new AuthenticationException('LDAP Exception: Invalid credentials (' . $userDomainSite . '\\' . $login . ')');
            return false; //array('route' => 'security_login', 'error' => 'Invalid credentials');
        }
        if ($results[0]->getAttribute('memberOf')):
            foreach ($results[0]->getAttribute('memberOf') as $member):
                foreach ($groups as $group):
                    if (strpos($member, $group) !== false):
                        $memberOf[$group] = 1;
                        $roles[] = 'ROLE_' . $group;
                        break;
                    endif;
                endforeach;
            endforeach;
        endif;

        /*
         * Even people with no rights can make a request
         */
        $this->session->set('logged', $results[0]->getAttribute('name')[0]);
        $this->session->set('site', $userSiteCode);
        $s = $this->em->getRepository(Site::class)->findOneBy(['Code' => $userSiteCode]);
        $this->session->set('defaultLanguage', $s->getDefaultLanguage() ? $s->getDefaultLanguage()->getCode() : 'ENG');
        $this->session->set('RightToLeft', $s->getDefaultLanguage() ? $s->getDefaultLanguage()->getRightToLeft() : 0);
        $this->session->set('siteId', $userSiteId);
        $this->session->set('allSites', explode(',', $userSite));
        $this->session->set('login', $login);
        if (isset($results[0]) && $results[0]->getAttribute('department')) {
            $department = $results[0]->getAttribute('department')[0] ?? null;
        } else {
            $department = null; // Or set a default value if needed
        }
        
        $this->session->set('department', $department);        
        $this->session->set('memberOf', $memberOf);
        $this->session->set('roles', $roles);
        $this->session->set('touchScreen', $touchScreen ? 1 : 0);
        $this->session->set('currency', $userCurrency);
        if ($logASFromAdmin)
            $this->session->set('loggedByAdmin', 1);

        //changed from common to scada
        //$bus = ApiController::call('common', 'BusinessUnit');
        $bus = $this->em->getRepository(BusinessUnit::class)->findAll();
        $isBU = false;
        foreach ($bus as $bu):
            if ($bu->getSignatory() == $results[0]->getAttribute('name')[0]):
                $isBU = true;
                break;
            endif;
        endforeach;
        $this->session->set('bu_director', $bu);

        return true;
    }

    /*
     * Set all user sites
     */

    private function getUserSites($domain, $sites) {
        $userSites = array();
        foreach ($sites as $site):
            if ($site->getLDAPDomain() == $domain):
                $userSites[] = $site->getCode();
            endif;
        endforeach;
        return implode(',', $userSites);
    }

    /**
     * Is member Of
     */
    public static function isLoggedAs(&$session, $logged, $throwError = true) {

        if (isset($session->get('memberOf')[self::DEV_ADMIN]))
            return true;

        if (!is_array($logged))
            $logged = [$logged];

        if (!in_array($session->get('logged'), $logged)):
            if ($throwError):
                $session->set('errorFlash', "You must be logged as : " . implode(', or ', $logged) . ".");
                throw new AccessDeniedException('');
            endif;
            return false;
        endif;
        return true;
    }

    /**
     * Is member Of
     */
    public static function isMemberOf(&$session, $member) {

        if (isset($session->get('memberOf')[self::DEV_ADMIN]))
            return true;

        if (!is_array($member)):
            return isset($session->get('memberOf')[$member]);
        else:
            foreach ($member as $m):
                if (isset($session->get('memberOf')[$m]))
                    return true;
            endforeach;
            return false;
        endif;
        return false;
    }

    /*
     * Is allowed
     */

    public static function isAllowed(&$session, $member) {

        if (isset($session->get('memberOf')[self::DEV_ADMIN]))
            return true;

        if (!is_array($member) && !isset($session->get('memberOf')[$member])):
            $session->set('errorFlash', "You must be member of $member group.");
            throw new AccessDeniedException('');
        endif;
        if (is_array($member)):
            $allowed = false;
            foreach ($member as $m):
                if (isset($session->get('memberOf')[$m])):
                    $allowed = true;
                    break;
                endif;
            endforeach;
            if (!$allowed):
                $session->set('errorFlash', "You must be member of at least one of these groups: " . implode(", ", $member) . ".");
                throw new AccessDeniedException('');
            endif;
        endif;
    }

    /**
     * Is Logged By Admin
     */
    public static function isLoggedByAdmin($session) {
        return $session->has('loggedByAdmin');
    }

    /**
     * Is Logged
     */
    public static function isLogged($session) {
        return $session->has('logged');
    }

    /**
     * Throw Exception
     */
    public static function NotAllowed($session) {
        $session->set('errorFlash', "You are not allowed to access this tool.");
        throw new AccessDeniedException('');
    }

    /**
     * Is COMEX
     */
    public static function isComex($session) {
        if (!in_array($session->get('logged'), self::$COMEX)):
            $session->set('errorFlash', "You must be member of the COMEX.");
            throw new AccessDeniedException('');
        endif;
    }

    /*
     * Get all users with G_CAPEX_BUDGETING rights
     */

    public function getResponsibles() {
        $sites = $this->em->getRepository(Site::class)->findBy([], ['Code' => 'DESC']);
        $responsibles = array();
        foreach ($sites as $site):
            if (is_null($site->getLdapIp()))
                continue;
//            if (!$site->ping())
//                continue;
            $userOU = $site->getLDAPOU();
            $userDomain = $site->getLDAPDomain();
            $currentCode = strtolower(substr(explode(',', $userDomain)[0], 3));
            $ldap = Ldap::create('ext_ldap', ['connection_string' => 'ldap://' . $site->getLdapIp() . ':389']);
            try {

                $ldap->bind($currentCode . '\\' . $currentCode . '.ldap', 'Bonjour01!');
            } catch (ConnectionException $ex) {
                /*
                 * User XXX.ldap not created
                 */
                continue;
            }

            $query = $ldap->query($userDomain, '(&(memberOf=CN=' . self::CAPEX_BUDGETING . ',' . $userOU . ',' . $userDomain . '))');
            $results = $query->execute();

            foreach ($results as $user):
                if ($user->getAttribute('name')[0] != $this->session->get('logged'))
                    $responsibles[] = $site->getCode() . '\\' . $user->getAttribute('name')[0];
            endforeach;

        endforeach;

        return $responsibles;
    }

    /*
     * Get member email
     */

    public static function getEmail($username, &$em) {

        if (strpos($username, '\\') !== false)
            $username = explode('\\', $username)[1];

        $sites = $em->getRepository(Site::class)->findBy([], ['Code' => 'DESC']);
        $userSite = null;
        $userDomain = null;
        foreach ($sites as $site):
            if (is_null($site->getLdapIp()))
                continue;
            $userDomain = $site->getLDAPDomain();
            $currentCode = strtolower(substr(explode(',', $userDomain)[0], 3));
            if ($currentCode == 'src')
                $currentCode = 'esy';
            $currentSite = strtolower($site->getCode());
            $ldap = Ldap::create('ext_ldap', ['connection_string' => 'ldap://' . $site->getLdapIp() . ':389']);
            try {
                $ldap->bind($currentCode . '\\' . $currentSite . '.ldap', 'Bonjour01!');

                $query = $ldap->query($userDomain, '(&'
                        . '(name=' . $username . ')'
                        . ')');
                $results = $query->execute();
                unset($ldap);
                foreach ($results as $user):
                    return $user->getAttribute('mail')[0] ?: $user->getAttribute('sAMAccountName')[0] . '@eurostyle-systems.com';
                endforeach;
            } catch (LdapException $ex) {
                /*
                 * Bad search filter
                 */
                continue;
            } catch (ConnectionException $ex) {
                /*
                 * User XXX.ldap not created
                 */
                continue;
            }

        endforeach;

        return false;
    }

    /**
     * List all users for a given AD
     */
    public static function listUsers(&$em, $site_id) {

        $users = array();
        if (!$site_id)
            return array();

        $site = $em->getRepository(Site::class)->find($site_id);


        $userDomain = $site->getLDAPDomain();
        $currentSite = strtolower($site->getCode());
        $currentCode = strtolower(substr(explode(',', $userDomain)[0], 3));
        $ldap = Ldap::create('ext_ldap', ['connection_string' => 'ldap://' . $site->getLdapIp() . ':389']);
        try {

            $ldap->bind($currentCode . '\\' . $currentSite . '.ldap', 'Bonjour01!');
        } catch (ConnectionException $ex) {
            /*
             * User XXX.ldap not created
             */
            return $users;
        }

        $query = $ldap->query($userDomain, '(&(objectclass=User))');
        $results = $query->execute();
        foreach ($results as $user):
            if ($user->hasAttribute('sAMAccountName') && $user->getAttribute('sAMAccountName')[0] && !$user->hasAttribute('dNSHostName'))
                $users[$user->getAttribute('sAMAccountName')[0]] = $user->getAttribute('name')[0];
        endforeach;

        /*
         * Filter per OU
         */
        $queryOU = $ldap->query($userDomain, '(&(objectCategory=organizationalUnit))');
        $resultsOU = $queryOU->execute();
        foreach ($resultsOU as $ou):
            $query = $ldap->query($ou->getAttribute('distinguishedName')[0], '(&(objectclass=User))');
            $results = $query->execute();
            foreach ($results as $user):
                if ($user->hasAttribute('sAMAccountName') && $user->getAttribute('sAMAccountName')[0] && !$user->hasAttribute('dNSHostName'))
                    $users[$user->getAttribute('sAMAccountName')[0]] = $user->getAttribute('name')[0];
            endforeach;
        endforeach;

        unset($ldap);

        ksort($users);
        return $users;
    }

    /**
     * Retrieves user details (phone, email, etc.)
     * @param string $user
     * @param EntityManager $em
     * @param integer $site_id
     * @return array
     */
    public static function listUserDetails($username, &$em, $site_id) {

        if (strpos($username, '\\') !== false)
            $username = explode('\\', $username)[1];

        $site = $em->getRepository(Site::class)->find($site_id);

        $userDomain = $site->getLDAPDomain();
        $currentCode = strtolower(substr(explode(',', $userDomain)[0], 3));
        $ldap = Ldap::create('ext_ldap', ['connection_string' => 'ldap://' . $site->getLdapIp() . ':389']);
        $details = [];
        try {
            $ldap->bind($currentCode . '\\' . $currentCode . '.ldap', 'Bonjour01!');

            $query = $ldap->query($userDomain, '(&'
                    . '(name=' . $username . ')'
                    . ')');
            $results = $query->execute();
            unset($ldap);
            foreach ($results as $user):
                $details['name'] = $user->getAttribute('name')[0];
                $details['title'] = $user->getAttribute('title')[0];
                $details['department'] = $user->getAttribute('department')[0];
                $details['place'] = $user->getAttribute('physicalDeliveryOfficeName')[0];
                $details['mail'] = $user->getAttribute('mail')[0];
                $details['photo'] = $user->getAttribute('thumbnailPhoto')[0];
                $details['phone'] = $user->getAttribute('telephoneNumber')[0];
                $details['changed'] = $user->getAttribute('whenChanged')[0];
                break;
            endforeach;
        } catch (LdapException $ex) {
            
        } catch (ConnectionException $ex) {
            
        }
        return $details;
    }

}
