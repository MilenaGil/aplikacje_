<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url( $path, PHP_URL_PATH);

Routing::get('logo', 'DefaultController');
Routing::get('rejestracja', 'DefaultController');
Routing::get('menu', 'DefaultController');
Routing::get('pusta_lista', 'DefaultController');
Routing::get('lista', 'DefaultController');
Routing::get('kasprowy', 'DefaultController');
Routing::get('profil', 'DefaultController');

Routing::run($path);
