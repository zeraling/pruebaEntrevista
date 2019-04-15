<?php

namespace App\Controllers;

use App\Models\Users;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Diactoros\ServerRequest;

class AuthController extends BaseController {

    public function getLogin() {
        return $this->renderHTML('login.twig');
    }

    public function postLogin(ServerRequest $request) {
        $postData = $request->getParsedBody();
        $responseMessage = null;

        $user = Users::getUserByName($postData['email']);
        
        var_dump($user);
        
        die;
        if ($user) {
            if (password_verify($postData['password'], $user->password)) {
                $_SESSION['userId'] = $user->id;
                return new RedirectResponse('/admin');
            } else {
                $responseMessage = 'Bad credentials';
            }
        } else {
            $responseMessage = 'Bad credentials';
        }

        return $this->renderHTML('login.twig', [
                    'responseMessage' => $responseMessage
        ]);
    }

    public function getLogout() {
        unset($_SESSION['userId']);
        return new RedirectResponse('/login');
    }

}
