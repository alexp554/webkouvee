@extends('layout/main')

@section('title', 'Transaksi Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h1 class="text-center">Daftar Transaksi Produk</h1>
						<div class="panel-body">
                            <div class="col text-right">
                                <a href="/transaksi_produk/create" class="btn btn-primary">Tambah Transaksi</a>
                            </div>
                                <form action="/search_transaksi_produk" method="get">
                                    <div class="input-group ukuran">
                                        <input type="search" name="search" class="form-control" placeholder="Cari Transaksi Produk">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                                <div class="text-right">
                                    <a href="/transaksi_produk" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
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
                                                <!-- <th scope="col">ID Transaksi</th> -->
                                                <th scope="col">Kode Transaksi Produk</th>
                                                <th scope="col">Nama Customer</th>
                                                <th scope="col">Total Transaksi</th>
                                                <th scope="col">Tanggal Transaksi</th>
                                                <th scope="col">Status Transaksi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $transaksi_produk as $transaksi_produk)
                                                <tr>
                                                        <th scope="row">{{ $loop->iteration}}</th>
                                                        <!-- <td>{{ $transaksi_produk-> id_transaksi_produk}}</td> -->
                                                        <td>{{ $transaksi_produk-> kode_transaksi_produk}}</td>

                                                        @if($transaksi_produk-> nama_customer == 'Non-Member')
                                                            <td>{{ ($transaksi_produk-> nama_customer).'-'.($transaksi_produk-> id_transaksi_produk) }}</td>
                                                        @endif

                                                        @if($transaksi_produk-> nama_customer != 'Non-Member')
                                                            <td>{{ $transaksi_produk-> nama_customer}}</td>
                                                        @endif

                                                        <td>{{ $transaksi_produk-> total_transaksi_produk}}</td>
                                                        <td>{{ $transaksi_produk-> tanggal_transaksi_produk}}</td>
                                                        <td>{{ $transaksi_produk-> status_transaksi_produk}}</td>
                                                        <td>
                                                            <a href="/transaksi_produk/{{ $transaksi_produk->id_transaksi_produk}}" class="btn btn-warning btn-sm">Detail</a>
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