@extends('layout/main')

@section('title', 'Detail Pengadaan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center"> Detail Pengadaan </h3>
                        <div class="panel-body">
                                @if($pengadaan-> status_pengadaan == 'Pemesanan Sedang Diproses')
                                    <div class="text-left">
                                            <form action="{{$pengadaan->id_pengadaan}}" method="post" route='Verifikasi'>
                                                @method('patch')
                                                @csrf
                                                <button class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin memverifikasi pengadaan ?')">Verifikasi Barang Telah Sampai</button>
                                            </form>
                                    </div>
                                @endif
                                @if($pengadaan-> status_pengadaan == 'Belum Selesai')
                                    <div class="text-right">
                                        <a href="{{$pengadaan->id_pengadaan}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                    </div>
                                @endif
                            <br>
                            <table class="table table-basic">
                                    <tr>
                                        <td>ID</td>
                                        <td>:</td>
                                        <td>{{$pengadaan->id_pengadaan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Kode Pengadaan</td>
                                        <td>:</td>
                                        <td>{{$pengadaan->kode_pengadaan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Supplier</td>
                                        <td>:</td>
                                        <td>{{$pengadaan->Supplier->nama_supplier}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Pengadaan</td>
                                        <td>:</td>
                                        <td>{{$pengadaan->tanggal_pengadaan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Total Pengadaan</td>
                                        <td>:</td>
                                        <td>{{$pengadaan->total_pengadaan}}</td>

                                    </tr>
                                    <tr>
                                        <td>Status Pengadaan</td>
                                        <td>:</td>
                                        <td>{{$pengadaan->status_pengadaan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Diubah oleh</td>
                                        <td>:</td>
                                        <td>{{$pengadaan->user_pengadaan_log}}</td>
                                    </tr>
                            </table>
                            <br><br>
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $pengadaan-> tanggal_tambah_pengadaan_log}}</td>
                                <td>| |</td>
                                <td>Diubah pada: {{ $pengadaan-> tanggal_ubah_pengadaan_log}}</td>
                                </tr>
                            </div>
                            <div>
                                <a href="/pengadaan" class="btn btn-link my-5">Kembali</a>
                            </div>
                            @if($pengadaan-> status_pengadaan != 'Pemesanan Sedang Diproses')
                                <div class="text-right">
                                    <form action="{{$pengadaan->id_pengadaan}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                <br>
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        <i class="fa fa-check-circle"></i>
                        {{session('status')}}
                    </div>
                @endif
                <div class="panel">
                    <h3 class="text-center"> Daftar Produk </h3>
                    <div class="panel-body">
                        <table class="table">
                            <thead class="thead">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Jumlah Produk</th>
                                    <th scope="col">Subtotal Produk</th>
                                    @if($pengadaan-> status_pengadaan == 'Belum Selesai')
                                        <th scope="col">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $detail_pengadaan as $detail_pengadaan)
                                    @if($detail_pengadaan->id_pengadaan == $pengadaan->id_pengadaan) 
                                        <tr>
                                            <!-- <th scope="row">{{ $loop->iteration}}</th> -->
                                            <td>{{ $detail_pengadaan-> id_detail_pengadaan}}</td>
                                            <td>{{ $detail_pengadaan-> nama_produk}}</td>
                                            <td>{{ $detail_pengadaan-> jumlah_detail_pengadaan}}</td>
                                            <td>{{ $detail_pengadaan-> subtotal_detail_pengadaan}}</td>
                                            <td>
                                                @if($pengadaan-> status_pengadaan == 'Belum Selesai')
                                                    <a href="/pengadaan/{{ $pengadaan->id_pengadaan}}/{{$detail_pengadaan->id_detail_pengadaan}}/editProduk" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                    <form action="{{ $pengadaan->id_pengadaan}}/{{$detail_pengadaan->id_detail_pengadaan}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk tersebut?')"><i class="lnr lnr-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    <div>
                        @if($pengadaan-> status_pengadaan == 'Belum Selesai')
                            <div class="text-center mt-4">
                                <a href="/pengadaan/{{ $pengadaan->id_pengadaan}}/createProduk" class="btn btn-primary">Tambah Produk</a>
                            </div>
                        @endif
                <div>
                    <br>
                <br><br>
            </div>
        </div>
    </div>
</div>
    @if($pengadaan-> status_pengadaan == 'Belum Selesai')
        <div class="text-center">
            <form action="{{$pengadaan->id_pengadaan}}/pesan" method="get">
                @csrf
                <button class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin melakukan pengadaan produk?')">PESAN PRODUK</button>
            </form>
        </div>
    @elseif($pengadaan-> status_pengadaan != 'Belum Selesai')
        <div class="col-md-12 text-center">
            <form action="/pengadaan/{{ $pengadaan->id_pengadaan}}/cetakStruk" method="get">    
                @csrf
                <button type="submit" class="btn btn-success btn-sm"><i class="lnr lnr-printer"></i></button>
            </form>
        </div>
    @endif