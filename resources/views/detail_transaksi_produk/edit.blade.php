@extends('layout/main')

@section('title', 'Form edit data produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                        <h3 class="text-center">Edit Data Produk</h3>
                        <div class="panel-body">
                        <form method="post" action="/transaksi_produk/{{ $transaksi_produk->id_transaksi_produk}}/{{$detail_transaksi_produk->id_detail_produk}}">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="Nama_Produk">Nama Produk</label>
                                <select name="id_produk" id="id_produk" class="form-control" >
                                    @foreach ($produk as $produk)
                                        <option value="{{ $produk->id_produk }}" {{ $produk->id_produk == $detail_transaksi_produk->id_produk ? 'selected' : '' }}>{{$produk->nama_produk}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_detail_produk">Jumlah Produk</label>
                                <input type="number" class="form-control @error('jumlah_detail_produk') is-invalid @enderror" id="jumlah_detail_produk" name="jumlah_detail_produk" placeholder="Masukkan Jumlah Produk" value="{{$detail_transaksi_produk->jumlah_detail_produk}}">
                                @error('jumlah_detail_produk')
                                    <div class="ivalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <br>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
                            </div>
                            <br>
                        </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection