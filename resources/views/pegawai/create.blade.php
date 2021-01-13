@extends('layout/main')

@section('title', 'Form tambah data Pegawai')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                            <h3 class="text-center">Tambah Pegawai</h3>
                            <div class="panel-body">
                                <form method="post" action="/pegawai">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama" name="nama_pegawai" placeholder="Masukkan Nama" value="{{ old('nama_pegawai') }}">
                                        @error('nama_pegawai')
                                            <div class="ivalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
									    <input name="password" type="password" class="form-control @error('nama_pegawai') is-invalid @enderror" id="password" placeholder="Masukkan password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirm">Konfirmasi Password</label>
									    <input name="password_confirm" type="password" class="form-control @error('nama_pegawai') is-invalid @enderror" id="password" placeholder="Konfirmasi password">
                                        @error('password_confirm')
                                            <div class="ivalid-feedback text-danger">Password harus sama</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Role</label>
                                        <select name="id_role" id="id_role" class="form-control">
                                        @foreach($role as $role)
                                            @if($role->id_role > 1)
                                                <option value="{{ $role->id_role }}">
                                                    {{$role->nama_role}}
                                                </option>
                                            @endif
                                        @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control @error('alamat_pegawai') is-invalid @enderror" id="alamat" name="alamat_pegawai" placeholder="Masukkan alamat" value="{{ old('alamat_pegawai') }}">
                                        @error('alamat_pegawai')
                                            <div class="ivalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Lahir</label>
                                        <input type="date" class="form-control @error('tanggal_lahir_pegawai') is-invalid @enderror" id="tanggal" name="tanggal_lahir_pegawai" placeholder="Masukkan tanggal lahir" value="{{ old('tanggal_lahir_pegawai') }}">
                                        @error('tanggal_lahir_pegawai')
                                            <div class="ivalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nomor">Nomor Telepon</label>
                                        <input type="text" class="form-control  @error('nomor_telepon_pegawai') is-invalid @enderror" id="nomor" name="nomor_telepon_pegawai" placeholder="Masukkan nomor telepon" value="{{ old('nomor_telepon_pegawai') }}">
                                        @error('nomor_telepon_pegawai')
                                            <div class="ivalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
