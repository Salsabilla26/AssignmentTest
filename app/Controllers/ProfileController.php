<?php

namespace App\Controllers;

class ProfileController extends BaseController
{
    public function view()
    {
        return view('profile/view'); 
    }

    public function edit()
    {
        return view('profile/edit'); 
    }
}
