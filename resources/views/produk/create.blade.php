@extends('layout/main')

@section('title', 'Form tambah data Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                    <h3 class="text-center">Tambah Produk</h3>
                        <div class="panel-body">
                            <form method="post" action="/produk" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama" name="nama_produk" placeholder="Masukkan nama produk" value="{{old('nama_produk')}}">
                                    @error('nama_produk')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="satuan">Satuan Produk</label>
                                    <input type="text" class="form-control @error('satuan_produk') is-invalid @enderror" id="satuan" name="satuan_produk" placeholder="Masukkan satuan produk" value="{{old('satuan_produk')}}">
                                    @error('satuan_produk')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="stok">Stok Produk</label>
                                    <input type="number" class="form-control @error('stok_produk') is-invalid @enderror" id="stok" name="stok_produk" placeholder="Masukkan stok produk" value="{{old('stok_produk')}}">
                                    @error('stok_produk')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="minimal">Stok Minimal Produk</label>
                                    <input type="number" class="form-control @error('stok_min_produk') is-invalid @enderror" id="minimal" name="stok_min_produk" placeholder="Masukkan stok minimal produk" value="{{old('stok_min_produk')}}">
                                    @error('stok_min_produk')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="harga">Harga Produk</label>
                                    <input type="number" class="form-control @error('harga_produk') is-invalid @enderror" id="harga" name="harga_produk" placeholder="Masukkan harga produk" value="{{old('harga_produk')}}">
                                    @error('harga_produk')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="foto">Foto Produk</label>
                                    <input type="file" class="form-control @error('image_path') is-invalid @enderror" id="foto" name="image_path" placeholder="Masukkan foto produk" value="{{old('image_path')}}">
                                    @error('image_path')
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
