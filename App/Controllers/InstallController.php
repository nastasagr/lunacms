<?php

namespace Luna\App\Controllers;

use Luna\Core\Controller;
use Luna\Core\Request;

class InstallController extends Controller
{
    public function index(Request $request): void
    {
        $this->view('installer/index', [
            'title' => 'LunaCMS Installer',
            'message' => 'Welcome to  Luna CMS',
        ]);
    }
}
