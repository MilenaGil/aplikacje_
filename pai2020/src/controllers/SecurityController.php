<?php

require_once 'AppController.php';
require_once __DIR__ .'/../models/User.php';

class SecurityController extends AppController {
    public function login(){
        $user = new User('m@g.pl', 'gil', 'Milena', 'Gil');

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['Nie ma użytkownika z tym e-mailem!']]);
        }

        if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Złe hasło!']]);
        }

        return $this->render('menu');
    }
}