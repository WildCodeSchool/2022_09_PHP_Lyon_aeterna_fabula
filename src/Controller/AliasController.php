<?php

namespace App\Controller;

use App\Model\AliasManager;
use App\Model\HistoricManager;

class AliasController extends AbstractController
{
    public function start()
    {
        return $this->twig->render('Alias/alias_index.html.twig');
    }

    public function create()
    {
        return $this->twig->render('Alias/alias_create.html.twig');
    }
}
