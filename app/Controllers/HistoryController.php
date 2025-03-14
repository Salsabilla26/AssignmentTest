<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HistoryController extends Controller
{
    public function index()
{
    $client = service('curlrequest');
    $token = session()->get('token');

    if (!$token) {
        return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    try {
        $response = $client->get('https://take-home-test-api.nutech-integrasi.com/transaction/history?offset=0&limit=5', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]
        ]);

        $transactions = json_decode($response->getBody(), true);

        return view('history/index', ['transactions' => $transactions['data']['records'] ?? []]);

    } catch (\Exception $e) {
        return view('history/index', ['transactions' => [], 'error' => $e->getMessage()]);
    }
}

public function loadMore()
{
    $offset = $this->request->getGet('offset') ?? 0;
    $client = service('curlrequest');
    $token = session()->get('token');

    if (!$token) {
        return $this->response->setJSON([]);
    }

    try {
        $response = $client->get("https://take-home-test-api.nutech-integrasi.com/transaction/history?offset={$offset}&limit=5", [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $token
            ]
        ]);

        $transactions = json_decode($response->getBody(), true);
        return $this->response->setJSON($transactions['data']['records'] ?? []);

    } catch (\Exception $e) {
        return $this->response->setJSON(['error' => 'Gagal mengambil data']);
    }
}

}
