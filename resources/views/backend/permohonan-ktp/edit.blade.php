@extends('backend.layout-backend.main')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('permohonan-ktp', 'active')
@section('title', '| Permohonan KTP')

@section('judul')
    <h1>Edit Data Permohonan KTP</h1>
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
                        <h3 class="card-title">Edit Data Permohonan KTP</h3>
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
                            <form action="{{ url('backend/permohonan-ktp/edit/' . $permohonanKtp->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama"><b>Nama</b></label>
                                            <input type="text" class="form-control" name="nama" value="{{ isset($permohonanKtp) ? $permohonanKtp->nama : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan nama.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_kelamin"><b>Jenis Kelamin</b></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" {{ isset($permohonanKtp) ? ($permohonanKtp->jenis_kelamin == 'laki-laki' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label">
                                                    Laki - Laki
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" {{ isset($permohonanKtp) ? ($permohonanKtp->jenis_kelamin == 'perempuan' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label">
                                                    Perempuan
                                                </label>
                                                <div class="invalid-feedback">
                                                    Silahkan pilih jenis kelamin.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_kk"><b>No KK</b></label>
                                            <input type="number" name="no_kk" class="form-control" value="{{ isset($permohonanKtp) ? $permohonanKtp->no_kk : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan no kartu keluarga.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="agama"><b>Agama</b></label>
                                            <input type="text" name="agama" class="form-control" value="{{ isset($permohonanKtp) ? $permohonanKtp->agama : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan agama.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ttl"><b>Tempat / Tanggal lahir</b></label>
                                            <input type="text" class="form-control" name="ttl" value="{{ isset($permohonanKtp) ? $permohonanKtp->ttl : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan tempat dan tanggal lahir.
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="status"><b>Status</b></label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="kawin" {{ isset($permohonanKtp) ? ($permohonanKtp->status == 'kawin' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label" for="radio-status1">
                                                    Kawin
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" value="belum kawin" {{ isset($permohonanKtp) ? ($permohonanKtp->status == 'belum kawin' ? 'checked' : '') : '' }} required>
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
                                                <input class="form-check-input" type="radio" name="kewarganegaraan" value="wni" {{ isset($permohonanKtp) ? ($permohonanKtp->kewarganegaraan == 'wni' ? 'checked' : '') : '' }} required>
                                                <label class="form-check-label">
                                                    WNI
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="kewarganegaraan" value="wna" {{ isset($permohonanKtp) ? ($permohonanKtp->kewarganegaraan == 'wna' ? 'checked' : '') : '' }} required>
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
                                            <input type="text" name="pekerjaan" class="form-control" value="{{ isset($permohonanKtp) ? $permohonanKtp->pekerjaan : '' }}" required>
                                            <div class="invalid-feedback">
                                                Silahkan masukan pekerjaan.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="alamat"><b>Alamat</b></label>
                                            <textarea class="form-control" name="alamat" rows="5" required>{{ isset($permohonanKtp) ? $permohonanKtp->alamat : '' }}</textarea>
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