<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ratings;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        return view('backend.rating.index');
    }

    public function storeRating(Request $request)
    {
        Ratings::create([
            'user_id' => Auth::user()->id,
            'rates' => $request['rates']
        ]);
        return redirect()->back()->with([
            'message'   => 'Terima kasih atas penilaian nya',
            'style'     => 'info'    
        ]);
    }
}
