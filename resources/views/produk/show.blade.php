@extends('layout/main')

@section('title', 'Detail Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                    
                        <h3 class="text-center"> Detail Produk </h3>
                        <div class="panel-body">
                            <div class="text-right">
                                <a href="{{$produk->id_produk}}/edit" class="btn btn-primary"><i class="lnr lnr-pencil"></i></a>
                            </div>
                            <br>
                            <table class="table table-basic">
                                <tr>
                                    
                                    <td>ID</td>
                                    <td>:</td>
                                    <td>{{$produk->id_produk}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Produk</td>
                                    <td>:</td>
                                    <td>{{$produk->nama_produk}}</td>
                                </tr>
                                <tr>
                                    <td>Satuan Produk</td>
                                    <td>:</td>
                                    <td>{{$produk->satuan_produk}}</td>
                                </tr>
                                <tr>
                                    <td>Stok Produk</td>
                                    <td>:</td>
                                    <td>{{$produk->stok_produk}}</td>
                                </tr>
                                <tr>
                                    <td>Stok Minimal Produk</td>
                                    <td>:</td>
                                    <td>{{$produk->stok_min_produk}}</td>
                                </tr>
                                <tr>
                                    <td>Harga Produk</td>
                                    <td>:</td>
                                    <td>{{$produk->harga_produk}}</td>
                                </tr>
                                <tr>
                                    <td>User Log</td>
                                    <td>:</td>
                                    <td>{{$produk->user_produk_log}}</td>
                                </tr>
                                
                            </table>
                            <br><br>
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $produk-> tanggal_tambah_produk_log}}</td>
                                <td>| |</td>
                                <td>Diubah pada: {{ $produk-> tanggal_ubah_produk_log}}</td>
                                </tr>
                            </div>
                            <img src="{{asset($produk->image_path)}}" alt="image_path" width="180" height="180">
                        </div>
                    </div>
                        <div class="col-md-12 text-right">
                            <form action="{{$produk->id_produk}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></button>
                            </form>
                        </div>
                        <div>
                            <a href="/produk" class="btn btn-link my-5">Kembali</a>
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