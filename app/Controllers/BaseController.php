<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Psr\Log\LoggerInterface; 

class BaseController extends Controller
{
    protected $helpers = [];

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, LoggerInterface $logger) // Perbaiki parameter
    {
        parent::initController($request, $response, $logger);

        // Load helpers atau library lain jika dibutuhkan
    }
}
