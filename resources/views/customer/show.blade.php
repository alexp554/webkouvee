@extends('layout/main')

@section('title', 'Detail Customer')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center"> Detail Customer </h3>
                        <div class="panel-body">
                            <div class="text-right">
                                <a href="{{$customer->id_customer}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                            </div>
                            <br>
                            <table class="table table-basic">
                                <tr>
                                    
                                    <td>ID</td>
                                    <td>:</td>
                                    <td>{{$customer->id_customer}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Customer</td>
                                    <td>:</td>
                                    <td>{{$customer->nama_customer}}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Customer</td>
                                    <td>:</td>
                                    <td>{{$customer->alamat_customer}}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telepon</td>
                                    <td>:</td>
                                    <td>{{$customer->telepon_customer}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir Customer</td>
                                    <td>:</td>
                                    <td>{{$customer->tgl_lahir_customer}}</td>
                                </tr>
                                <tr>
                                    <td>User Log</td>
                                    <td>:</td>
                                    <td>{{$customer->user_customer_log}}</td>
                                </tr>
                                
                            </table>
                            <br><br>
                            
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $customer-> tanggal_tambah_customer_log}}</td>
                                <td>| |</td>
                                <td>Diubah pada: {{ $customer-> tanggal_ubah_customer_log}}</td>
                                </tr>
                            </div>
                        </div>

                    </div>
                <div class="text-right col-md-12">
                    <form action="{{$customer->id_customer}}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></button>
                    </form>
                    <!-- <button class="btn btn-danger btn-lg"  data-toggle="modal" data-target="#delete"><i class="lnr lnr-trash"></i></button> -->
                </div>
                <div>
                <a href="/customer" class="btn btn-link">Kembali</a>
                </div>
                    </div>  
                </div>
            </div>
        </div>  
    </div>
</div>

<!-- Modal Delete -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                </div>
                    <form action="{{ $customer->id_customer }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <div class="modal-body">
                            <p class="text-center">
                                Are you sure you want to delete this?
                            </p>
                            <input type="hidden" name="category_id" id="cat_id" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-warning">Yes</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

@endsection