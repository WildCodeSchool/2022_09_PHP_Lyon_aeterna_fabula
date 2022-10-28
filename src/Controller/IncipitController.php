<?php

namespace App\Controller;

class IncipitController extends AbstractController
{
    /**
     * Display incipit page
     */
    public function incipit(): string
    {
        return $this->twig->render('Incipit/incipit.html.twig');
    }
}
