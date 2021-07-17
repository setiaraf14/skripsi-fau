@extends('backend.layout-backend.main')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('permohonan-ktp', 'active')
@section('title', '| Permohonan KTP')

@section('judul')
    <h1>Tabel Data Permohonan KTP</h1>
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
                        <h3 class="card-title">Data Permohonan KTP</h3>
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
                                        <th>Tempat/Tangal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Status</th>
                                        <th>No KK</th>
                                        <th>Kewarganegaraan</th>
                                        <th>Agama</th>
                                        <th>Pekerjaan</th>
                                        <th>Alamat</th>
                                        <th>Approve</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($permohonanKtp as $ktp)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ktp->nama }}</td> 
                                            <td>{{ $ktp->ttl }}</td>
                                            <td>{{ $ktp->jenis_kelamin }}</td>
                                            <td>{{ $ktp->status }}</td>
                                            <td>{{ $ktp->no_kk }}</td>
                                            <td>{{ $ktp->kewarganegaraan }}</td>
                                            <td>{{ $ktp->agama }}</td>
                                            <td>{{ $ktp->pekerjaan }}</td>
                                            <td>{{ $ktp->alamat }}</td>
                                            <td>
                                                @if (Auth::user())
                                                    @if (Auth::user()->role_user == 'Staff-Kelurahan')
                                                        @if ($ktp->approve_rw == 0)
                                                                @if ($ktp->approve_rt == 0)
                                                                    <p>Waiting Aprove RT</p>
                                                                @else
                                                                    <p>Waiting Aprove RW</p>
                                                                @endif
                                                        @else
                                                            @if ($ktp->approve_kelurahan <> true)
                                                                <a href="{{ url('backend/ktp/approve-kelurahan/'.$ktp->id) }}" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Approve</a>
                                                            @else
                                                            <a href="{{ url('backend/ktp/approve-kelurahan/'.$ktp->id) }}" class="btn btn-warning btn-sm "><i class="fas fa-exclamation-triangle"></i> Un-Approve</a>
                                                            @endif
                                                        @endif
                                                    @elseif(Auth::user()->role_user == 'Ketua-RW')
                                                        @if ($ktp->approve_rt == 0)
                                                            <p>Waiting Aprove RT</p>
                                                        @else
                                                            @if ($ktp->approve_rw <> true)
                                                            <a href="{{ url('backend/ktp/approve-rw/'.$ktp->id) }}" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Approve</a>
                                                            @else
                                                                <a href="{{ url('backend/ktp/approve-rw/'.$ktp->id) }}" class="btn btn-warning btn-sm "><i class="fas fa-exclamation-triangle"></i> Un-Approve</a>
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if ($ktp->approve_rt <> true)
                                                            <a href="{{ url('backend/ktp/approve-rt/'.$ktp->id) }}" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Approve</a>
                                                        @else
                                                            <a href="{{ url('backend/ktp/approve-rt/'.$ktp->id) }}" class="btn btn-warning btn-sm "><i class="fas fa-exclamation-triangle"></i> Un-Approve</a>
                                                        @endif
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ url('backend/permohonan-ktp/edit/'. $ktp->id) }}" class="btn btn-warning mr-1"><i class="fas fa-pen"></i></a>
                                                    <a href="{{ url('backend/permohonan-ktp/delete/'. $ktp->id) }}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan="12" class="text-center">Tidak Ada Data Permohonan Ktp</td>
                                    @endforelse
                                </tbody>
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