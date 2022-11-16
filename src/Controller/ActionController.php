<?php

namespace App\Controller;

use App\Model\ActionManager;
use App\Model\ChapterManager;

class ActionController extends AbstractController
{
    private array $errors = [];

    /**
     * List actions
     */
    public function adminIndexAction(): ?string
    {
        if ($this->checkIsAdmin()) {
            $actionManager = new ActionManager();
            $actions = $actionManager->selectAll('target_id');

            return $this->twig->render('Action/admin_index_action.html.twig', ['actions' => $actions]);
        } else {
            header('location:/');
            return null;
        }
    }

    /**
     * Show admin informations for a specific action
     */
    public function adminShowAction(int $id): ?string
    {
        if ($this->checkIsAdmin()) {
            $actionManager = new ActionManager();
            $action = $actionManager->selectOneById($id);

            return $this->twig->render('Action/admin_show_action.html.twig', ['action' => $action]);
        } else {
            header('location:/');
            return null;
        }
    }

    /**
     * String Check
     */
    public function stringCheckActionText(array $action, string $field, string $fieldInFrench, int $maxLength): void
    {
        if (!isset($action[$field]) || empty($action[$field])) {
            $this->errors[] = 'Le ' . $fieldInFrench . ' est obligatoire';
        }
        if (strlen($action[$field]) > $maxLength) {
            $this->errors[] = "Le $fieldInFrench ne doit pas dépasser $maxLength caractères";
        }
    }

    public function stringCheckActionNumeric(array $action, string $field, string $fieldInFrench): void
    {
        if (!is_numeric($action[$field])) {
            $this->errors[] = "Le $fieldInFrench doit être un nombre entier";
        }
    }

    /**
     * Form Control
     */
    public function formControlAction(array $action): void
    {
        // TODO validations (length, format...)
        $this->stringCheckActionText($action, 'label', 'libellé', 60);
        $this->stringCheckActionText($action, 'owner_id', 'numéro du chapitre de départ', 4);
        $this->stringCheckActionText($action, 'target_id', "numéro du chapitre d'arrivée", 4);
        $this->stringCheckActionNumeric($action, 'owner_id', 'numéro du chapitre de départ');
        $this->stringCheckActionNumeric($action, 'target_id', "numéro du chapitre d'arrivée");
    }

    /**
     * Edit a specific item
     */
    public function adminEditAction(int $id): ?string
    {
        if ($this->checkIsAdmin()) {
            $messageError = null;
            $chaptersManager = new ChapterManager();
            $chapters = $chaptersManager->selectAll();

            try {
                $actionManager = new ActionManager();
                $action = $actionManager->selectOneById($id);

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // clean $_POST data
                    $action = array_map('trim', $_POST);
                    $this->formControlAction($action);

                    if (!empty($this->errors)) {
                        return $this->twig->render(
                            'Action/admin_edit_action.html.twig',
                            ['action' => $action, 'errors' => $this->errors, 'chapters' => $chapters,]
                        );
                    }
                    // if validation is ok, update and redirection
                    $actionManager->adminUpdateAction($action);
                    header('Location: /chapters');

                    // we are redirecting so we don't want any content rendered
                    return null;
                }
            } catch (\Exception  $exception) {
                if ($exception->getCode() == 23000) {
                    $messageError = 'Il est impossible d\'enregistrer un numéro de chapitre qui n\'existe pas';
                    return $this->twig->render(
                        'Action/admin_edit_action.html.twig',
                        ['action' => $action, 'messageError' => $messageError, 'chapters' => $chapters,]
                    );
                } else {
                    $messageError = $exception->getMessage();
                    return $this->twig->render(
                        'Action/admin_edit_action.html.twig',
                        ['action' => $action, 'messageError' => $messageError, 'chapters' => $chapters,]
                    );
                }
            }
            return $this->twig->render(
                'Action/admin_edit_action.html.twig',
                ['action' => $action, 'chapters' => $chapters,]
            );
        } else {
            header('location:/');
            return null;
        }
    }

    public function adminAddAction(): ?string
    {
        if ($this->checkIsAdmin()) {
            $messageError = null;
            $chaptersManager = new ChapterManager();
            $chapters = $chaptersManager->selectAll();

            try {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // clean $_POST data
                    $action = array_map('trim', $_POST);
                    $this->formControlAction($action);

                    if (!empty($this->errors)) {
                        return $this->twig->render(
                            'Action/admin_add_action.html.twig',
                            ['errors' => $this->errors, 'chapters' => $chapters,]
                        );
                    }

                    // if validation is ok, update and redirection
                    $actionManager = new ActionManager();
                    $actionManager->adminInsertAction($action);

                    header('Location: /chapters');

                    // we are redirecting so we don't want any content rendered
                    return null;
                }
            } catch (\Exception  $exception) {
                if ($exception->getCode() == 23000) {
                    $messageError = 'Il est impossible d\'enregistrer un numéro de chapitre qui n\'existe pas';
                } else {
                    $messageError = $exception->getMessage();
                }
            }
            return $this->twig->render(
                'Action/admin_add_action.html.twig',
                ['messageError' => $messageError, 'chapters' => $chapters,]
            );
        } else {
            header('location:/');
            return null;
        }
    }
}
