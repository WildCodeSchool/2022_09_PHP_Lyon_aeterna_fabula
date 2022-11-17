<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    private array $errors = [];
    private string $message = '';


    public function showLoginPage(?string $inscrit = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $credentials = array_map('trim', $_POST);
            $userManager = new UserManager();
            $user = $userManager->selectOneByEmail($credentials);
            if (
                $user
                &&
                password_verify($credentials['password'], $user['password'])
            ) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_admin'] = $user['is_admin'];
                header('Location: /');
            } else {
                $this->message = "L'email ou le mot de passe est incorrect.";
                return $this->twig->render('User/login.html.twig', [
                    'message' => $this->message,
                ]);
            }
        } else {
            $this->message = "Veuillez vous connecter pour jouer.";
            return $this->twig->render('User/login.html.twig', [
                'inscrit' => $inscrit,
                'message' => $this->message
            ]);
        }
    }


    public function showRegisterPage(): string|null
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = array_map('trim', $_POST);
            $this->emailValidator($data['email']);
            $this->passwordValidator($data['password'], $data['password2']);

            if (!empty($this->errors)) {
                return $this->twig->render('User/register.html.twig', [
                    'errors' => $this->errors,
                ]);
            }

            $userManager = new UserManager();
            $userManager->addUser($data);
            $inscrit = "Votre compte a bien été créé.";

            header('Location: /login?inscrit=' . $inscrit);
        }
        return $this->twig->render('User/register.html.twig');
    }

    public function emailValidator(string $email): void
    {
        if (empty($email)) {
            $this->errors[] = "Le champ Email est obligatoire";
        }

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "$email n'est pas un email valide";
        }
    }

    public function passwordValidator(string $password, string $password2): void
    {
        $upperCase = preg_match('@[A-Z]@', $password);
        $lowerCase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialCharacter = preg_match('@[^\w]@', $password);

        if (!$upperCase) {
            $this->errors[] = "Le mot de passe doit contenir au moins une majuscule";
        }
        if (!$lowerCase) {
            $this->errors[] = "Le mot de passe doit contenir au moins une minuscule";
        }
        if (!$number) {
            $this->errors[] = "Le mot de passe doit contenir au moins un chiffre";
        }
        if (!$specialCharacter) {
            $this->errors[] = "Le mot de passe doit contenir au moins un caractère spécial";
        }
        if (strlen($password) < 8) {
            $this->errors[] = "Le mot de passe doit contenir au mininum 8 caractères";
        }
        if (empty($password)) {
            $this->errors[] = "Le mot de passe est obligatoire";
        }
        if ($password != $password2) {
            $this->errors[] = "Les mots de passe doivent être identiques";
        }
    }

    public function logout()
    {
        unset($_SESSION);
        session_destroy();
        header('Location: /');
    }
}
