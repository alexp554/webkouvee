@extends('layout/main')

@section('title', 'Pegawai')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
            
                        <h1 class="text-center">Daftar Pegawai</h1>

                        <div class="panel-body">
                            <div class="text-right">
                                <a href="/pegawai/create" class="btn btn-warning">Tambah Pegawai</a>
                            </div>
                            <form action="/search_pegawai" method="get">
                                <div class="input-group ukuran">
                                    <input type="search" name="search" class="form-control" placeholder="Cari nama pegawai">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                            <div class="text-right">
                                <a href="/pegawai" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                            </div>
                            @if(session('status'))
                                <div class="alert alert-success text-center">
                                    {{session('status')}}
                                </div>
                            @endif
                            <br>
                                <table class="table table-striped">
                                    <thead class="thead">
                                        <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Nomor Telephone</th>
                                        <th scope="col">Tanggal Lahir Pegawai</th>
                                        <th scope="col">Aksi</th>
                                        </tr>
                                    <thead>
                                    <tbody>
                                        @foreach( $pegawai as $pegawai)
                                        <tr>
                                                <th scope="row">{{ $loop->iteration}}</th>
                                                <td>{{ $pegawai-> nama_pegawai}}</td>
                                                <td>{{ $pegawai-> nama_role}}</td>
                                                <td>{{ $pegawai-> alamat_pegawai}}</td>
                                                <td>{{ $pegawai-> nomor_telepon_pegawai}}</td>
                                                <td>{{ $pegawai-> tanggal_lahir_pegawai}}</td>
                                                <td>
                                                    <a href="/pegawai/{{ $pegawai->id_pegawai}}" class="btn btn-success btn-sm">Detail</a>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
  .ukuran{
   width:500px;
  }
  .tombol{
        height:34px;
    }
 </style>