<?php

namespace App\Controller;

use App\Model\ChapterManager;

class ChapterController extends AbstractController
{
    private array $errors = [];
    /**
     * String Check
     */
    public function stringCheck(array $chapter, string $field, string $fieldFrench, int $maxLength): void
    {
        if (!isset($chapter[$field]) || empty($chapter[$field])) {
            $this->errors[] = "$fieldFrench est obligatoire";
        }
        if (strlen($chapter[$field]) > $maxLength) {
            $this->errors[] = "$fieldFrench ne doit pas dépasser $maxLength caractères";
        }
    }

    /**
     * Form Control
     */
    public function formControl(array $chapter): void
    {
        // TODO validations (length, format...)
        $this->stringCheck($chapter, 'name', 'Le nom', 35);
        $this->stringCheck($chapter, 'title', 'Le titre', 80);
        $this->stringCheck($chapter, 'description', 'La description', 500);
        $this->stringCheck($chapter, 'background_image', "Le nom de l'image", 100);
        $this->stringCheck($chapter, 'background_image_alt', "Le nom de l'attribut alt", 100);
    }

    /**
     * List chapters
     */
    public function adminIndex(): string
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->selectAll('id');

        return $this->twig->render('Chapter/admin_index.html.twig', ['chapters' => $chapters]);
    }

    public function showWithAction(int $id): string
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->selectActionsByChapterId($id);

        return $this->twig->render('Chapter/show.html.twig', ['chapters' => $chapters]);
    }

    public function showWithActionForAdmin(int $id): string
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->selectActionsByChapterIdForAdmin($id);

        return $this->twig->render('Chapter/admin_show.html.twig', ['chapters' => $chapters]);
    }

    /**
     * Show informations for a specific chapter
     */
    public function show(int $id): string
    {
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->selectOneById($id);

        return $this->twig->render('Chapter/show.html.twig', ['chapter' => $chapter]);
    }

    /**
     * Show admin informations for a specific chapter
     */
    public function adminShow(int $id): string
    {
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->selectOneById($id);

        return $this->twig->render('Chapter/admin_show.html.twig', ['chapter' => $chapter]);
    }

    /**
     * Edit a specific item
     */
    public function adminEdit(int $id): ?string
    {
        $chapterManager = new ChapterManager();
        $chapter = $chapterManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $chapter = array_map('trim', $_POST);
            $this->formControl($chapter);

            if (!empty($this->errors)) {
                return $this->twig->render('Chapter/admin_edit.html.twig', [
                    'errors' => $this->errors,
                ]);
            }


            // if validation is ok, update and redirection
            $chapterManager->adminUpdate($chapter);

            header('Location: /chapters/admin_show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }
        return $this->twig->render('Chapter/admin_edit.html.twig', [
            'chapter' => $chapter,
        ]);
    }

    /**
     * Add a new item
     */
    public function adminAdd(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $chapter = array_map('trim', $_POST);
            $this->formControl($chapter);


            // TODO validations (length, format...)

            if (!empty($this->errors)) {
                return $this->twig->render('Chapter/admin_add.html.twig', [
                    'errors' => $this->errors,
                ]);
            }

            // if validation is ok, insert and redirection
            $chapterManager = new ChapterManager();
            $id = $chapterManager->adminInsert($chapter);

            header('Location:/chapters/admin_show?id=' . $id);
            return null;
        }

        return $this->twig->render(
            'Chapter/admin_add.html.twig'
        );
    }
}
