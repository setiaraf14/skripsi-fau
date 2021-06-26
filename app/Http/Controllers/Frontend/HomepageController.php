<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\User;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index(){
        $berita_carousel = Berita::orderBy('created_at', 'Desc')->take(2)->get();
        $berita =  Berita::with(['user'])->orderBy('id', 'Desc');
        $berita = $berita->paginate(4);
        return view('frontend.homepage.index', compact('berita_carousel', 'berita' ));
    }

    public function pelayanan(){
        return view('frontend.homepage.pelayanan');
    }

    public function statusPermohonan()
    {
        $dataKtp = User::findOrFail(Auth::user()->id)->permohonanKtp;
        $dataKk = User::findOrFail(Auth::user()->id)->permohonanKk;
        return view('frontend.homepage.status-permohonan', compact('dataKtp', 'dataKk'));
    }
}
