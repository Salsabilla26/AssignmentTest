<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        return view('Transaction/topup');
    }

    public function payment($amount = 0)
    {
        return view('transaction/payment', ['amount' => $amount]);
    }
}
