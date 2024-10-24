<?php

namespace App\Controller;

use App\Controller\ApiController;
use App\Entity\Project;
use App\Entity\Signature;
use App\Service\Encoding;
use App\Service\Mailing;
use App\Service\UserLog;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * @Route("/forum")
 */
class ForumController extends AbstractController {

    private $project_code;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
        $this->project_code = strtoupper($_SERVER['HTTP_HOST']);
        if (strpos($this->project_code, '.GMD-PLS') !== false):
            $this->project_code = substr($this->project_code, 0, strpos($this->project_code, '.GMD-PLS'));
        endif;
        if (strpos($this->project_code, 'PLS') !== false):
            $this->project_code = substr($this->project_code, 0, strpos($this->project_code, 'PLS'));
        endif;
    }

    /**
     * @Route("/", name="forum")
     */
    public function index() {

        $messages = ApiController::call('common', 'Forum',
                        [
                            'filter' => [
                                'ITProject' => $this->project_code
                                ],
                            'order' => ['id' => 'DESC']
                        ]
        );


        //Purge
        $ids = [];
        foreach ($messages as $i => $message):
            if ($message['ParentMessage'])
                $ids[] = $message['ParentMessage']['id'];
            if (in_array($message['id'], $ids)):
                unset($messages[$i]);
                continue;
            endif;
            
            if($message['Status']=='Approved' && $message['Date']['date']<date('Y-m-d', strtotime('-7 days'))):
                unset($messages[$i]);
                continue;                
            endif;
        endforeach;
        //Files
        foreach ($messages as &$message):
            $rootDir = '/var/www/common/public/_forum/' . $message['id'] . '/';
            $url = 'http://commonpls/_forum/' . $message['id'] . '/';
            $message['files'] = [];
            if (is_dir($rootDir)):
                $t = scandir($rootDir);
                foreach ($t as $file):
                    if (is_file($rootDir . $file)):
                        $message['files'][$url . $file] = $file;
                    endif;
                endforeach;
            endif;
        endforeach;
        return $this->render('_forum/index.html.twig', [
                    'messages' => $messages
        ]);
    }

    /**
     * @Route("/new/{parent}", name="forum_new")
     */
    public function new($parent = 0) {

        $hierarchy = [];

        $id = $parent;
        while (1) :
            $prev = ApiController::call('common', 'Forum', ['filter' => ['id' => $id, 'ITProject' => $this->project_code]]);

            if ($prev && count($prev)):
                $rootDir = '/var/www/common/public/_forum/' . $prev[0]['id'] . '/';
                $url = 'http://commonpls/_forum/' . $prev[0]['id'] . '/';
                $prev[0]['files'] = [];
                if (is_dir($rootDir)):
                    $t = scandir($rootDir);
                    foreach ($t as $file):
                        if (is_file($rootDir . $file)):
                            $prev[0]['files'][$url . $file] = $file;
                        endif;
                    endforeach;
                endif;

                $hierarchy[] = $prev[0];
                $id = $prev[0]['ParentMessage']['id'];
            else:
                break;
            endif;
        endwhile;


        return $this->render('_forum/new.html.twig', [
                    'parent' => $parent,
                    'hierarchy' => $hierarchy,
        ]);
    }

    /**
     * @Route("/save", name="forum_save")
     */
    public function save(Request $request) {

        $r = ApiController::set('common', 'Forum', 0, 'ITProject', $this->project_code);
        $id = $r['id'];
        ApiController::set('common', 'Forum', $id, 'Message', $request->request->get('message'));
        ApiController::set('common', 'Forum', $id, 'Category', $request->request->get('category'));
        ApiController::set('common', 'Forum', $id, 'User', $request->request->get('user'));
        ApiController::set('common', 'Forum', $id, 'Status', $request->request->get('status'));
        ApiController::set('common', 'Forum', $id, 'ParentMessage', $request->request->get('parent') ?: 0);

        $em = $this->getDoctrine()->getManager();
        $mail = 'aurelien.stride@eurostyle-systems.com';
        if ((int) $request->request->get('parent')):
            $prev = ApiController::call('common', 'Forum', ['filter' => ['id' => $request->request->get('parent'), 'ITProject' => $this->project_code]]);
            if (count($prev)):
                $mail = UserLog::getEmail($prev[0]['User'], $em);
                if (isset($prev[0]['FirstPost']['id'])):
                    ApiController::set('common', 'Forum', $id, 'FirstPost', $prev[0]['FirstPost']['id']);
                else:
                    ApiController::set('common', 'Forum', $id, 'FirstPost', $prev[0]['id']);
                endif;
            endif;
        endif;


        //Files
        $rootDir = '/var/www/common/public/_forum/';

        if (isset($_FILES['files']['name'])):
            @mkdir($rootDir);
            @mkdir($rootDir . $id);
            for ($i = 0; $i < count($_FILES['files']['name']); $i++):
                move_uploaded_file($_FILES['files']['tmp_name'][$i], $rootDir . $id . '/' . $_FILES['files']['name'][$i]);
            endfor;
        endif;

        //Send Mail
        Mailing::sendMail($mail, 'New forum post for ' . $this->project_code . ', '
                . $request->request->get('category') . ' #' . $id,
                'forumPost', [
            'PROJECT' => $this->project_code,
            'id' => $id,
            'sender' => $this->session->get('logged'),
            'message' => $request->request->get('message'),
        ]);

        //Redirection home forum
        $this->addFlash('success', 'Message saved');

        return $this->redirect('/forum');
    }

}
