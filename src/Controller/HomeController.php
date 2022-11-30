<?php

namespace App\Controller;

use App\Model\AliasManager;
use App\Model\ActionManager;
use App\Model\UserManager;
use Twig\Node\Expression\Test\NullTest;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(int | null $action = null): string
    {
        if ($action != null) {
            $actionManager = new ActionManager();
            $targetIdIsNull = $actionManager->selectActionWithTargetIdIsNull();
            $endingAction = array_column($targetIdIsNull, 'id');

            if (isset($_SESSION['alias_id'])) {
                $aliasId = $_SESSION['alias_id'];
            } else {
                $aliasId = $_GET ['alias'];
            }


            if (in_array($action, $endingAction)) {
                $aliasManager = new AliasManager();
                $aliasManager->modifyNature($aliasId);
            };
        }

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
