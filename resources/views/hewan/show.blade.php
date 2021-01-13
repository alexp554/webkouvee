@extends('layout/main')

@section('title', 'Detail hewan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center"> Detail Hewan </h3>
                        <div class="panel-body">
                            <div class="text-right">
                                <a href="{{$hewan->id_hewan}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                            </div>
                            <br>
                            <table class="table table-basic">
                                    <tr>
                                        <td>ID</td>
                                        <td>:</td>
                                        <td>{{$hewan->id_hewan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Hewan</td>
                                        <td>:</td>
                                        <td>{{$hewan->nama_hewan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Hewan</td>
                                        <td>:</td>
                                        <td>{{$hewan->Jenis->nama_jenis}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran</td>
                                        <td>:</td>
                                        <td>{{$hewan->Ukuran->nama_ukuran}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir Hewan</td>
                                        <td>:</td>
                                        <td>{{$hewan->tanggal_lahir_hewan}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Customer</td>
                                        <td>:</td>
                                        <td>{{$hewan->Customer->nama_customer}}</td>
                                    </tr>
                                    <tr>
                                        <td>User Log</td>
                                        <td>:</td>
                                        <td>{{$hewan->user_hewan_log}}</td>
                                    </tr>
                            </table>
                            <br><br>
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $hewan-> tanggal_tambah_hewan_log}}</td>
                                <td>| |</td>
                                <td>Diubah pada: {{ $hewan-> tanggal_ubah_hewan_log}}</td>
                                </tr>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                            <!-- <button class="btn btn-danger"  data-toggle="modal" data-target="#delete">DELETE</button> -->
                        <form action="{{$hewan->id_hewan}}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></button>
                        </form>
                    </div>
                <div>
                <a href="/hewan" class="btn btn-link my-5">Kembali</a>
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
                    <form action="{{ $hewan->id_hewan }}" method="post" class="d-inline">
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
