@extends('layout/main')

@section('title', 'Transaksi Layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h1 class="text-center">Daftar Transaksi Layanan</h1>
						<div class="panel-body">
                            @if(Session::get('id_role') == 2)
                                <div class="col text-right">
                                    <a href="/transaksi_layanan/create" class="btn btn-primary">Tambah Transaksi</a>
                                </div>
                            @endif
                            
                            <!-- <form method="post" action="/transaksi_layanan/">
                                <select name="status_filter" id="status_filter" class="form-control">   
                                    <option type="submit" value="1" >-- Pilih Status Transaksi --</option>
                                    <option value="2" >Menunggu Pembayaran</option>
                                    <option value="3" >Lunas</option>
                                </select>
                            </form> -->


                                <form action="/search_transaksi_layanan" method="get">
                                    <div class="input-group ukuran">
                                        <input type="search" name="search" class="form-control" placeholder="Cari Transaksi Layanan">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>

                                <!-- <form action="/search_transaksi_layanan" method="get"> -->
                                    <li class="dropdown" >
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Pilih Status Transaksi    <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="/transaksi_layanan_belum" name="status_filter" value="1"></i> <span>Menunggu Pembayaran</span></a></li>
                                                <li><a href="/transaksi_layanan_lunas" name="status_filter" value="2"></i> <span>Lunas</span></a></li>
                                            </ul>
                                    </li>
                                <!-- </form> -->

                                <div class="text-right">
                                    <a href="/transaksi_layanan" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
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
                                                <th scope="col">Kode Transaksi Layanan</th>
                                                <th scope="col">Nama Hewan</th>
                                                <th scope="col">Jenis Hewan</th>
                                                <th scope="col">Ukuran Hewan</th>
                                                <th scope="col">Total Transaksi</th>
                                                <th scope="col">Tanggal Transaksi</th>
                                                <th scope="col">Status Transaksi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $transaksi_layanan as $transaksi_layanan)
                                                @if(Session::get('id_role') == 2)
                                                    @if($transaksi_layanan-> status_transaksi_layanan == 'Belum Selesai')
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration}}</th>
                                                            <td>{{ $transaksi_layanan-> kode_transaksi_layanan}}</td>
                                                            <td>{{ $transaksi_layanan-> nama_hewan}}</td>
                                                            <td>{{ $transaksi_layanan-> nama_jenis}}</td>
                                                            <td>{{ $transaksi_layanan-> nama_ukuran}}</td>
                                                            <td>{{ $transaksi_layanan-> total_transaksi_layanan}}</td>
                                                            <td>{{ $transaksi_layanan-> tanggal_transaksi_layanan}}</td>
                                                            <td>{{ $transaksi_layanan-> status_transaksi_layanan}}</td>
                                                            <td>
                                                                <a href="/transaksi_layanan/{{ $transaksi_layanan->id_transaksi_layanan}}" class="btn btn-warning btn-sm">Detail</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @else
                                                    @if($transaksi_layanan-> status_transaksi_layanan != 'Belum Selesai')
                                                        <tr>
                                                            <th scope="row">{{ $loop->iteration}}</th>
                                                            <td>{{ $transaksi_layanan-> kode_transaksi_layanan}}</td>
                                                            <td>{{ $transaksi_layanan-> nama_hewan}}</td>
                                                            <td>{{ $transaksi_layanan-> nama_jenis}}</td>
                                                            <td>{{ $transaksi_layanan-> nama_ukuran}}</td>
                                                            <td>{{ $transaksi_layanan-> total_transaksi_layanan}}</td>
                                                            <td>{{ $transaksi_layanan-> tanggal_transaksi_layanan}}</td>
                                                            <td>{{ $transaksi_layanan-> status_transaksi_layanan}}</td>
                                                            <td>
                                                                <a href="/transaksi_layanan/{{ $transaksi_layanan->id_transaksi_layanan}}" class="btn btn-warning btn-sm">Detail</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
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