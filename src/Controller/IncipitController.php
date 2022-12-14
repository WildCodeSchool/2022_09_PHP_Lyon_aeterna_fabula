<?php

namespace App\Controller;

use App\Model\AliasManager;

class IncipitController extends AbstractController
{
    /**
     * Display incipit page
     */
    public function incipit(): ?string
    {
        if (empty($_SESSION)) {
            header('location:/');
            return null;
        } else {
            $aliasId = $_SESSION['alias_id'];

            $aliasManager = new AliasManager();
            $alias = $aliasManager->selectOneById($aliasId);

            return $this->twig->render('Incipit/incipit.html.twig', ['alias' => $alias]);
        }
    }
}
