<?php
// Basic routing logic
$uri = $_SERVER['REQUEST_URI'];

$base = '/game-db';
$request = str_replace($base, '', $_SERVER['REQUEST_URI']);

switch($request)
{
    case '/':
        require 'src/view/main_view.php';
        break;
    case '/login':
        require 'src/view/login.php';
        break;
    case '/register':
        require 'src/view/register.php';
        break;
    case '/newgame':
        require 'src/view/newgame.php';
        break;
}