<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use CodeIgniter\HTTP\RequestInterface;

class AuthController extends Controller
{
    use ResponseTrait; 

    protected $client;

    public function __construct()
    {
        $this->client = service('curlrequest');
    }

    // **Tampilkan Halaman Login**
    public function index()
    {
        return view('auth/login'); 
    }

    // **API LOGIN**
    public function login()
    {
        $request = service('request');
    
    
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Method Not Allowed'
            ])->setStatusCode(405);
        }
   
        $json = $this->request->getJSON();
        $email = $json->email ?? null;
        $password = $json->password ?? null;
    
        if (empty($email) || empty($password)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Email dan password wajib diisi.'
            ])->setStatusCode(400);
        }
    
       
        $apiUrl = 'https://take-home-test-api.nutech-integrasi.com/login';
    
        try {
            $response = $this->client->post($apiUrl, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'email' => $email,
                    'password' => $password
                ]
            ]);
    
            $result = json_decode($response->getBody(), true);
    
            if (isset($result['status']) && $result['status'] == 0) {
                session()->set([
                    'token' => $result['data']['token'],
                    'logged_in' => true
                ]);
    
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Login berhasil!',
                    'redirect' => site_url('home') 
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => $result['message'] ?? 'Login gagal.'
                ])->setStatusCode(401);
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghubungi server: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    // **API REGISTRASI**
    public function register()
    {
        $request = service('request');

        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $confirm_password = $request->getPost('confirm_password');

        if (empty($email) || empty($password) || empty($confirm_password)) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Semua field wajib diisi.'
            ], 400);
        }

        if ($password !== $confirm_password) {
            return $this->respond([
                'status' => 'error',
                'message' => 'Konfirmasi password tidak cocok.'
            ], 400);
        }

        $apiUrl = 'https://api-doc-tht.nutech-integrasi.com/registration';
        $response = $this->client->post($apiUrl, [
            'form_params' => [
                'email' => $email,
                'password' => $password
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        if (isset($result['status']) && $result['status'] == 'success') {
            return $this->respond([
                'status' => 'success',
                'message' => 'Registrasi berhasil, silakan login!'
            ], 201);
        } else {
            return $this->respond([
                'status' => 'error',
                'message' => $result['message'] ?? 'Registrasi gagal.'
            ], 400);
        }
    }

    // **LOGOUT**
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
