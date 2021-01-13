@extends('layout/main')

@section('title', 'Form tambah data Pengadaan Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                    <h3 class="text-center">Tambah Pengadaan Produk</h3>
                        <div class="panel-body">
                            <form method="post" action="/pengadaan/{{$pengadaan->id_pengadaan}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <select name="id_produk" id="id_produk" class="form-control">
                                    @foreach($produk as $produk)
                                        <option value="{{ $produk->id_produk }}">{{$produk->nama_produk}}</option>
                                    @endforeach
                                    </select>
                                    <br>
                                    <label for="jumlah_detail_pengadaan">Jumlah Produk</label>
                                    <input type="number" class="form-control @error('jumlah_detail_pengadaan') is-invalid @enderror" id="jumlah_detail_pengadaan" name="jumlah_detail_pengadaan" placeholder="Masukkan jumlah produk" value="{{old('jumlah_detail_pengadaan')}}">
                                    @error('jumlah_detail_pengadaan')
                                        <div class="ivalid-feedback">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="subtotal_detail_pengadaan">Subtotal Produk</label>
                                    <input type="number" class="form-control @error('subtotal_detail_pengadaan') is-invalid @enderror" id="subtotal_detail_pengadaan" name="subtotal_detail_pengadaan" placeholder="Masukkan Subtotal pengadaan produk" value="{{old('subtotal_detail_pengadaan')}}">
                                    @error('subtotal_detail_pengadaan')
                                        <div class="ivalid-feedback">{{$message}}</div>
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
