<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__.'/../vendor/autoload.php';

use Luna\Core\Installer\InstallChecker;
use Luna\Core\Request;
use Luna\Core\Router;

$checker = new InstallChecker(
    configPath: dirname(__DIR__).'/config/database.php',
    lockPath: dirname(__DIR__).'/storage/installed.lock'
);

$request = new Request();
$router = new Router();

$uri = $request->uri();

if (!$checker->installed() && $uri !== '/installer') {
    header('Location: /installer');
    exit;
}

if ($checker->installed() && $uri === '/installer') {
    header('Location: /');
    exit;
}

require_once dirname(__DIR__).'/routes/web.php';

$router->dispatch($request);
