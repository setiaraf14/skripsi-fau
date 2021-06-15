@extends('backend.layout-backend.main')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('permohonan-kk', 'active')
@section('title', '| Permohonan KK')

@section('judul')
    <h1>Edit Data Permohonan KK</h1>
@endsection

@section('ckeditor')
<script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Edit Data Permohonan KK</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        @if(session('message'))
                            <div class="alert alert-{{ session('style') }}" id="alert-notification">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>{{ session('message') }}</h5>
                                    </div>
                                    <div class="col-md-1 text-right">
                                        <span id="close-notification">&times;</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <form action="{{ url('backend/permohonan-kk/edit/' . $permohonanKk->id) }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama"><b>Nama</b></label>
                                            <input type="text" class="form-control" name="nama" value="{{ isset($permohonanKk) ? $permohonanKk->nama : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan nama.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin"><b>Jenis Kelamin</b></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" {{ isset($permohonanKk) ? ($permohonanKk->jenis_kelamin == 'laki-laki' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label">
                                                    Laki - Laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" {{ isset($permohonanKk) ? ($permohonanKk->jenis_kelamin == 'perempuan' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label">
                                                    Perempuan
                                                </label>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih jenis kelamin.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_ktp"><b>No KTP</b></label>
                                            <input type="number" name="no_ktp" class="form-control" value="{{ isset($permohonanKk) ? $permohonanKk->no_ktp : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan no kartu keluarga.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama"><b>Agama</b></label>
                                            <input type="text" name="agama" class="form-control" value="{{ isset($permohonanKk) ? $permohonanKk->agama : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan agama.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto_suami"><b>Foto Suami</b></label>
                                            <br>
                                            <img src="{{ Storage::url($permohonanKk->foto_suami) }}" style="width: 90px; height:100px" alt="">
                                            <input type="file" class="form-control" name="foto_suami">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ttl"><b>Tempat / Tanggal lahir</b></label>
                                            <input type="text" class="form-control" name="ttl" value="{{ isset($permohonanKk) ? $permohonanKk->ttl : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan tempat dan tanggal lahir.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status"><b>Status</b></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="kawin" {{ isset($permohonanKk) ? ($permohonanKk->status == 'kawin' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label" for="radio-status1">
                                                    Kawin
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="belum kawin" {{ isset($permohonanKk) ? ($permohonanKk->status == 'belum kawin' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label" for="radio-status2">
                                                    Belum Kawin
                                                </label>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih status.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label for="kewarganegaraan"><b>Kewarganegaraan</b></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kewarganegaraan" value="wni" {{ isset($permohonanKk) ? ($permohonanKk->kewarganegaraan == 'wni' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label">
                                                    WNI
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kewarganegaraan" value="wna" {{ isset($permohonanKk) ? ($permohonanKk->kewarganegaraan == 'wna' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label">
                                                    WNA
                                                </label>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih kewarganegaraan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="pekerjaan"><b>Pekerjaan</b></label>
                                            <input type="text" name="pekerjaan" class="form-control" value="{{ isset($permohonanKk) ? $permohonanKk->pekerjaan : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan pekerjaan.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto_suami"><b>Foto Istri</b></label>
                                            <br>
                                            <img src="{{ Storage::url($permohonanKk->foto_istri) }}" alt="" style="width: 90px; height:100px">
                                            <input type="file" class="form-control" name="foto_istri">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="alamat"><b>Alamat</b></label>
                                            <textarea class="form-control" name="alamat" rows="5" required>{{ isset($permohonanKk) ? $permohonanKk->alamat : '' }}</textarea>
                                            <div class="invalid-feedback">
                                                Silahkan masukan alamat.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>   
            </div>
        </div>
    </div>
    @section('js-bootstrap')
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    @endsection
    @section('data-table')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#tabel-data').DataTable();
            });
        </script>
    @endsection 
        <script>
            CKEDITOR.replace( 'summary_ekskul' );
        </script>
@endsection