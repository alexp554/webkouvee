@extends('layout/main')

@section('title', 'Form Ubah data Pegawai')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Ubah Pegawai</h3>
                        <div class="panel-body">
                            <form method="post" action="/pegawai/{{$pegawai->id_pegawai}}">
                                @method('patch')
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Pegawai</label>
                                    <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama" name="nama_pegawai" placeholder="Masukkan Nama" value="{{$pegawai->nama_pegawai}}">
                                    @error('nama_pegawai')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                    <br>
                                        <div class="form-group">
                                            <label for="nama">Role</label>
                                            <select name="id_role" id="id_role" class="form-control">
                                                @foreach ($role as $role) 
                                                    @if($role->id_role > 1) 
                                                        <option value="{{ $role->id_role }}" {{ $role->id_role == $pegawai->id_role ? 'selected' : '' }}>{{$role->nama_role}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    <br>
                                        <label for="alamat">Alamat Pegawai</label>
                                        <input type="text" class="form-control @error('alamat_pegawai') is-invalid @enderror" id="alamat" name="alamat_pegawai" placeholder="Masukkan Alamat" value="{{$pegawai->alamat_pegawai}}">
                                        @error('alamat_pegawai')
                                            <div class="ivalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    <br>
                                        <label for="tanggal lahir">Tanggal Lahir Pegawai</label>
                                        <input type="date" class="form-control @error('tanggal_lahir_pegawai') is-invalid @enderror" id="tanggal_lahir_pegawai" name="tanggal_lahir_pegawai" placeholder="Masukkan Tanggal Lahir" value="{{$pegawai->tanggal_lahir_pegawai}}">
                                        @error('tanggal_lahir_pegawai')
                                            <div class="ivalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    <br>
                                        <label for="nomor telepon">Nomor Telepon</label>
                                        <input type="text" class="form-control @error('tanggal_lahir_pegawai') is-invalid @enderror" id="nomor_telepon_pegawai" name="nomor_telepon_pegawai" placeholder="Masukkan Nomor Telepon" value="{{$pegawai->nomor_telepon_pegawai}}">
                                        @error('nomor_telepon_pegawai')
                                            <div class="ivalid-feedback text-danger">{{$message}}</div>
                                        @enderror
                                    <br>
                                    <br>
                                        <div class="form-group">
                                            <div class="form-row">
                                                    <label for="password">Edit password</label>
                                                <div class="col"> 
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" checked type="radio" name="r_pass" id="pass_tidak" value="">
                                                        <label for="pass_tidak" class="form-check-label">Tidak</label>
                                                    </div>
                                                </div> 
                                                <div class="col"> 
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="r_pass" id="pass_iya" value="1">
                                                        <label for="pass_iya" class="form-check-label">Iya</label>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="form-row">
                                                    <label for="pass_lama">Password lama</label>
                                                    <input id="pass_lama" name="pass_lama" type="text" class="form-control" disabled>
                                                    <label for="pass_baru">Password baru</label>
                                                    <input id="pass_baru" name="pass_baru" type="text" class="form-control " disabled>
                                                    <!-- @error('pass_baru') -->
                                                        <!-- <div class="ivalid-feedback">Harus diisi</div> -->
                                                    <!-- @enderror -->
                                            </div>
                                        </div>
                                    </br>
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