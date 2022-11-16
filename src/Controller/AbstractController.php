<?php

namespace App\Controller;

use App\Model\UserManager;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

/**
 * Initialized some Controller common features (Twig...)
 */
abstract class AbstractController
{
    protected Environment $twig;
    protected array | false $user;

    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
        );
        $this->twig->addExtension(new DebugExtension());
        $userManager = new UserManager();
        $this->user = isset($_SESSION['email']) ? $userManager->selectOneByEmail($_SESSION) : false;
        $this->twig->addGlobal('user', $this->user);
    }

    public function checkIsAdmin(): bool
    {
        if (!empty($_SESSION)) {
            return $_SESSION['is_admin'];
        }
        return false;
    }
}
