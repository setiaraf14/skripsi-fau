<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{

    public function testing(Request $request)
    {
        $filters = $request->only(['search_judul', 'search_lokasi', 'search_peliput']);
        $berita = $this->getFilters($filters);
        dd($berita, 'testing');
    }

    public function index(Request $request){
        $filters = $request->only(['search_judul', 'search_lokasi', 'search_peliput']);
        $berita = $this->getFilters($filters);
        $users = User::with([])->where('role_user', 'Staff-Kelurahan')->get();
        return view('backend.berita.index', compact('berita', 'filters', 'users'));
    }

    public function getFilters($filter){
        $data = Berita::with(['user']);

        if(!empty($filter['search_judul'])){
            $data = $data->where('judul_berita','LIKE','%'.$filter['search_judul'].'%');
        }

        if(!empty($filter['search_lokasi'])){
            $data = $data->where('alamat_berita','LIKE','%'.$filter['search_lokasi'].'%');
        }

        if(!empty($filter['search_peliput'])){
            $data = $data->whereHas('user',function($q) use($filter){
                $q->where('name', $filter['search_peliput']);
            });
        } 

        $data->orderBy('id','desc');
        return $data->paginate(10);
    }

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
