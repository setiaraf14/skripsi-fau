@extends('backend.layout-backend.main')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('berita', 'active')
@section('title', '| Berita')

@section('judul')
    <h1>Tabel Data Acara/Kegiatan</h1>
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
                      <h3 class="card-title">Detail Data Acara/Kegiatan</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">

                        <div class="foto-kegiatan text-center m-3">
                            <img src="{{ Storage::url($berita->foto_berita) }}" alt="" class="card-img-top" style="width: 600px">
                            <br><br>
                            <h2>{{ $berita->judul_berita }}</h2>
                        </div>

                        <div class="aksi d-flex justify-content-end">
                            <a class="btn btn-success m-1" href="{{ url('backend/berita/edit/'.$berita->id) }}"><i class="fas fa-edit"> Edit Kegiatan</i></a>
                        </div>

                        <div class="content d-flex justify-content-center">
                            <table class="table table-bordered">
                                <tr>
                                    <td><h5>Peliput</h5></td>
                                    <td>:</td>
                                    <td><h5>{{ $berita->user->name }}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Tanggal Pelaksanaan</h5></td>
                                    <td>:</td>
                                    <td><h5>{{ $berita->tanggal_berita }}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Lokasi Kegiatan</h5></td>
                                    <td>:</td>
                                    <td><h5>{!! $berita->alamat_berita !!}</h5></td>
                                </tr>
                                <tr>
                                    <td><h5>Isi Kegiatan</h5></td>
                                    <td>:</td>
                                    <td><h5>{!! $berita->isi_berita !!}</h5></td>
                                </tr>
                            </table>
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
@endsection