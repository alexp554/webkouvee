@extends('layout/main')

@section('title', 'Form tambah data Customer')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Tambah Customer</h3>
                        <form method="post" action="/customer">
                        @csrf
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="nama">Nama Customer</label>
                                    <input type="text" class="form-control @error('nama_customer') is-invalid @enderror" id="nama" name="nama_customer" placeholder="Masukkan Nama" value="{{old('nama_customer')}}">
                                    @error('nama_customer')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="alamat">Alamat Customer</label>
                                    <input type="text" class="form-control @error('alamat_customer') is-invalid @enderror" id="alamat" name="alamat_customer" placeholder="Masukkan Alamat" value="{{old('alamat_customer')}}">
                                    @error('alamat_customer')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="tanggal lahir">Tanggal Lahir Customer</label>
                                    <input type="date" class="form-control @error('tgl_lahir_customer') is-invalid @enderror" id="tgl_lahir_customer" name="tgl_lahir_customer" placeholder="Masukkan Tanggal Lahir" value="{{old('tgl_lahir_customer')}}">
                                    @error('tgl_lahir_customer')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="nomor telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('telepon_customer') is-invalid @enderror" id="telepon_customer" name="telepon_customer" placeholder="Masukkan Nomor Telepon" value="{{old('telepon_customer')}}">
                                    @error('telepon_customer')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
