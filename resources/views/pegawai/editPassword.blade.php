@extends('layout/main')

@section('title', 'Form Ubah password Pegawai')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Ubah Password Pegawai</h3>
                        <div class="panel-body">
                            <form method="post" action="/pegawai/{{$pegawai->id_pegawai}}">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Password Lama</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan password lama">
                                    @error('password')
                                        <div class="ivalid-feedback text-danger">Password anda salah</div>
                                    @enderror
                                </div>
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
