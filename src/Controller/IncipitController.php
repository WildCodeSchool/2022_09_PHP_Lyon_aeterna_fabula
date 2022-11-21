<?php

namespace App\Controller;

class IncipitController extends AbstractController
{
    /**
     * Display incipit page
     */
    public function incipit(): string
    {
        $aliasId = $_SESSION['alias_id'];
        $aliasName = $_SESSION['player_name'];

        return $this->twig->render('Incipit/incipit.html.twig', ['aliasId' => $aliasId, 'aliasName' => $aliasName]);
    }
}
