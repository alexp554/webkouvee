@extends('layout/main')

@section('title', 'Fornm edit data produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                        <h3 class="text-center">Edit Data Produk</h3>
                        <div class="panel-body">
                        <form method="post" action="/pengadaan/{{ $pengadaan->id_pengadaan}}/{{$detail_pengadaan->id_detail_pengadaan}}">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="Nama_Produk">Nama Produk</label>
                                <select name="id_produk" id="id_produk" class="form-control" >
                                    @foreach ($produk as $produk)
                                        <option value="{{ $produk->id_produk }}" {{ $produk->id_produk == $detail_pengadaan->id_produk ? 'selected' : '' }}>{{$produk->nama_produk}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_produk">Jumlah Produk</label>
                                <input type="text" class="form-control @error('jumlah_detail_pengadaan') is-invalid @enderror" id="jumlah_detail_pengadaan" name="jumlah_detail_pengadaan" placeholder="Masukkan Jumlah Produk" value="{{$detail_pengadaan->jumlah_detail_pengadaan}}">
                                @error('jumlah_detail_pengadaan')
                                    <div class="ivalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subtotal_produk">Subtotal Produk</label>
                                <input type="text" class="form-control @error('subtotal_detail_pengadaan') is-invalid @enderror" id="subtotal_detail_pengadaan" name="subtotal_detail_pengadaan" placeholder="Masukkan subtotal Produk" value="{{$detail_pengadaan->subtotal_detail_pengadaan}}">
                                @error('subtotal_detail_pengadaan')
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