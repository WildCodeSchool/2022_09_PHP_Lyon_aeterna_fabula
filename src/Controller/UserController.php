<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    private array $errors = [];

    public function showLoginPage()
    {
        return $this->twig->render('User/login.html.twig');
    }

    public function showRegisterPage(): string|null
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = array_map('trim', $_POST);
            $this->emailValidator($data['email']);

            if (!empty($this->errors)) {
                return $this->twig->render('User/register.html.twig', [
                    'errors' => $this->errors,
                ]);
            }


            $userManager = new UserManager();
            $userManager->addUser($data);

            header('Location:/user/register');
            return null;
        }

        return $this->twig->render('User/register.html.twig');
    }

    public function emailValidator(?string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "$email n'est pas un email valide";
        }
        if (!isset($email) || empty($email)) {
            $this->errors[] = "Le champ Email est obligatoire";
        }
    }
}
