@extends('backend.layout-backend.main')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('berita', 'active')
@section('title', '| Berita')

@section('judul')
    <h1>Create Data Acara/Kegiatan</h1>
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
                      <h3 class="card-title"><b>Kolom Input</b></h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <form action="{{ url('backend/berita/update/'.$berita->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="judul_berita">Masukan Judul Acara/Kegitan</label>
                                    <input type="text" name="judul_berita" class="form-control @error('judul_berita') ins-invalid @enderror"  value="{{ old('judul_berita') ?? $berita->judul_berita}}" required>
                                    @error('judul_berita')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="user_id">Pilih Reporter</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @foreach($staf as $stafs)
                                            <option value="{{ $stafs->id }}" {{ old('user_id') ?? $berita->user->name == $stafs->name ? 'selected' : '' }}>
                                                {{ $stafs->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="isi_berita">Masukan Summary</label>
                                <textarea id="field" onkeyup="countChar(this)" class="form-control @error('isi_berita') is-invalid @enderror" name="isi_berita"  rows="10" required>
                                    {{ old('isi_berita') ?? $berita->isi_berita }}
                                </textarea>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <img src="{{ Storage::url($berita->foto_berita) }}" alt="" class=" d-flex justify-content-center m-3" style="width: 150px;">
                                    <label for="foto_berita">Masukan Foto Kegiatan</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control @error('foto_berita') is-invalid @enderror" id="foto_berita" name="foto_berita" value="{{ old('foto_berita') }}">
                                    </div>
                                      @error('foto_berita')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="tanggal_berita">Tanggal Pelaksanaan Kegiatan</label>
                                    <input type="date" name="tanggal_berita" id="tanggal_berita" class="form-control @error('tanggal_berita') is-invalid @enderror" value="{{ old('tanggal_berita') ?? $berita->tanggal_berita }}">
                                    @error('tanggal_berita')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label for="alamat_berita">Masukan Alamat Pelaksanaan</label>
                                <textarea id="field" onkeyup="countChar(this)" class="form-control @error('alamat_berita') is-invalid @enderror" name="alamat_berita"  rows="3" required>{{ old('alamat_berita') ?? $berita->alamat_berita }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form> 
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        CKEDITOR.replace( 'isi_berita' );
        CKEDITOR.replace('alamat_berita');
        $("#anggota_id").chosen();
    </script> 
@endsection