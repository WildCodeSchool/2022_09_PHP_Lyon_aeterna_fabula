<?php

namespace App\Controller;

use App\Model\ActionManager;

class ActionController extends AbstractController
{
    private array $errors = [];
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
        $actionManager = new ActionManager();
        $action = $actionManager->selectOneById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $action = array_map('trim', $_POST);
            $this->formControlAction($action);

            if (!empty($this->errors)) {
                return $this->twig->render('Action/admin_edit_action.html.twig', [
                    'errors' => $this->errors,
                ]);
            }


            // if validation is ok, update and redirection
            $actionManager->adminUpdateAction($action);

            header('Location: /chapters/admin_index');

            // we are redirecting so we don't want any content rendered
            return null;
        }
        return $this->twig->render('action/admin_edit_action.html.twig', ['action' => $action,]);
    }
}
