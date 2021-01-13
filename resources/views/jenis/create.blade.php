@extends('layout/main')

@section('title', 'Form tambah data Customer')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Tambah Jenis</h3>
                        <div class="panel-body">
                            <form method="post" action="/jenis">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama jenis</label>
                                    <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" id="nama" name="nama_jenis" placeholder="Masukkan Nama" value="{{old('nama_jenis')}}">
                                    @error('nama_jenis')
                                        <div class="ivalid-feedback text-danger">Data tidak boleh kosong</div>
                                    @enderror
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
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
