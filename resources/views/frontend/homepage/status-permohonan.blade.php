@extends('frontend.layout-frontend.main')

@section('title', '| Home')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-1">
                <div class="card-body bg-primary text-center">
                    <span class="font-weight-bold text-white">Table permohonan KTP</span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tempat tanggal lahir</th>
                            <th scope="col">Jenis kelamin</th>
                            <th scope="col">Status</th>
                            <th scope="col">Kewarganegaraan</th>
                            <th scope="col">Pekerjaan</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No KK</th>
                            <th scope="col">Status Permohonan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataKtp as $ktp)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $ktp->nama }}</td>
                                <td>{{ $ktp->ttl }}</td>
                                <td>{{ $ktp->jenis_kelamin }}</td>
                                <td>{{ $ktp->status }}</td>
                                <td>{{ $ktp->kewarganegaraan }}</td>
                                <td>{{ $ktp->pekerjaan }}</td>
                                <td>{{ $ktp->agama }}</td>
                                <td>{{ $ktp->alamat }}</td>
                                <td>{{ $ktp->no_kk }}</td>
                                @if ($ktp->approve_rt == false || $ktp->approve_rw == false || $ktp->approve_kelurahan == false)
                                    <td>
                                        <h6><span class="badge badge-warning">Sedang diproses ..</span></h6>
                                    </td>
                                @elseif($ktp->approve_rt == true && $ktp->approve_rw == true && $ktp->approve_kelurahan == true)
                                    <td>
                                        <h6><span class="badge badge-success">Kartu tanda penduduk/(KTP) anda sudah selesai, Silahkan ambil di kecamatan anda ..</span></h6>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <td colspan="14" class="text-center">Tidak Ada Data Permohonan KTP ..</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card mb-1">
                <div class="card-body bg-primary text-center">
                    <span class="font-weight-bold text-white">Table permohonan KK</span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tempat tanggal lahir</th>
                            <th scope="col">Jenis kelamin</th>
                            <th scope="col">Status</th>
                            <th scope="col">Kewarganegaraan</th>
                            <th scope="col">Pekerjaan</th>
                            <th scope="col">Agama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">Foto suami</th>
                            <th scope="col">Foto istri</th>
                            <th scope="col">Status Permohonan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataKk as $kk)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $kk->nama }}</td>
                                <td>{{ $kk->ttl }}</td>
                                <td>{{ $kk->jenis_kelamin }}</td>
                                <td>{{ $kk->status }}</td>
                                <td>{{ $kk->kewarganegaraan }}</td>
                                <td>{{ $kk->pekerjaan }}</td>
                                <td>{{ $kk->agama }}</td>
                                <td>{{ $kk->alamat }}</td>
                                <td>{{ $kk->no_ktp }}</td>
                                <td>
                                    <img src="{{ Storage::url($kk->foto_suami) }}" width="50">
                                </td>
                                <td>
                                    <img src="{{ Storage::url($kk->foto_istri) }}" width="50">
                                </td>
                                @if ($kk->approve_rt == false || $kk->approve_rw == false || $kk->approve_kelurahan == false)
                                    <td>
                                        <h6><span class="badge badge-warning">Sedang diproses ..</span></h6>
                                    </td>
                                @elseif($kk->approve_rt == true && $kk->approve_rw == true && $kk->approve_kelurahan == true)
                                    <td>
                                        <h6><span class="badge badge-success">Kartu Keluarga ( KK ) anda sudah selesai, Silahkan ambil di kecamatan anda ..</span></h6>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <td colspan="14" class="text-center">Tidak Ada Data Permohonan Kartu Keluarga ..</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection