<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\PermohonanKtp;
use App\Models\PermohonanKk;
use App\User;

class DashboardBackendController extends Controller
{
    //
    public function index() {
        $user = User::count();
        $permohonanKtp = PermohonanKtp::where('approve_kelurahan', 0)->count();
        $permohonanKk = PermohonanKk::where('approve_kelurahan', 0)->count();
        $berita = Berita::count();
        return view('backend.dashboard-backend', compact('user', 'permohonanKtp', 'permohonanKk','berita'));
    }
}
