@extends('layout/main')

@section('title', 'Detail Layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                    
                        <h3 class="text-center"> Detail Layanan </h3>
                        <div class="panel-body">
                            <div class="text-right">
                                <a href="{{$layanan->id_layanan}}/edit" class="btn btn-primary"><i class="lnr lnr-pencil"></i></a>
                            </div>
                            <br>
                            <table class="table table-basic">
                                <tr>
                                    
                                    <td>ID</td>
                                    <td>:</td>
                                    <td>{{$layanan->id_layanan}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Layanan</td>
                                    <td>:</td>
                                    <td>{{$layanan->nama_layanan}}</td>
                                </tr>
                                <tr>
                                    <td>Harga Layanan</td>
                                    <td>:</td>
                                    <td>Rp {{$layanan->harga_layanan}}</td>
                                </tr>
                                <tr>
                                    <td>User Log</td>
                                    <td>:</td>
                                    <td>{{$layanan->user_layanan_log}}</td>
                                </tr>
                                
                            </table>
                            <br><br>
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $layanan-> tanggal_tambah_layanan_log}}</td>
                                <td>| |</td>
                                <td>Diubah pada: {{ $layanan-> tanggal_ubah_layanan_log}}</td>
                                </tr>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-12 text-right">
                            <form action="{{$layanan->id_layanan}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></button>
                            </form>
                        </div>
                        <div>
                            <a href="/layanan" class="btn btn-link my-5">Kembali</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <style>
.rapihindetail{
    width:300px;
    padding:40px;
    font-size:15px;
    font-weight:bold;
}
</style> -->
@endsection