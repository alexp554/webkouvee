@extends('layout/main')

@section('title', 'Form tambah data Ukuran')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Tambah Ukuran</h3>
                        <div class="panel-body">
                            <form method="post" action="/ukuran">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Ukuran</label>
                                    <input type="text" class="form-control @error('nama_ukuran') is-invalid @enderror" id="nama" name="nama_ukuran" placeholder="Masukkan Nama" value="{{old('nama_ukuran')}}">
                                    @error('nama_ukuran')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
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
