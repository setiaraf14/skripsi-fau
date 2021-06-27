@extends('frontend.layout-frontend.main')

{{-- @section('user-role', 'active') --}}
@section('title', '| Detail Berita')

@section('content')
    <div class="row blog-entries element-animate">
        <div class="col-md-12 col-lg-12 main-content p-5">
            <div class="kolom-berita" style="max-width: 100% ;padding: 0; overflow: hidden;">
                <img src="{{ Storage::url($berita->foto_berita) }}" alt="Image" class="img-fluid mb-5" style="width:100% ;margin:auto ;display:block ;max-height: 600px;">
            </div>
                <div class="post-meta">
                    <span class="mr-2">{{ date("F j, Y", strtotime($berita->tanggal_berita))  }} </span> &bullet;
                </div>
            <h1 class="mb-4">{{ $berita->nama_berita }}</h1>
            <div class="post-content-body">
            {!! $berita->isi_berita !!}
            </div>
        </div>
    </div> 
@endsection