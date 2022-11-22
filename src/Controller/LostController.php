<?php

namespace App\Controller;

use App\Model\ActionManager;
use App\Model\ChapterManager;

class LostController extends AbstractController
{
    public function lost(): string
    {
        return $this->twig->render('Home/lost.html.twig');
    }
}
