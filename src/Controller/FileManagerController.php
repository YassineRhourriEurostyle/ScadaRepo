<?php

namespace App\Controller;

use App\Service\UserLog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Mime\FileinfoMimeTypeGuesser;

/**
 * @Route("/filemanager")
 */
class FileManagerController extends AbstractController {

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    /**
     * @Route("/delete", name="filemanager_download")
     */
    public function delete(Request $request) {
        $filePath = $request->get('path');
        $referer = $request->get('referer');
        $root = realpath(__DIR__ . '/../../');

        if (is_file($root . $filePath)):
            @unlink($root . $filePath);
            if (is_file($root . $filePath)):
                $this->addFlash('error', 'ERROR: file ' . $filePath . ' coudn\'t be deleted.');
            else:
                $this->addFlash('success', 'File ' . $filePath . ' deleted.');
            endif;
        endif;

        return $this->redirect($referer);
    }

    /**
     * @Route("/download", name="filemanager_download")
     */
    public function download(Request $request) {
        $filePath = $request->get('path');
        $root = realpath(__DIR__ . '/../../');

        // This should return the file to the browser as response
        $response = new BinaryFileResponse($root . $filePath);

        // To generate a file download, you need the mimetype of the file
        $mimeTypeGuesser = new FileinfoMimeTypeGuesser();

        // Set the mimetype with the guesser or manually
        if ($mimeTypeGuesser->isGuesserSupported()) {
            // Guess the mimetype of the file according to the extension of the file
            $response->headers->set('Content-Type', $mimeTypeGuesser->guessMimeType($root . $filePath));
        } else {
            // Set the mimetype of the file manually, in this case for a text file is text/plain
            $response->headers->set('Content-Type', 'text/plain');
        }

        // Set content disposition inline of the file
        $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                basename($filePath)
        );

        return $response;
    }

}
