@extends('layout/main')

@section('title', 'Detail Supplier')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                            
                        <h3 class="text-center"> Detail Supplier </h3>

                        <div class="panel-body">
                            <div class="text-right">
                                <a href="{{$supplier->id_supplier}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                            </div>
                            <br>
                            <table class="table table-basic">
                                <tr>
                                    
                                    <td>ID</td>
                                    <td>:</td>
                                    <td>{{$supplier->id_supplier}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Supplier</td>
                                    <td>:</td>
                                    <td>{{$supplier->nama_supplier}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{$supplier->alamat_supplier}}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>:</td>
                                    <td>{{$supplier->telepon_supplier}}</td>
                                </tr>
                                <tr>
                                    <td>User Log</td>
                                    <td>:</td>
                                    <td>{{ $supplier-> user_supplier_log}}</td>
                                </tr>
                                
                            </table>
                            <br><br>
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $supplier-> tanggal_tambah_supplier_log}}</td>
                                <td>| |</td>
                                <td>Diubah pada: {{ $supplier-> tanggal_ubah_supplier_log}}</td>
                                </tr>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <form action="{{$supplier->id_supplier}}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></button>
                        </form>
                    </div>
                    <div>
                    <a href="/supplier" class="btn btn-link my-5">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection