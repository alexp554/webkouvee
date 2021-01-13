@extends('layout/main')

@section('title', 'Hewan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                            <h1 class="text-center">Daftar Hewan</h1>
                            <div class="panel-body">
                                <div class="col text-right">
                                    <a href="/hewan/create" class="btn btn-primary">Tambah Hewan</a>
                                </div>
                                <div>
                                    <form action="/search_hewan" method="get">
                                        <div class="input-group ukuran">
                                            <input type="search" name="search" class="form-control" placeholder="Cari nama hewan">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="text-right">
                                    <a href="/hewan" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
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
                                            <th scope="col">Nama Hewan</th>
                                            <th scope="col">Jenis</th>
                                            <th scope="col">Ukuran</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Tanggal Lahir Hewan</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $hewan as $hewan)
                                            <tr>
                                                    <th scope="row">{{ $loop->iteration}}</th>
                                                    <td>{{ $hewan-> nama_hewan}}</td>
                                                    <td>{{ $hewan-> nama_jenis}}</td>
                                                    <td>{{ $hewan-> nama_ukuran}}</td>
                                                    <td>{{ $hewan-> nama_customer}}</td>
                                                    <td>{{ $hewan-> tanggal_lahir_hewan}}</td>
                                                    <td>
                                                        <a href="/hewan/{{ $hewan->id_hewan}}" class="btn btn-warning btn-sm">Detail</a>
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