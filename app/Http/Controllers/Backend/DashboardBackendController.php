<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardBackendController extends Controller
{
    //
    public function index() {
        return view('backend.dashboard-backend');
    }
}
