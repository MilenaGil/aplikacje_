<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('rejestracja', 'DefaultController');
Router::get('menu', 'DefaultController');
Router::get('lista', 'DefaultController');
Router::get('kasprowy', 'DefaultController');
Router::get('profil', 'DefaultController');
Router::get('szukaj', 'SlopeController');
Router::get('add', 'DefaultController');

Router::post('logout', 'SecurityController');
Router::post('register', 'SecurityController');
Router::post('login', 'SecurityController');
Router::post('addSlope', 'SlopeController');
Router::post('search', 'SlopeController');

Router::run($path);
