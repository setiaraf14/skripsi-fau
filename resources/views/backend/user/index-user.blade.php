@extends('backend.layout-backend.main')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('user-role', 'active')
@section('title', '| User')

@section('judul')
    <h1>Tabel Data User</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                      <h3 class="card-title">Data User</h3>
                      <a class="btn btn-primary" href="{{ url('backend/user/create') }}">
                        Tambah User
                      </a>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <div class="col-md-10 mb-3">
                            <form action="{{ url('backend/user') }}" method="GET">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <input type="text" name="search_name" class="form-control"
                                        value="{{ isset($filters['search_name']) ? $filters['search_name'] : "" }}" placeholder="Search By Name">
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <select name="search_role" class="form-control">
                                                <option value="" disabled selected>-- Pilih Status --</option>
                                                <option value="Staff-Kelurahan" {{ isset($filters['search_role']) ? ($filters['search_role'] == 'Staff-Kelurahan' ? 'selected' : '') : '' }}>
                                                    Staff-Kelurahan
                                                </option>
                                                <option value="Ketua-RT" {{ isset($filters['search_role']) ? ($filters['search_role'] == 'Ketua-RT' ? 'selected' : '') : '' }}>
                                                    Ketua-RT
                                                </option>
                                                <option value="Ketua-RW" {{ isset($filters['search_role']) ? ($filters['search_role'] == 'Ketua-RW' ? 'selected' : '') : '' }}>
                                                    Ketua-RW
                                                </option>
                                                <option value="Warga" {{ isset($filters['search_role']) ? ($filters['search_role'] == 'Warga' ? 'selected' : '') : '' }}>
                                                    Warga
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="input-group">
                                            <select name="search_rt" id="" class="form-control">
                                                <option value="" disabled selected>-- Pilih RT --</option>
                                                @foreach(\App\Models\Rt::all() as $rt)
                                                <option value="{{ $rt->rt_name }}" {{ isset($filters['search_rt']) == $rt->rt_name ? 'selected' : '' }}>
                                                    {{ $rt->rt_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="input-group col-md-3 text-right">
                                        <div class="input-group">
                                            <select name="search_rw" id="" class="form-control">
                                                <option value="" disabled selected>-- Pilih RW --</option>
                                                @foreach(\App\Models\Rw::all() as $rw)
                                                <option value="{{ $rw->rw_name }}" {{ isset($filters['search_rw']) == $rw->rw_name ? 'selected' : '' }}>
                                                    {{ $rw->rw_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-info btn-xs" type="submit"><i class="fa fa-search"
                                                        aria-hidden="true"></i>
                                                    Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
                                    <th>RT</th>
                                    <th>RW</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($user as $users)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $users->name }}</td>
                                            <td>{{ $users->rt->rt_name }}</td>
                                            <td>{{ $users->rw->rw_name  }}</td>
                                            <td>{{ $users->role_user }}</td>
                                            <td>{{ $users->email }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ url('backend/user/delete/'.$users->id) }}" class="btn btn-danger m-1"><i class="far fa-trash-alt"></i></a>
                                                    <a href="{{ url('backend/user/edit/'.$users->id) }}" class="btn btn-warning m-1"><i class="fas fa-pen"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <td text-center>Tidak ada User yang ditambahkan</td>
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
@endsection