<?php

namespace App\Controller;

use App\Model\ChapterManager;

class ChapterController extends AbstractController
{
    /*
    Show informations for a specific chapter
    */
    public function show(int $id): string
    {
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->selectOneById($id);

        return $this->twig->render('Chapter/show.html.twig', ['chapter' => $chapter]);
    }
}
