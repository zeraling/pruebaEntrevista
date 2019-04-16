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

        $user = Users::getUserByName($postData['username']);
        
        if ($user) {
            if ($postData['password']==$user->pass) {
            //if (password_verify($postData['password'], $user->password)) {
                $_SESSION['sisUser'] = $user->id;
                return new RedirectResponse('/');
            } else {
                $responseMessage = 'Usuario o password invalidos';
            }
        } else {
            $responseMessage = 'No se encontro el usuario';
        }

        return $this->renderHTML('login.twig', [
                    'responseMessage' => $responseMessage
        ]);
    }

    public function getLogout() {
        unset($_SESSION['sisUser']);
        return new RedirectResponse('/login');
    }

}
