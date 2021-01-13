@extends('layout/main')

@section('title', 'Detail Pegawai')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Detail Pegawai</h3>
                        <div class="panel-body">
                            <div class="text-right">
                                <a href="{{$pegawai->id_pegawai}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                            </div>
                            <br>
                            <table class="table table-basic">
                                <tr>
                                    
                                    <td>ID</td>
                                    <td>:</td>
                                    <td>{{$pegawai->id_pegawai}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Pegawai</td>
                                    <td>:</td>
                                    <td>{{$pegawai->nama_pegawai}}</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td>{{$pegawai->Role->nama_role}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Pegawai</td>
                                    <td>:</td>
                                    <td>{{$pegawai->alamat_pegawai}}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>:</td>
                                    <td>{{$pegawai->nomor_telepon_pegawai}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir Pegawai</td>
                                    <td>:</td>
                                    <td>{{$pegawai->tanggal_lahir_pegawai}}</td>
                                </tr>
                                <tr>
                                    <td>User Log</td>
                                    <td>:</td>
                                    <td>{{$pegawai->user_pegawai_log}}</td>
                                </tr>
                                
                            </table>
                            <br><br>
                            
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $pegawai-> tanggal_tambah_pegawai_log}}</td>
                                <td>| |</td>
                                <td>Diubah pada: {{ $pegawai-> tanggal_ubah_pegawai_log}}</td>
                                </tr>
                            </div>
                        </div>

                    </div>
                <div class="text-right col-md-12">
                    <form action="{{$pegawai->id_pegawai}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></button>
                    </form>
                    <!-- <button class="btn btn-danger btn-lg"  data-toggle="modal" data-target="#delete"><i class="lnr lnr-trash"></i></button> -->
                </div>
                <div>
                <a href="/pegawai" class="btn btn-link">Kembali</a>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection