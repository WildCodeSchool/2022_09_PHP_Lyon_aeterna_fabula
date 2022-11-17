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
        $userId = $_SESSION['user_id'];
        $aliasManager = new AliasManager();
        $alias = $aliasManager->selectOneByUserId($userId);
        $aliasNatures = array_column($alias, 'nature');
        $aliasOngoing = $aliasManager->selectAliasNameOngoing($userId);
        $aliasNames = array_column($aliasOngoing, 'player_name');

        $aliasWithLastChapter = [];
        foreach ($alias as $aliasSelected) {
            if ($aliasSelected['nature'] == 'ONGOING') {
                $aliasLastChapterId = $aliasManager->selectLastActionByHistoric($aliasSelected['id']);
                $aliasSelected['lastChapter'] = $aliasLastChapterId;
                $aliasWithLastChapter[] = $aliasSelected;
            }
        }

            return $this->twig->render(
                'Alias/alias_index.html.twig',
                ['aliasNatures' => $aliasNatures,
                'aliasNames' => $aliasNames,
                'aliasWithLastChapter' => $aliasWithLastChapter,]
            );
    }

    public function create(): ?string
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

            $userId = $_SESSION['user_id'];

            $aliasManager = new AliasManager();
            $activeAlias = $aliasManager->addAlias($alias, $userId);

            $_SESSION['alias_id'] = $activeAlias;

            header('Location:/incipit');
            return null;
        }

        return $this->twig->render('Alias/alias_create.html.twig');
    }
}
