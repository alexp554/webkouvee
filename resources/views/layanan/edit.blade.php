@extends('layout/main')

@section('title', 'Form Ubah data Layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                    <h3 class="text-center">Ubah Layanan</h3>
                    <div class="panel-body">
                        <form method="post" action="/layanan/{{$layanan->id_layanan}}">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Layanan</label>
                                <input type="text" class="form-control @error('nama_layanan') is-invalid @enderror" id="nama" name="nama_layanan" placeholder="Masukkan Nama" value="{{$layanan->nama_layanan}}">
                                @error('nama_layanan')
                                    <div class="ivalid-feedback text-danger">{{$message}}</div>
                                @enderror
                                <br>
                                <label for="harga">Harga Layanan</label>
                                <input type="text" class="form-control @error('harga_layanan') is-invalid @enderror" id="harga" name="harga_layanan" placeholder="Masukkan Harga" value="{{$layanan->harga_layanan}}">
                                @error('harga_layanan')
                                    <div class="ivalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
