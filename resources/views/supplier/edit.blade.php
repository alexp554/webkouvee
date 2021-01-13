@extends('layout/main')

@section('title', 'Form Ubah data Supplier')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                        <h3 class="text-center">Ubah Supplier</h3>
                        
                        <div class="panel-body">
                            <form method="post" action="/supplier/{{$supplier->id_supplier}}">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Supplier</label>
                                    <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror" id="nama" name="nama_supplier" placeholder="Masukkan Nama" value="{{$supplier->nama_supplier}}">
                                    @error('nama_supplier')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="alamat">Alamat Supplier</label>
                                    <input type="text" class="form-control @error('alamat_supplier') is-invalid @enderror" id="alamat" name="alamat_supplier" placeholder="Masukkan Alamat" value="{{$supplier->alamat_supplier}}">
                                    @error('alamat_supplier')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                    <label for="nomor telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('telepon_supplier') is-invalid @enderror" id="telepon_supplier" name="telepon_supplier" placeholder="Masukkan Nomor Telepon" value="{{$supplier->telepon_supplier}}">
                                    @error('telepon_supplier')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
