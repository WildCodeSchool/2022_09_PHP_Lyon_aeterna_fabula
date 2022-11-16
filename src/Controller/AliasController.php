<?php

namespace App\Controller;

use App\Model\AliasManager;
use App\Model\HistoricManager;

class AliasController extends AbstractController
{
    private array $errors = [];
    /**
     * String Check
     */
    public function stringCheck(array $alias, string $field, string $fieldFrench, int $maxLength): void
    {
        if (!isset($alias[$field]) || empty($alias[$field])) {
            $this->errors[] = "$fieldFrench est obligatoire";
        }
        if (strlen($alias[$field]) > $maxLength) {
            $this->errors[] = "$fieldFrench ne doit pas dépasser $maxLength caractères";
        }
    }

    /**
     * Form Control
     */
    public function formControl(array $alias): void
    {
        // TODO validations (length, format...)
        $this->stringCheck($alias, 'player_name', 'L\'alias', 55);
    }
    public function start()
    {
        return $this->twig->render('Alias/alias_index.html.twig');
    }

    public function create(int $user_id = 1): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $alias = array_map('trim', $_POST);
            $this->formControl($alias);


            // TODO validations (length, format...)

            if (!empty($this->errors)) {
                return $this->twig->render('Alias/alias_create.html.twig', [
                    'errors' => $this->errors,
                ]);
            }

            // if validation is ok, insert and redirection

            // récuperer l'id user de la session : voir avec les experts
            $aliasManager = new AliasManager();
            $aliasManager->addAlias($alias, $user_id);

            header('Location:/incipit');
            return null;
        }

        return $this->twig->render('Alias/alias_create.html.twig');
    }
}
