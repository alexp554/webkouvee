@extends('layout/main')

@section('title', 'Jenis')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="mt-3 text-center">Daftar Jenis Hewan</h3>
                        <div class="panel-body">
                            <div class="col text-right">
                                <a href="/jenis/create" class="btn btn-primary">Tambah Jenis Hewan</a>
                            </div>
                            <div class="col">
                                <form action="/search_jenis" method="get">
                                    <div class="input-group ukuran">
                                        <input type="search" name="search" class="form-control" placeholder="Cari jenis hewan">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="text-right">
                                <a href="/jenis" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success text-center">
                                    <i class="fa fa-check-circle"></i>
                                    {{session('status')}}
                                </div>
                            @endif
                            <table class="table">
                                <thead class="thead">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nama Jenis</th>
                                        <th scope="col">User Log</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $jenis as $jenis)
                                            <tr>
                                                    <th scope="row">{{ $loop->iteration}}</th>
                                                    <td>{{ $jenis-> id_jenis}}</td>
                                                    <td>{{ $jenis-> nama_jenis}}</td>
                                                    <td>{{ $jenis-> user_jenis_log}}</td>
                                                    <td>
                                                        <a href="/jenis/{{$jenis->id_jenis}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                        <a href="/jenis/{{$jenis->id_jenis}}/destroy" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></a>
                                                        <!-- <form action="/jenis" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form> -->
                                                    </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </br>
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