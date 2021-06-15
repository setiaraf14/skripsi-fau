<?php

namespace App\Http\Controllers\Backend;

use App\Models\PermohonanKtp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PermohonanKk;
use Illuminate\Support\Facades\Storage;

class PermohonanKtpKkController extends Controller
{

    // ------------------------- Function permohonan KTP ------------------------------
    public function getPermohonanKtp()
    {
        $permohonanKtp = PermohonanKtp::all();
        return view('backend.permohonan-ktp.index', compact('permohonanKtp'));
    }

    public function storeKtp(Request $request, $id = null)
    {
        if ($id) {
            $data = PermohonanKtp::find($id);
            $data->update($request->all());
            return redirect(url('backend/permohonan-ktp'))->with([
                'message'   => 'Data Berhasil Diperbarui',
                'style'     => 'info'    
            ]);
        } else {
            PermohonanKtp::create($request->all());
            return redirect()->back()->with([
                'message'   => 'Permohonan KTP Anda Sudah terkirim',
                'style'     => 'info'    
            ]);
        }
    }

    public function formEditKtp($id)
    {
        $permohonanKtp = PermohonanKtp::find($id);
        return view('backend.permohonan-ktp.edit', compact('permohonanKtp'));
    }

    public function deletePermohonanKtp($id)
    {
        $permohonanKtp = PermohonanKtp::find($id);
        $permohonanKtp->delete();
        return redirect()->back()->with([
            'message'   => 'Delete Permohonan KTP Success',
            'style'     => 'info'    
        ]);
    }

    // ------------------------- Function Permohonan KK -------------------------------
    public function getPermohonanKk()
    {
        $permohonanKk = PermohonanKk::all();
        return view('backend.permohonan-kk.index', compact('permohonanKk'));
    }

    public function storeKk(Request $request, $id = null)
    {
        $data = $request->all();
        if ($id) {
            $findById = PermohonanKk::find($id);
            if (isset($data['foto_suami'])) {
                Storage::delete('public/'.$findById->foto_suami);
                $data['foto_suami'] = $request->file('foto_suami')->store('assets/foto', 'public');
            }
            if (isset($data['foto_istri'])) {
                Storage::delete('public/'.$findById->foto_istri);
                $data['foto_istri'] = $request->file('foto_istri')->store('assets/foto', 'public');
            }
            $findById->update($data);
            return redirect(url('backend/permohonan-kk'))->with([
                'message'   => 'Data Berhasil Diperbarui',
                'style'     => 'info'    
            ]);
        } else {
            $data['foto_suami'] = $request->file('foto_suami')->store('assets/foto', 'public');
            $data['foto_istri'] = $request->file('foto_istri')->store('assets/foto', 'public');
            PermohonanKk::create($data);
            return redirect()->back()->with([
                'message'   => 'Permohonan Kartu Keluarga Anda Sudah terkirim',
                'style'     => 'info'    
            ]);
        }
    }

    public function formEditKk($id)
    {
        $permohonanKk = PermohonanKk::find($id);
        return view('backend.permohonan-kk.edit', compact('permohonanKk'));
    }

    public function deletePermohonanKk($id)
    {
        $permohonanKk = PermohonanKk::find($id);
        Storage::delete('public/'.$permohonanKk->foto_suami);
        Storage::delete('public/'.$permohonanKk->foto_istri);
        $permohonanKk->delete();
        return redirect()->back()->with([
            'message'   => 'Delete Permohonan KK Success',
            'style'     => 'info'    
        ]);
    }

}
