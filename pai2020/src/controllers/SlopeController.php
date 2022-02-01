<?php

require_once 'AppController.php';

class SlopeController extends AppController {

    public function addSlope(){
        $this->render('add');
    }
}