@extends('frontend.layout-frontend.main')

{{-- @section('user-role', 'active') --}}
@section('title', '| Home')

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-start">
            <div class="col-lg-8 md-8 sm-8">
               <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                   <ol class="carousel-indicators">
                       @foreach ($berita_carousel as $item)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                       @endforeach
                   </ol>
                   <div class="carousel-inner">
                        @foreach ($berita_carousel as $item)
                            <div class="carousel-item {{ $loop->first ? ' active' : '' }} border border-warning">
                                <div style="overflow: hidden; padding: 0; max-width: 100%;">
                                    <img class="d-block w-100" src="{{Storage::url($item->foto_berita)}}" alt="First slide" style="max-height: 450px; display: block; margin: auto;">
                                </div>
                                <div class="carousel-caption d-none d-md-block mb-5">
                                    <a href="{{ url('/berita/detail/'.$item->id) }}" style="color: white;">
                                        <h3>{{ $item->judul_berita }}</h3>
                                        <p>{!! Illuminate\Support\Str::of($item->isi_berita)->limit(30) !!}</p>
                                    </a> 
                                </div>
                            </div>
                        @endforeach
                   </div>
                   <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                   <span class="carousel-control-prev-icon bg-warning" aria-hidden="true"></span>
                   <span class="sr-only">Previous</span>
                   </a>
                   <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                   <span class="carousel-control-next-icon bg-warning" aria-hidden="true"></span>
                   <span class="sr-only">Next</span>
                   </a>
               </div>
           </div>
           

           <div class="col-lg-4 md-4 sm-4 mt-1">
               <div class="title-side mb-2 bg-success p-1">
                    <h2 style="color:white;"><b>Pelayanan Online</b></h2>
               </div>
               <div class="icon-box bg-warning p-1 m-1">
                    <h4><a href="{{ url('/pelayanan') }}" class="text-success">Permohonan KTP/KK</a></h4>
                    <p><b>Pembuatan permohonan KTP/KK jauh lebih mudah, dengan mengurangi aktivitas di luar selama pandemi</b></p>
                </div>
           </div>

        </div>

        <section class="berita-terakhir">
            <div class="row">
                <div class="col-lg-12 md-12 sm-12 text-center">
                    <h1><b>Berita Terakhir</b></h1>
                </div>
            </div>
            <br><br>
            <div class="row d-flex justify-content-center">
                @foreach ($berita as $item)
                    <div class="col-lg-2 md-2 sm-2 m-5">
                        <div class="card bg-warning" style="width: 15rem;-webkit-box-shadow: 5px 5px 15px 5px #000000; box-shadow: 5px 5px 15px 5px #000000;">
                            <div class="kolom-berita" style="max-width: 350px ;padding: 0; overflow: hidden;">
                                <img class="card-img-top" src="{{Storage::url($item->foto_berita)}}" alt="Card image cap" style="width:100% ;margin:auto ;display:block ;max-height: 200px;">
                            </div>
                            <div class="card-body">
                                <a href="{{ url('/berita/detail/'.$item->id) }}" style="color: white;">
                                    <h5 class="card-title">{!! Illuminate\Support\Str::of($item->judul_berita)->limit(20) !!}</h5>
                                    <span class="mr-2">{{ date('d/m/Y',strtotime($item->tanggal_berita)) }}</span> &bullet;
                                    <p>{!! Illuminate\Support\Str::of($item->summary_berita)->limit(20) !!}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 main-content m-2">
                    <div class="paginatiion d-flex justify-content-center text-center">
                      {{ $berita->links() }}
                    </div>
                </div>
              </div>
            </div>
            
        </section>

    </div>
@endsection