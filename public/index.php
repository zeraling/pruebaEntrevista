<?php

require_once '../vendor/autoload.php';

session_start();

//$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
//$dotenv->load();

use Aura\Router\RouterContainer;
use WoohooLabs\Harmony\Harmony;
use WoohooLabs\Harmony\Middleware\DispatcherMiddleware;
use WoohooLabs\Harmony\Middleware\HttpHandlerRunnerMiddleware;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;

//se define un controlador de rutas
$routerContainer = new RouterContainer();
// se define una variable para almacenar el mapa de rutas
$map = $routerContainer->getMap();

$map->get('index', '/', ['App\Controllers\IndexController', 'indexAction']);

$map->get('login', '/login', ['App\Controllers\AuthController', 'getLogin']);
$map->get('logout', '/exit', ['App\Controllers\AuthController', 'getLogout']);
$map->post('auth', '/auth', ['App\Controllers\AuthController', 'postLogin']);


$matcher = $routerContainer->getMatcher();

//se define la variable que almacenara todas las petiviones que se hagan
$request = ServerRequestFactory::fromGlobals($_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);

$route = $matcher->match($request);

if (!$route) {
    echo 'No route';
} else {
    try {
        $harmony = new Harmony($request, new Response());
        $harmony->addMiddleware(new HttpHandlerRunnerMiddleware(new SapiEmitter()));

        $harmony->addMiddleware(new \Franzl\Middleware\Whoops\WhoopsMiddleware());
        $harmony->addMiddleware(new \App\Middlewares\AuthenticationMiddleware());
        $harmony->addMiddleware(new Middlewares\AuraRouter($routerContainer));
        $harmony->addMiddleware(new DispatcherMiddleware(null, 'request-handler'));

        $harmony();
    } catch (Exception $e) {

        var_dump($e);

        echo 's';

        //$emitter = new SapiEmitter();
        //$emitter->emit(new Response\EmptyResponse(400));
    } catch (Error $e) {

        var_dump($e);

        echo 'cc';
        //$emitter = new SapiEmitter();
        //$emitter->emit(new Response\EmptyResponse(500));
    }
}
