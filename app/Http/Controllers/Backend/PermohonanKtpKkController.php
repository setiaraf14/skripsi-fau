<?php

namespace App\Http\Controllers\Backend;

use App\Models\PermohonanKtp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PermohonanKk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PermohonanKtpKkController extends Controller
{

    // ------------------------- Function permohonan KTP ------------------------------
    public function getPermohonanKtp()
    {
        $permohonanKtp = PermohonanKtp::with(['rt', 'rw']);
        $role = Auth::user()->role_user;
        if($role == "Staff-Kelurahan") {
            $permohonanKtp = $permohonanKtp;
        } else if($role == "Ketua-RW") {
            $rw = Auth::user()->rw_id;
            $permohonanKtp = $permohonanKtp->whereHas('rw',function($q) use($rw){
                $q->where('id', $rw);
            });
        } else {
            $rw = Auth::user()->rw_id;
            $rt = Auth::user()->rt_id;

            $permohonanKtp = $permohonanKtp->whereHas('rt',function($q) use($rt){
                $q->where('id', $rt);
            });
            $permohonanKtp = $permohonanKtp->whereHas('rw',function($q) use($rw){
                $q->where('id', $rw);
            });
        }

        $permohonanKtp = $permohonanKtp->orderBy('id','desc')->get();

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
            PermohonanKtp::create([
                "nama" => $request->nama,
                "user_id" => Auth::user()->id,
                "rt_id" => Auth::user()->rt_id,
                "rw_id" => Auth::user()->rw_id,
                "jenis_kelamin" => $request->jenis_kelamin,
                "no_kk" => $request->no_kk,
                "agama" => $request->agama,
                "ttl" => $request->ttl,
                "status" => $request->status,
                "kewarganegaraan" => $request->kewarganegaraan,
                "pekerjaan" => $request->pekerjaan,
                "alamat" => $request->alamat
            ]);
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

    public function ktpApproveKelurahan($id)
    {
        if ($id) {
            $user = PermohonanKtp::find($id);
            $approve = $user->approve_kelurahan;
            if($approve == false) {
                $user->approve_kelurahan = true;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Approve Permohonan KTP A/N ' . $user->nama . ' Sukses',
                    'style'     => 'info'    
                ]);
            } else {
                $user->approve_kelurahan = false;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Un-approve Permohonan KTP A/N' . $user->nama . 'Sukses',
                    'style'     => 'info'    
                ]);
            }
        }
    }

    public function ktpApproveRw($id)
    {
        if ($id) {
            $user = PermohonanKtp::find($id);
            $approve = $user->approve_rw;
            if($approve == false) {
                $user->approve_rw = true;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Approve Permohonan KTP A/N ' . $user->nama . ' Sukses',
                    'style'     => 'info'    
                ]);
            } else {
                $user->approve_rw = false;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Un-approve Permohonan KTP A/N' . $user->nama . 'Sukses',
                    'style'     => 'info'    
                ]);
            }
        }
    }

    public function ktpApproveRt($id)
    {
        if ($id) {
            $user = PermohonanKtp::find($id);
            $approve = $user->approve_rt;
            if($approve == false) {
                $user->approve_rt = true;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Approve Permohonan KTP A/N ' . $user->nama . ' Sukses',
                    'style'     => 'info'    
                ]);
            } else {
                $user->approve_rt = false;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Un-approve Permohonan KTP A/N' . $user->nama . 'Sukses',
                    'style'     => 'info'    
                ]);
            }
        }
    }

    // ------------------------- Function Permohonan KK -------------------------------
    public function getPermohonanKk()
    {
        // $permohonanKk = PermohonanKk::where([
        //     'rt_id' => Auth::user()->rt_id,
        //     'rw_id' => Auth::user()->rw_id,
        // ])->get();

        $permohonanKk = PermohonanKk::with(['rt', 'rw']);
        $role = Auth::user()->role_user;
        if($role == "Staff-Kelurahan") {
            $permohonanKk = $permohonanKk;
        } else if($role == "Ketua-RW") {
            $rw = Auth::user()->rw_id;
            $permohonanKk = $permohonanKk->whereHas('rw',function($q) use($rw){
                $q->where('id', $rw);
            });
        } else {
            $rw = Auth::user()->rw_id;
            $rt = Auth::user()->rt_id;

            $permohonanKk = $permohonanKk->whereHas('rt',function($q) use($rt){
                $q->where('id', $rt);
            });
            $permohonanKk = $permohonanKk->whereHas('rw',function($q) use($rw){
                $q->where('id', $rw);
            });
        }

        $permohonanKk = $permohonanKk->orderBy('id','desc')->get();

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
            PermohonanKk::create([
                "nama" => $data['nama'],
                "user_id" => Auth::user()->id,
                "rt_id" => Auth::user()->rt_id,
                "rw_id" => Auth::user()->rw_id,
                "jenis_kelamin" => $data['jenis_kelamin'],
                "no_ktp" => $data['no_ktp'],
                "agama" => $data['agama'],
                "ttl" => $data['ttl'],
                "status" => $data['status'],
                "kewarganegaraan" => $data['kewarganegaraan'],
                "pekerjaan" => $data['pekerjaan'],
                "alamat" => $data['alamat'],
                "foto_suami" => $data['foto_suami'],
                "foto_istri" => $data['foto_istri']
            ]);
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

    public function kkApproveKelurahan($id)
    {
        if ($id) {
            $user = PermohonanKk::find($id);
            $approve = $user->approve_kelurahan;
            if($approve == false) {
                $user->approve_kelurahan = true;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Approve Permohonan KK A/N ' . $user->nama . ' Sukses',
                    'style'     => 'info'    
                ]);
            } else {
                $user->approve_kelurahan = false;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Un-approve Permohonan KK A/N' . $user->nama . 'Sukses',
                    'style'     => 'info'    
                ]);
            }
        }
    }

    public function kkApproveRw($id)
    {
        if ($id) {
            $user = PermohonanKk::find($id);
            $approve = $user->approve_rw;
            if($approve == false) {
                $user->approve_rw = true;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Approve Permohonan KK A/N ' . $user->nama . ' Sukses',
                    'style'     => 'info'    
                ]);
            } else {
                $user->approve_rw = false;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Un-approve Permohonan KK A/N' . $user->nama . 'Sukses',
                    'style'     => 'info'    
                ]);
            }
        }
    }

    public function kkApproveRt($id)
    {
        if ($id) {
            $user = PermohonanKk::find($id);
            $approve = $user->approve_rt;
            if($approve == false) {
                $user->approve_rt = true;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Approve Permohonan KTP A/N ' . $user->nama . ' Sukses',
                    'style'     => 'info'    
                ]);
            } else {
                $user->approve_rt = false;
                $user->save();
                return redirect()->back()->with([
                    'message'   => 'Un-approve Permohonan KTP A/N' . $user->nama . 'Sukses',
                    'style'     => 'info'    
                ]);
            }
        }
    }

}
