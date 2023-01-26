<?php

use Aura\SqlQuery\QueryFactory;
use DI\ContainerBuilder;
use League\Plates\Engine;
use Delight\Auth\Auth;
use FastRoute\RouteCollector;


$builder = new ContainerBuilder();
$builder->addDefinitions([
    Engine::class => function () {
        return new Engine('../app/views');
    },
    PDO::class => function () {
        $driver = 'mysql';
        $host = 'localhost';
        $db_name = 'final';
        $username = "root";
        $password = "";

        return new PDO("$driver:host=$host; dbname=$db_name", $username, $password);
    },
    Swift_Mailer::class => function () {
        $transport = (new Swift_SmtpTransport(
            "smtp.gmail.com",
            587,
            "tls"
        ))
            ->setUsername("toichuev.adilet.kubat@gmail.com")
            ->setPassword("eukelkqxfbwsrxce");
        return new Swift_Mailer($transport);
    },
    Auth::class => function ($container) {
        return new Auth($container->get('PDO'));
    },
    QueryFactory::class => function () {
        return new QueryFactory('mysql');
    },
]);
$container = $builder->build();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\controllers\HomeController', 'usersShow']);

    $r->addRoute('GET', '/about', ['App\controllers\HomeController', 'about']);

    $r->addRoute('GET', '/login', ['App\controllers\LoginController', 'loginShow']);
    $r->addRoute('POST', '/login', ['App\controllers\LoginController', 'login']);
    $r->addRoute('GET', '/logout', ['App\controllers\LoginController', 'logout']);

    $r->addRoute('GET', '/register', ['App\controllers\RegisterController', 'registerShow']);
    $r->addRoute('POST', '/register', ['App\controllers\RegisterController', 'register']);

    $r->addRoute('GET', '/user/{id:\d+}/media', ['App\controllers\MediaController', 'mediaShow']);
    $r->addRoute('POST', '/user/{id:\d+}/media', ['App\controllers\MediaController', 'media']);

    $r->addRoute('GET', '/user/{id:\d+}/security', ['App\controllers\SecurityController', 'securityShow']);
    $r->addRoute('POST', '/user/{id:\d+}/security_password', ['App\controllers\SecurityController', 'security_password']);
    $r->addRoute('POST', '/user/{id:\d+}/security_email', ['App\controllers\SecurityController', 'security_email']);

    $r->addRoute('GET', '/user/{id:\d+}/edit', ['App\controllers\UpdateController', 'editShow']);
    $r->addRoute('POST', '/user/{id:\d+}/edit', ['App\controllers\UpdateController', 'edit']);

    $r->addRoute('GET', '/user/{id:\d+}/status', ['App\controllers\StatusController', 'statusShow']);
    $r->addRoute('POST', '/user/{id:\d+}/status', ['App\controllers\StatusController', 'status']);

    $r->addRoute('GET', '/user/{id:\d+}/profile', ['App\controllers\ProfileController', 'profileShow']);

    $r->addRoute('GET', '/user/{id:\d+}/delete', ['App\controllers\DeleteProfileController', 'delete']);

    $r->addRoute('GET', '/password-recovery/form', ['App\controllers\ResetPasswordController', 'showSetForm']);
    $r->addRoute('GET', '/password-recovery', ['App\controllers\ResetPasswordController', 'showForm']);
    $r->addRoute('POST', '/password-recovery/recovery', ['App\controllers\ResetPasswordController', 'recovery']);
    $r->addRoute('POST', '/password-recovery/change', ['App\controllers\ResetPasswordController', 'change']);

    $r->addRoute('GET','/verify_email', ['App\controllers\VerificationController', 'verify']);

    $r->addGroup('/admin', function (RouteCollector $r) {

        $r->addRoute('GET', '/', ['App\controllers\admin\HomeController', 'usersShow']);

        $r->addRoute('GET', '/create_user', ['App\controllers\admin\CreateUserPage', 'createShow']);
        $r->addRoute('POST', '/create_user', ['App\controllers\admin\CreateUserPage', 'create']);

        $r->addRoute('GET', '/user/{id:\d+}/media', ['App\controllers\admin\MediaController', 'mediaShow']);
        $r->addRoute('POST', '/user/{id:\d+}/media', ['App\controllers\admin\MediaController', 'media']);

        $r->addRoute('GET', '/user/{id:\d+}/security', ['App\controllers\admin\SecurityController', 'securityShow']);
        $r->addRoute('POST', '/user/{id:\d+}/security_password', ['App\controllers\admin\SecurityController', 'security_password']);
        $r->addRoute('POST', '/user/{id:\d+}/security_email', ['App\controllers\admin\SecurityController', 'security_email']);

        $r->addRoute('GET', '/user/{id:\d+}/edit', ['App\controllers\admin\UpdateController', 'editShow']);
        $r->addRoute('POST', '/user/{id:\d+}/edit', ['App\controllers\admin\UpdateController', 'edit']);

        $r->addRoute('GET', '/user/{id:\d+}/status', ['App\controllers\admin\StatusController', 'statusShow']);
        $r->addRoute('POST', '/user/{id:\d+}/status', ['App\controllers\admin\StatusController', 'status']);

        $r->addRoute('GET', '/user/{id:\d+}/profile', ['App\controllers\admin\ProfileController', 'profileShow']);

        $r->addRoute('GET', '/user/{id:\d+}/delete', ['App\controllers\admin\DeleteProfileController', 'delete']);
    });
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        abort(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        abort(405);
        break;
    case FastRoute\Dispatcher::FOUND:
        $container->call($routeInfo[1], $routeInfo[2]);
        break;
}
