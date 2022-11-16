<?php

namespace App\Controller;

use App\Model\UserManager;
use Twig\Node\Expression\Test\NullTest;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        return $this->twig->render('Home/index.html.twig');
    }

    public function indexAdmin(): ?string
    {
        if ($this->checkIsAdmin()) {
            return $this->twig->render('Admin/admin_homepage.html.twig');
        } else {
            header('location:/');
            return null;
        }
    }
}
