<?php
// Basic routing logic
$uri = $_SERVER['REQUEST_URI'];

$base = '/game-db';
$request = str_replace($base, '', $_SERVER['REQUEST_URI']);

switch($request)
{
    case '/':
        require 'src/View/main_view.php';
        break;
    case '/login':
        require 'src/View/login.php';
        break;
    case '/register':
        require 'src/View/register.php';
        break;
    case '/newgame':
        require 'src/View/newgame.php';
        break;
}