<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Router::get('', 'DefaultController');
Router::get('rejestracja', 'DefaultController');
Router::get('menu', 'DefaultController');
Router::get('pusta_lista', 'DefaultController');
Router::get('lista', 'DefaultController');
Router::get('kasprowy', 'DefaultController');
Router::get('profil', 'DefaultController');
Router::get('top', 'DefaultController');

Router::post('login', 'SecurityController');

Router::run($path);
