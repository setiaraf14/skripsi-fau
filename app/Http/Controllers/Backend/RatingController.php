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
        $ratings = Ratings::all();
        if (count($ratings) > 0) {
            $totalNilai = 0;
            foreach($ratings as $rating){
                $totalNilai += $rating->rates;
            }
            $nilaiRataRata = $totalNilai / count($ratings);
        } else {
            $nilaiRataRata = 0;
        }
        return view('backend.rating.index', compact('ratings', 'nilaiRataRata'));
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
