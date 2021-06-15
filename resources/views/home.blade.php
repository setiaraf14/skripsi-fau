{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
        })();
    </script>

</head>
<body>

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
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#permohonanKTP">
        Permohonan KTP
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#permohonanKK">
        Permohonan KK
    </button>
        
    <!-- Modal Permohonan KTP-->
    <div class="modal fade" id="permohonanKTP" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Permohonan KTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/permohonan-ktp') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama"><b>Nama</b></label>
                                    <input type="text" class="form-control" name="nama" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan nama.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin"><b>Jenis Kelamin</b></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" required>
                                        <label class="form-check-label">
                                            Laki - Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" required>
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
                                    <input type="number" name="no_kk" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan no kartu keluarga.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="agama"><b>Agama</b></label>
                                    <input type="text" name="agama" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan agama.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ttl"><b>Tempat / Tanggal lahir</b></label>
                                    <input type="text" class="form-control" name="ttl" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan tempat dan tanggal lahir.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status"><b>Status</b></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="kawin" required>
                                        <label class="form-check-label" for="radio-status1">
                                            Kawin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="belum kawin" required>
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
                                        <input class="form-check-input" type="radio" name="kewarganegaraan" value="wni" required>
                                        <label class="form-check-label">
                                            WNI
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kewarganegaraan" value="wna" required>
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
                                    <input type="text" name="pekerjaan" class="form-control" required>
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
                                    <textarea class="form-control" name="alamat" rows="5" required></textarea>
                                    <div class="invalid-feedback">
                                        Silahkan masukan alamat.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal Permohonan KK -->
    <div class="modal fade" id="permohonanKK" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Permohonan KK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/permohonan-kk') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama"><b>Nama</b></label>
                                    <input type="text" class="form-control" name="nama" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan nama.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin"><b>Jenis Kelamin</b></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki-laki" required>
                                        <label class="form-check-label">
                                            Laki - Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" required>
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
                                    <input type="number" name="no_ktp" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan no kartu tanda penduduk anda.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="agama"><b>Agama</b></label>
                                    <input type="text" name="agama" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan agama.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto_suami"><b>Foto Suami</b></label>
                                    <input type="file" class="form-control" name="foto_suami" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan foto suami.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ttl"><b>Tempat / Tanggal lahir</b></label>
                                    <input type="text" class="form-control" name="ttl" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan tempat dan tanggal lahir.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status"><b>Status</b></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="kawin" required>
                                        <label class="form-check-label" for="radio-status1">
                                            Kawin
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="belum kawin" required>
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
                                        <input class="form-check-input" type="radio" name="kewarganegaraan" value="wni" required>
                                        <label class="form-check-label">
                                            WNI
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kewarganegaraan" value="wna" required>
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
                                    <input type="text" name="pekerjaan" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan pekerjaan.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="foto_suami"><b>Foto Istri</b></label>
                                    <input type="file" class="form-control" name="foto_istri" required>
                                    <div class="invalid-feedback">
                                        Silahkan masukan foto istri.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat"><b>Alamat</b></label>
                                    <textarea class="form-control" name="alamat" rows="5" required></textarea>
                                    <div class="invalid-feedback">
                                        Silahkan masukan alamat.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        })
    </script>
</body>
</html>