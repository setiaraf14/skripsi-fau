@extends('backend.layout-backend.main')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('user', 'active')
@section('title', '| User')


@section('judul')
    <h1>Tabel Data Ekstrakulikuler</h1>
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
                      <h3 class="card-title">Data User</h3>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Tambah User
                      </button>
                      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">Isi Data User</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            {{-- <form action="{{ route('ekskul.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="nama_ekskul">Masukan Judul Ekskul</label>
                                                <input type="text" name="nama_ekskul" class="form-control @error('nama_ekskul') ins-invalid @enderror"  value="{{ old('nama_ekskul')}}" required>
                                                @error('nama_ekskul')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="summary_ekskul">Masukan Summary</label>
                                                <textarea id="field" onkeyup="countChar(this)" class="form-control @error('summary_ekskul') is-invalid @enderror" name="summary_ekskul"  rows="10" required>
                                                    {{ old('summary_ekskul') }}
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-lg-6">
                                                <label for="foto_ekskul">Masukan Foto Ekskul</label>
                                                <div class="input-group">
                                                    <input type="file" class="form-control @error('foto_ekskul') is-invalid @enderror" id="foto_ekskul" name="foto_ekskul" value="{{ old('foto_ekskul') }}">
                                                </div>
                                                  @error('foto_ekskul')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                  @enderror
                                            </div>
            
                                            <div class="form-group col-lg-6">
                                                <label for="tanggal_ekskul">Tanggal Mulai</label>
                                                <input type="date" name="tanggal_ekskul" id="tanggal_ekskul" class="form-control @error('tanggal_ekskul') is-invalid @enderror" value="{{ old('tanggal_ekskul') }}">
                                                @error('tanggal_ekskul')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form> --}} ...
                          </div>
                        </div>
                      </div>
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
                            <table id="tabel-data" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>Nomor</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @forelse ($ekskul as $ekskuls)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ekskuls->nama_ekskul }}</td>
                                            <td>{{ $ekskuls->tanggal_ekskul }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a class="btn btn-outline-primary m-1" data-toggle="modal" data-target="#showEkskul{{$loop->iteration}}"><i class="far fa-eye"></i></a>
                                                    <div class="modal fade" id="showEkskul{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="showEkskulLabel{{$loop->iteration}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="showEkskulLabel{{$loop->iteration}}">Keterangan Ekskul</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card mb-3" style="max-width: 100%;">
                                                                    <div class="row no-gutters">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 m-2 d-flex justify-content-center">
                                                                                <img src="{{ Storage::url($ekskuls->foto_ekskul) }}" alt="" style="width: 150px; height:150px">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 m-2 d-flex justify-content-center">
                                                                                <table class="table table-bordered">
                                                                                    <tr>
                                                                                        <td>Nama</td>
                                                                                        <td>:</td>
                                                                                        <td>{{ $ekskuls->nama_ekskul }}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Keterangan</td>
                                                                                        <td>:</td>
                                                                                        <td>{!! $ekskuls->summary_ekskul !!}</td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                  </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <a class="btn btn-success m-1" href="{{ route('anggotas.edit', $anggotas->id) }}">></a> 
                                                    <a type="button" class="btn btn-warning m-1" data-toggle="modal" data-target="#editEkskul{{$loop->iteration}}"><i class="fas fa-edit"></i></a>
                                                    <div class="modal fade" id="editEkskul{{$loop->iteration}}" tabindex="-1" role="dialog" aria-labelledby="editEkskulLabel{{$loop->iteration}}" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title" id="showEkskulLabel{{$loop->iteration}}">Update Data Ekstrakuler Baru</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            <form action="{{ route('ekskul.update', $ekskuls->id) }}" method="POST" enctype="multipart/form-data">
                                                                @method('PATCH')
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-12">
                                                                                <label for="nama_ekskul">Masukan Judul Ekskul</label>
                                                                                <input type="text" name="nama_ekskul" class="form-control @error('nama_ekskul') ins-invalid @enderror"  value="{{ old('nama_ekskul') ?? $ekskuls->nama_ekskul}}" required>
                                                                                @error('nama_ekskul')
                                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-12">
                                                                                <label for="summary_ekskul">Masukan Summary</label>
                                                                                <textarea id="field" onkeyup="countChar(this)" class="form-control @error('summary_ekskul') is-invalid @enderror" name="summary_ekskul"  rows="10" required>
                                                                                    {!! old('summary_ekskul') ?? $ekskuls->summary_ekskul !!}
                                                                                </textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="foto_ekskul">Masukan Foto Ekskul</label>
                                                                                <div class="input-group">
                                                                                    <div class="costum-file">
                                                                                        <img src="{{ Storage::url($ekskuls->foto_ekskul) }}" alt="" style="width: 150px;">
                                                                                        <input type="file" class="form-control @error('foto_ekskul') is-invalid @enderror" id="foto_ekskul" name="foto_ekskul" value="{{ old('foto_ekskul') }}">
                                                                                    </div>
                                                                                </div>
                                                                                  @error('foto_ekskul')
                                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                                  @enderror
                                                                            </div>
                                            
                                                                            <div class="form-group col-lg-6">
                                                                                <label for="tanggal_ekskul">Tanggal Mulai</label>
                                                                                <input type="date" name="tanggal_ekskul" id="tanggal_ekskul" class="form-control @error('tanggal_ekskul') is-invalid @enderror" value="{{ old('tanggal_ekskul') ?? $ekskuls->tanggal_ekskul}}">
                                                                                @error('tanggal_ekskul')
                                                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                          </div>
                                                        </div>
                                                      </div>

                                                    <form action="{{ route('ekskul.destroy', $ekskuls->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger m-1"><i class="far fa-trash-alt"></i></button>                              
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <td text-center>Tidak ada Ekstrakulikuler yang ditambahkan</td>
                                    @endforelse
                                </tbody> --}}
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