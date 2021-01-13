@extends('layout/main')

@section('title', 'Pengadaan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                            <h1 class="text-center">Daftar Pengadaan</h1>
                            <div class="panel-body">
                                <div class="col text-right">
                                    <a href="/pengadaan/create" class="btn btn-primary">Tambah Pengadaan</a>
                                </div>
                                <!-- <div>
                                    <form action="/search_pengadaan" method="get">
                                        <div class="input-group ukuran">
                                            <input type="search" name="search" class="form-control" placeholder="Cari pengadaan">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div> -->
                                <div class="text-left">
                                    <a href="/pengadaan" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
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
                                            <th scope="col">ID</th>
                                            <th scope="col">Kode Pengadaan</th>
                                            <th scope="col">Supplier</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $pengadaan as $pengadaan)
                                            <tr>
                                                <th scope="row">{{ $pengadaan-> id_pengadaan}}</th>
                                                <td>{{ $pengadaan-> kode_pengadaan}}</td>
                                                <td>{{ $pengadaan-> nama_supplier}}</td>
                                                <td>{{ $pengadaan-> status_pengadaan}}</td>
                                                <td>
                                                    <a href="/pengadaan/{{$pengadaan->id_pengadaan}}" class="btn btn-warning btn-sm">Detail</a>
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