@extends('backend.layout-backend.main')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection

@section('user-role', 'active')
@section('title', '| User')

@section('judul')
    <h1>Tabel Data User</h1>
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
                      <h3 class="card-title">Edit User</h3>
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
                        
                        <form method="POST" action="{{ url('backend/user/update/'.$user->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('nama_kegiatan') ?? $user->name}}" required autocomplete="name"
                                        autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rt_id" class="col-md-4 col-form-label text-md-right">RT</label>
                                <div class="col-md-6">
                                    <select name="rt_id" id="rt_id"
                                        class="form-control @error('rt_id') is-invalid @enderror">
                                        <option value="" selected disabled>-Select--</option>
                                        @forelse(\App\Models\Rt::all() as $rt)
                                            <option value="{{ $rt->id }}" {{ old('rt_id') ?? $user->rt->rt_name == $rt->rt_name ? 'selected' : '' }}>
                                                {{ $rt->rt_name }}
                                            </option>
                                        @empty
                                            <option value="" selected disabled>--No Record--</option>
                                        @endforelse
                                    </select>
                                    @error('rt_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rw_id" class="col-md-4 col-form-label text-md-right">RW</label>
                                <div class="col-md-6">
                                    <select name="rw_id" id="rw_id"
                                        class="form-control @error('rw_id') is-invalid @enderror">
                                        <option value="" selected disabled>-Select--</option>
                                        @forelse(\App\Models\Rw::all() as $rw)
                                            <option value="{{ $rw->id }}" {{ old('rw_id') ?? $user->rw->rw_name == $rw->rw_name ? 'selected' : '' }}>{{ $rw->rw_name }}</option>
                                        @empty
                                            <option value="" selected disabled>--No Record--</option>
                                        @endforelse
                                    </select>
                                    @error('rw_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role_user" class="col-md-4 col-form-label text-md-right">Role</label>
                                <div class="col-md-6">
                                    <select name="role_user" id="role_user"
                                        class="form-control @error('role_user') is-invalid @enderror">
                                        <option value="" selected disabled>-Select--</option>
                                        <option value="Staff-Kelurahan" {{ (old('role_user') ?? $user->role_user) == 'Staff-Kelurahan' ? 'selected' : ' ' }}>Staff Kelurahan</option>
                                        <option value="Ketua-RT" {{ (old('role_user') ?? $user->role_user) == 'Ketua-RT' ? 'selected' : ' ' }}>Ketua RT</option>
                                        <option value="Ketua-RW" {{ (old('role_user') ?? $user->role_user) == 'Ketua-RW' ? 'selected' : ' ' }}>Ketua RW</option>
                                        <option value="warga" {{ (old('role_user') ?? $user->role_user) == 'warga' ? 'selected' : ' ' }}>Warga</option>
                                    </select>
                                    @error('role_user')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telepon"
                                    class="col-md-4 col-form-label text-md-right">{{ __('telepon') }}</label>
    
                                <div class="col-md-6">
                                    <input id="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror"
                                        name="telepon" value="{{ old('telepon') ?? $user->telepon}}" required autocomplete="telepon"
                                        autofocus>
    
                                    @error('telepon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat_anggota" class="col-md-4 col-form-label text-md-right">Alamat</label>
                                <div class="col-md-6">
                                    <textarea id="field" class="form-control @error('alamat') is-invalid @enderror" name="alamat"  rows="3" required>
                                        {{ old('alamat') ?? $user->alamat }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6 d-flex justify-content-center">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email')??$user->email }}" required
                                        autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">Password Baru</label>
    
                                <div class="col-md-6 d-flex justify-content-center">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password"><a class="btn btn-info" onclick="lihatPass()"><i class="fa fa-eye" aria-hidden="true"></i></a>
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6 d-flex justify-content-center">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"><a class="btn btn-info" onclick="lihatConfirmPass()"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                        
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
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
            
            function editEmail()
            {
                var email = document.getElementById('email');
                email.setAttribute('disabled');
            }

            function lihatPass(){
                var password = document.getElementById('password');
                var atrb = password.getAttribute('type');

                if(atrb === 'password'){
                password.setAttribute('type', 'text');
                }else{
                password.setAttribute('type', 'password');
                }
                return false;
            }

            function lihatConfirmPass(){
                var confirm = document.getElementById('password-confirm');
                var beding = confirm.getAttribute('type');

                if(beding === 'password'){
                confirm.setAttribute('type', 'text');
                }else{
                confirm.setAttribute('type', 'password');
                }
                return false;

            }
        </script>
@endsection