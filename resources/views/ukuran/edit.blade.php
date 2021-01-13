@extends('layout/main')

@section('title', 'Form Ubah data Ukuran')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Ubah Ukuran Hewan</h3>
                        <div class="panel-body">
                            <form method="post" action="/ukuran/{{$ukuran->id_ukuran}}/update">
                                <!-- @method('patch') -->
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Ukuran</label>
                                    <input type="text" class="form-control @error('nama_ukuran') is-invalid @enderror" id="nama" name="nama_ukuran" placeholder="Masukkan Nama" value="{{$ukuran->nama_ukuran}}">
                                    @error('nama_ukuran')
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
