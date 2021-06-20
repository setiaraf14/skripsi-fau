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
                      <h3 class="card-title">Data Acara/Kegiatan</h3>
                      <a class="btn btn-primary" href="{{ url('backend/berita/create') }}">Tambah Acara/Kegiatan</a>
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

                        <form action="{{ url('backend/berita') }}" method="GET">
                                <div class="row text-center m-3">

                                        <div class="col-md-3">
                                            <input type="text" name="search_judul" class="form-control"
                                            value="{{ isset($filters['search_judul']) ? $filters['search_judul'] : "" }}" placeholder="Search By Judul">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="search_lokasi" class="form-control"
                                            value="{{ isset($filters['search_lokasi']) ? $filters['search_lokasi'] : "" }}" placeholder="Search By Lokasi">
                                        </div>

                                        
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <select name="search_peliput" id="" class="form-control">
                                                    <option value="" disabled selected>-- Pilih Peliput --</option>
                                                    @foreach($users as $user)
                                                    <option value="{{ $user->name }}" {{ isset($filters['search_peliput']) == $user->name ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="input-group">
                                                <button class="btn btn-outline-info btn-xs" type="submit"><i class="fa fa-search"
                                                    aria-hidden="true"></i>
                                                Search</button>
                                            </div>
                                        </div>
                                </div>
                            </form>

                        <div class="table-responsive">
                            <table id="tabel-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Judul</th>
                                    <th>Peliput</th>
                                    <th>Isi</th>
                                    <th>Tanggal Acara</th>
                                    <th>Lokasi</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($berita as $item)
                                    <tr>
                                        <td>{{ $item->judul_berita }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{!! Illuminate\Support\Str::of($item->isi_berita)->limit(20) !!}</td>
                                        <td>{{ $item->tanggal_berita }}</td>
                                        <td>{!! Illuminate\Support\Str::of($item->alamat_berita)->limit(20) !!}</td>
                                        <td>
                                            <a class="btn btn-info m-1" href="{{ url('backend/berita/show/'.$item->id) }}"><i class="fas fa-eye"></i>Show</a>
                                            <a class="btn btn-warning m-1" href="{{ url('backend/berita/edit/'.$item->id) }}"><i class="fas fa-pen"></i>Edit</a>
                                            <a href="{{ url('backend/berita/delete/'. $item->id) }}" class="btn btn-danger m-1"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(isset($item))
                            {{ $berita->links() }}
                        @endif
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