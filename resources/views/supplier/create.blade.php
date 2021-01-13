@extends('layout/main')

@section('title', 'Form tambah data Supplier')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Tambah Supplier</h3>
                        <form method="post" action="/supplier">
                        @csrf
                            <div class="panel-body">
                                <label for="nama">Nama Supplier</label>
                                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror" id="nama" name="nama_supplier" placeholder="Masukkan Nama" value="{{old('nama_supplier')}}">
                                @error('nama_supplier')
                                    <div class="ivalid-feedback text-danger">{{$message}}</div>
                                @enderror
                                <br>
                                <label for="alamat">Alamat Supplier</label>
                                <input type="text" class="form-control @error('alamat_supplier') is-invalid @enderror" id="alamat" name="alamat_supplier" placeholder="Masukkan Alamat" value="{{old('alamat_supplier')}}">
                                @error('alamat_supplier')
                                    <div class="ivalid-feedback text-danger">{{$message}}</div>
                                @enderror
                                <br>
                                <label for="nomor telepon">Nomor Telepon</label>
                                <input type="text" class="form-control @error('telepon_supplier') is-invalid @enderror" id="telepon_supplier" name="telepon_supplier" placeholder="Masukkan Nomor Telepon" value="{{old('telepon_supplier')}}">
                                @error('telepon_supplier')
                                    <div class="ivalid-feedback text-danger">{{$message}}</div>
                                @enderror
                                <br><br>
                                <div class="text-right col-md-11">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
