<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    protected $berita;

    public function __construct() 
    {
        $this->berita = new Berita();
    }

    public function index(){
        $data = Berita::with(['user']);
        $berita = $data->get();
        return view('backend.berita.index', compact('berita'));
    }

    // public function getFilters(){
    //     $data = Berita::with(['user']);

    //     if(!empty($filter['search_name'])){
    //         $data = $data->where('name','LIKE','%'.$filter['search_name'].'%');
    //     }
    //     if(!empty($filter['search_rt'])){
    //         $data = $data->whereHas('rt',function($q) use($filter){
    //             $q->where('rt_name', $filter['search_rt']);
    //         });
    //     }

    //     if(!empty($filter['search_rw'])){
    //         $data = $data->whereHas('rw',function($q) use($filter){
    //             $q->where('rw_name', $filter['search_rw']);
    //         });
    //     } 

    //     $data->orderBy('id','desc');
    //     return $data->paginate(10);
    // }

    public function create(Request $request){
        $staf = User::with([])->where('role_user', 'Staff-Kelurahan')->get();
        return view('backend.berita.create', compact('staf'));
    }

    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'judul_berita' => 'required|min:10',
            'user_id' => 'required',
            'isi_berita' => 'required',
            'foto_berita' => 'image|max:3000',
            'tanggal_berita' => 'required',
            'alamat_berita' => 'required'
        ]);

        $validasiData['foto_berita'] = $request->file('foto_berita')->store('asset/berita','public');
        Berita::create($validasiData);
        return redirect('backend/berita')->with([
            'message' => 'Success Saving Acara/Kegiatan',
            'style' => 'info'
        ]);
    }

    public function show(Request $request)
    {
        $berita = Berita::with(['user'])->where('id', $request->id)->first();
        return view('backend.berita.show', compact('berita'));
    }

    public function edit(Request $request){
        $berita = Berita::with(['user'])->where('id', $request->id)->first();
        $staf = User::with([])->where('role_user', 'Staff-Kelurahan')->get();
        return view('backend.berita.edit', compact('berita', 'staf'));
    }

    public function update(Request $request, Berita $berita)
    {
        $validasiData = $request->validate([
            'judul_berita' => 'required|min:10',
            'user_id' => 'required',
            'isi_berita' => 'required',
            'foto_berita' => 'image|max:3000',
            'tanggal_berita' => 'required',
            'alamat_berita' => 'required'
        ]);

        $dataId = Berita::with(['user'])->where('id', $request->id)->first();
        $data = $request->all();
        if($request->foto_berita){
            Storage::delete('public/'.$dataId->foto_kegiatan);
            $data['foto_berita'] = $request->file('foto_berita')->store('asset/berita','public');
        }
        $dataId->update($data);
        return redirect('backend/berita')->with([
            'message' => 'Success Update Acara/Kegiatan',
            'style' => 'info'
        ]);
    }

    public function delete(Request $request)
    {
        $berita = Berita::with(['user'])->where('id', $request->id)->first();
        Storage::delete('public/'.$berita->foto_berita);
        $berita->delete();
        return redirect('backend/berita')->with([
            'message' => 'Success Delete Acara/Kegiatan',
            'style' => 'info'
        ]);
    }
}
