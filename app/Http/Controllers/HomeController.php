<?php

namespace App\Http\Controllers;

use App\DataTables\User\TripDatatable;
use App\DataTables\User\TripinDatatable;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Trip;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  

}
