<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';
require_once __DIR__ .'/../repository/UserRepository.php';

class SecurityController extends AppController {

    public function login(){
        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if (!$user) {
            return $this->render('login', ['messages' => ['Użytkownik nie istnieje!']]);
        }

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['Nie ma użytkownika z tym e-mailem!']]);
        }

        if (!password_verify($password,$user->getPassword())) {
            return $this->render('login', ['messages' => ['Złe hasło!']]);
        }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/menu");
    }

    public function register(){

        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('rejestracja');
        }

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $notHashPassword = $_POST['password'];
        $confirmedPassword = $_POST['confirmedPassword'];


        if (!$name or !$surname or !$nickname or !$email or !$notHashPassword or !$confirmedPassword) {
            return $this->render('rejestracja', ['messages' => ['Trzeba wypełnić wszystkie pola!']]);
        }

        if ($confirmedPassword !== $notHashPassword ) {
            return $this->render('rejestracja', ['messages' => ['Hasła nie są takie same!']]);
        }

        if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
            return $this->render('rejestracja', ['messages' => ['To nie jest email!']]);
        }

        if (!(is_null($userRepository->getUser($email)))) {
            return $this->render('rejestracja', ['messages' => ['Istnieje użytkownik o tym emailu!']]);
        }

        $password=password_hash($notHashPassword, PASSWORD_DEFAULT);
        $user=new User($email, $password, $name, $surname, $nickname);
        $userRepository->addUser($user);

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/menu");


    }
}