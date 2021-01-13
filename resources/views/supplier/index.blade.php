@extends('layout/main')

@section('title', 'Supplier')

@section('container')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <h1 class="text-center">Daftar Supplier</h1>
                            <div class="panel-body">
                                <div class="col text-right">
                                    <a href="/supplier/create" class="btn btn-primary">Tambah Supplier</a>
                                </div>
                                <div class="panel-body"></div>
                                    <div class="col">
                                        <form action="/search_supplier" method="get">
                                            <div class="input-group ukuran">
                                                <input type="search" name="search" class="form-control" placeholder="Cari nama supplier">
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                <div class="text-right">
                                    <a href="/supplier" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success text-center">
                                        <i class="fa fa-check-circle"></i>
                                        {{session('status')}}
                                    </div>
                                @endif
                                <div class="panel-body"></div>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Supplier</th>
                                            <th>Alamat</th>
                                            <th>Nomor Telephone</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $supplier as $supplier)
                                        <tr>
                                                <th scope="row">{{ $loop->iteration}}</th>
                                                <td>{{ $supplier-> nama_supplier}}</td>
                                                <td>{{ $supplier-> alamat_supplier}}</td>
                                                <td>{{ $supplier-> telepon_supplier}}</td>
                                                <td>
                                                    <a href="/supplier/{{ $supplier->id_supplier}}" class="btn btn-warning btn-sm">Detail</a>
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