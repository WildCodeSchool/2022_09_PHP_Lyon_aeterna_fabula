<?php

namespace App\Controller;

class UserController extends AbstractController
{
    public function showLoginPage()
    {
        return $this->twig->render('User/login.html.twig');
    }

    public function showRegisterPage()
    {
        return $this->twig->render('User/register.html.twig');
    }
}
