<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    public function index()
    {
        $this->render('login');
    }

    public function rejestracja()
    {
        $this->render('rejestracja');
    }

    public function menu()
    {
        $this->render('menu');
    }

    public function pusta_lista()
    {
        $this->render('pusta_lista');
    }

    public function lista()
    {
        $this->render('lista');
    }

    public function kasprowy()
    {
        $this->render('kasprowy');
    }

    public function profil()
    {
        $this->render('profil');
    }

    public function add()
    {
        $this->render('add');
    }
}