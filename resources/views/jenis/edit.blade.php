@extends('layout/main')

@section('title', 'Form Ubah data Jenis')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Ubah Jenis Hewan</h3>
                        <div class="panel-body">
                            <form method="post" action="/jenis/{{$jenis->id_jenis}}/update">
                                <!-- @method('patch') -->
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Jenis</label>
                                    <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" id="nama" name="nama_jenis" placeholder="Masukkan Nama" value="{{$jenis->nama_jenis}}">
                                    @error('nama_jenis')
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
