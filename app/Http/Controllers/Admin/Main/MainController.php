<?php

namespace App\Http\Controllers\Admin\Main;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
}
