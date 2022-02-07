<?php

require_once 'AppController.php';

class DefaultController extends AppController{

    private $messages = [];

    public function isLog()
    {
        if (!isset($_COOKIE['id_session']))
            return false;
        if (is_null($this->getSessionId()))
        {
            $securityController = new SecurityController();
            $securityController->stopSession();
            $this->messages[] = 'Twoja sesja wygasła!';
            return false;
        }
        return true;
    }

    public function index()
    {
        if (!$this->isLog())
            $this->render('login', ['messages' => $this->messages]);
        else
            $this->menu();

    }

    public function rejestracja()
    {
        if (!$this->isLog())
            $this->render('rejestracja', ['messages' => $this->messages]);
        else
            $this->menu();
    }

    public function menu()
    {
        if ($this->isLog())
            $this->render('menu');
        else
            $this->index();

    }

    public function lista()
    {
        if ($this->isLog())
            $this->render('lista');
        else
            $this->index();
    }

    public function kasprowy()
    {
        if ($this->isLog())
            $this->render('kasprowy');
        else
            $this->index();
    }

    public function profil()
    {
        if ($this->isLog())
            $this->render('profil');
        else
            $this->index();
    }

    public function add()
    {
        if ($this->isLog())
            $this->render('add');
        else
            $this->index();
    }

}