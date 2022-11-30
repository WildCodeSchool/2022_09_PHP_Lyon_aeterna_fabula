<?php

namespace App\Controller;

use App\Model\AliasManager;
use App\Model\HistoricManager;
use App\Model\ActionManager;

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
        // restriction à un utilisateur connecté
        if (empty($_SESSION)) {
            header('location:/');
            return null;
        } else {
            $userId = $_SESSION['user_id'];
            $aliasManager = new AliasManager();
            $aliasOngoing = $aliasManager->selectOneByUserId($userId);

            $aliasWithLastChapter = [];
            foreach ($aliasOngoing as $aliasSelected) {
                $aliasLastChapterId = $aliasManager->selectLastActionByHistoric($aliasSelected['id']);
                $aliasSelected['lastChapter'] = $aliasLastChapterId;
                $aliasWithLastChapter[] = $aliasSelected;
            }

            return $this->twig->render(
                'Alias/alias_index.html.twig',
                [
                    'aliasOngoing' => $aliasOngoing,
                    'aliasWithLastChapter' => $aliasWithLastChapter,
                    'userId' => $userId
                ]
            );
        }
    }

    public function create(): ?string
    {
        // restriction à un utilisateur connecté
        if (empty($_SESSION)) {
            header('location:/');
            return null;
        } else {
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
                $_SESSION['player_name'] = $activeAlias;

                header('Location:/incipit');

                return null;
            }

            return $this->twig->render('Alias/alias_create.html.twig');
        }
    }

    public function logoutAlias(int $alias, int | null $action)
    {
        if ($action != null) {
            $actionManager = new ActionManager();
            $targetIdIsNull = $actionManager->selectActionWithTargetIdIsNull();
            $endingAction = array_column($targetIdIsNull, 'id');

            if (isset($_SESSION['alias_id'])) {
                $aliasId = $_SESSION['alias_id'];
            } else {
                $aliasId = $alias;
            }

            if (in_array($action, $endingAction)) {
                $aliasManager = new AliasManager();
                $aliasManager->modifyNature($aliasId);
            };
        }

        unset($_SESSION['alias_id']);

        header('Location: /');
    }

    public function deleteAlias(int $alias)
    {
        if (isset($_SESSION['alias_id'])) {
            $aliasId = $_SESSION['alias_id'];
        } else {
            $aliasId = $alias;
        }

        $aliasManager = new AliasManager();
        $aliasManager->endStory($aliasId);

        unset($_SESSION['alias_id']);

        header('Location: /alias');
    }
}
