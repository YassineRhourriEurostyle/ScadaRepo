<?php
namespace App\Security;

use App\Entity\Version;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class VersionVoter extends Voter
{
    const CREATE = 'create';
    const EDIT = 'edit';
    const MODIFY = 'modify';
    const VIEW = 'view';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT, self::CREATE, self::MODIFY))) {
            return false;
        }

        // only vote on Version objects inside this voter
        if (!$subject instanceof Version) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        $version = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($version, $token);
            case self::EDIT:
                return $this->canEdit($version, $token);
            case self::MODIFY:
                return $this->canModify($version, $token);
            case self::CREATE:
                return $this->canCreate($version, $token);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Version $version, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_READ', 'ROLE_INDUSTRIAL'))) {
            return true;
        }

        $user = $token->getUser();

        if ($this->decisionManager->decide($token, array('ROLE_KAM')) && !$user->getMarques()->isEmpty()) {
            return true;
        }

        if ($this->decisionManager->decide($token, array('ROLE_DU')) && !$user->getUsines()->isEmpty()) {
            return true;
        }

        return false;
    }

    private function canEdit(Version $version, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_EDIT', 'ROLE_INDUSTRIAL'))) {
            return true;
        }

        $user = $token->getUser();

        if ($this->decisionManager->decide($token, array('ROLE_KAM')) && $user->getMarques()->contains($version->getProject()->getVehicle()->getMarque())) {
            return true;
        }

        if ($this->decisionManager->decide($token, array('ROLE_DU')) && $user->getUsines()->contains($version->getUsineFacturation())) {
            return true;
        }

        return false;
    }

    private function canModify(Version $version, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_EDIT'))) {
            return true;
        }

        $user = $token->getUser();

        if ($this->decisionManager->decide($token, array('ROLE_KAM'))) {

            // if we are creating the version, allow modification
            if (!$version->getId()) {
                return true;
            }

            if ($user->getMarques()->contains($version->getProject()->getVehicle()->getMarque())) {
                return true;
            }
        }

        return false;
    }

    private function canCreate(Version $version, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_CREATE', 'ROLE_KAM'))) {
            return true;
        }

        return false;
    }
}