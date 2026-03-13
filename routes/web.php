<?php

use Luna\App\Controllers\InstallController;

/*
 *   Installer Routes
 */
$router->get('/installer', [InstallController::class, 'index']);
$router->post('/installer', [InstallController::class, 'store']);
