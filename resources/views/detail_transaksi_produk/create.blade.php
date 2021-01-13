@extends('layout/main')

@section('title', 'Form tambah data Transaksi Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                    <h3 class="text-center">Tambah Produk</h3>
                        <div class="panel-body">
                            <form method="post" action="/transaksi_produk/{{$transaksi_produk->id_transaksi_produk}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <select name="id_produk" id="id_produk" class="form-control">
                                    @foreach($produk as $produk)
                                        <option value="{{ $produk->id_produk }}">{{$produk->nama_produk}}</option>
                                    @endforeach
                                    </select>
                                    <br>
                                    <label for="jumlah_detail_produk">Jumlah Produk</label>
                                    <input type="number" class="form-control @error('jumlah_detail_produk') is-invalid @enderror" id="jumlah_detail_produk" name="jumlah_detail_produk" placeholder="Masukkan jumlah produk" value="{{old('jumlah_detail_produk')}}">
                                    @error('jumlah_detail_produk')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
