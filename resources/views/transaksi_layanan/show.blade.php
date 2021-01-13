@extends('layout/main')

@section('title', 'Detail Transaksi Layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center"> Detail Transaksi Layanan </h3>
                        <div class="panel-body">
                            @if($transaksi_layanan-> status_transaksi_layanan == 'Belum Selesai')
                                @if(Session::get('id_role') == 2)
                                    <div class="text-left">
                                            <form action="{{$transaksi_layanan->id_transaksi_layanan}}/sms" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Yakin ingin memverifikasi transaksi layanan ?')">Verifikasi</button>
                                            </form>
                                    </div>
                                    <div class="text-right">
                                        <a href="{{$transaksi_layanan->id_transaksi_layanan}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                    </div>
                                @endif
                            @endif
                            <br>
                            <table class="table table-basic">
                                <tr>
                                    <td>ID</td>
                                    <td>:</td>
                                    <td>{{$transaksi_layanan->id_transaksi_layanan}}</td>
                                </tr>
                                <tr>
                                    <td>Kode Transaksi</td>
                                    <td>:</td>
                                    <td>{{$transaksi_layanan->kode_transaksi_layanan}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Hewan</td>
                                    <td>:</td>
                                    <td>{{ $transaksi_layanan->Hewan->nama_hewan}}</td>
                                </tr>
                                <tr>
                                    <td>Jenis Hewan</td>
                                    <td>:</td>
                                    <td>{{ $transaksi_layanan->Hewan->Jenis->nama_jenis}}</td>
                                </tr>
                                <tr>
                                    <td>Ukuran Hewan</td>
                                    <td>:</td>
                                    <td>{{ $transaksi_layanan->Hewan->Ukuran->nama_ukuran}}</td>
                                </tr>
                                @if(Session::get('id_role') == 2)
                                    @if($transaksi_layanan-> status_transaksi_layanan == 'Menunggu Pembayaran' || $transaksi_layanan-> status_transaksi_layanan == 'Belum Selesai')
                                        <tr>
                                            <td>Total Transaksi</td>
                                            <td>:</td>
                                            <td>{{$transaksi_layanan->total_transaksi_layanan}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <td>Status Transaksi</td>
                                    <td>:</td>
                                    <td>{{$transaksi_layanan->status_transaksi_layanan}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Transaksi</td>
                                    <td>:</td>
                                    <td>{{$transaksi_layanan->tanggal_transaksi_layanan}}</td>
                                </tr>
                                <tr>
                                    <td>User Add Log</td>
                                    <td>:</td>
                                    <td>{{ $transaksi_layanan-> user_transaksi_add}}</td>
                                </tr>
                                <tr>
                                    <td>User Edit Log</td>
                                    <td>:</td>
                                    <td>{{ $transaksi_layanan-> user_transaksi_edit}}</td>
                                </tr>
                                
                            </table>
                            <br><br>
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $transaksi_layanan-> tanggal_tambah_transaksi_log}}</td>
                                <td> | | </td>
                                <td>Diubah pada: {{ $transaksi_layanan-> tanggal_ubah_transaksi_log}}</td>
                                </tr>
                            </div>
                        <div>
                            <a href="/transaksi_layanan" class="btn btn-link my-5">Kembali</a>
                        </div>
                        @if(Session::get('id_role') == 2)
                            @if($transaksi_layanan-> status_transaksi_layanan != 'Lunas')
                                <div class="col-md-12 text-right">
                                    <form action="{{$transaksi_layanan->id_transaksi_layanan}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></button>
                                    </form>
                                </div>
                            @endif
                        @endif
                        </div>
                    </div>
                    
                    <br>
                    @if (session('gagal'))
                        <div class="alert alert-danger text-center">
                            <i class="fa fa-exclamation-circle"></i>
                            {{session('gagal')}}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success text-center">
                            <i class="fa fa-check-circle"></i>
                            {{session('status')}}
                        </div>
                    @endif
                    <div class="panel">
                        <h3 class="text-center"> Detail Layanan </h3>
                        <div class="panel-body">
                        <table class="table">
                            <thead class="thead">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Layanan</th>
                                    <th scope="col">Jumlah Layanan</th>
                                    <th scope="col">Subtotal Layanan</th>
                                    @if(Session::get('id_role') == 2)
                                        @if($transaksi_layanan-> status_transaksi_layanan == 'Belum Selesai')
                                            <th scope="col">Aksi</th>
                                        @endif
                                    @elseif(Session::get('id_role') == 3)
                                        @if($transaksi_layanan-> status_transaksi_layanan == 'Menunggu Pembayaran')
                                            <th scope="col">Aksi</th>
                                        @endif
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $detail_transaksi_layanan as $detail_transaksi_layanan)
                                    @if($detail_transaksi_layanan->id_transaksi_layanan == $transaksi_layanan->id_transaksi_layanan) 
                                        <tr>
                                            <!-- <th scope="row">{{ $loop->iteration}}</th> -->
                                            <td>{{ $detail_transaksi_layanan-> id_detail_layanan}}</td>
                                            <td>{{ $detail_transaksi_layanan-> nama_layanan}}</td>
                                            <td>{{ $detail_transaksi_layanan-> jumlah_detail_layanan}}</td>
                                            <td>{{ $detail_transaksi_layanan-> subtotal_detail_layanan}}</td>
                                            <td>
                                            @if(Session::get('id_role') == 2)
                                                @if($transaksi_layanan-> status_transaksi_layanan == 'Belum Selesai')
                                                    <a href="/transaksi_layanan/{{ $transaksi_layanan->id_transaksi_layanan}}/{{$detail_transaksi_layanan->id_detail_layanan}}/editlayanan" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                    <form action="{{ $transaksi_layanan->id_transaksi_layanan}}/{{$detail_transaksi_layanan->id_detail_layanan}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus layanan tersebut?')"><i class="lnr lnr-trash"></i></button>
                                                    </form>
                                                @endif
                                            @elseif(Session::get('id_role') == 3)
                                                @if($transaksi_layanan-> status_transaksi_layanan == 'Menunggu Pembayaran')
                                                    <a href="/transaksi_layanan/{{ $transaksi_layanan->id_transaksi_layanan}}/{{$detail_transaksi_layanan->id_detail_layanan}}/editlayanan" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                    <form action="{{ $transaksi_layanan->id_transaksi_layanan}}/{{$detail_transaksi_layanan->id_detail_layanan}}" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus layanan tersebut?')"><i class="lnr lnr-trash"></i></button>
                                                    </form>
                                                @endif
                                            @endif
                                            </td>
                                        </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                            @if(Session::get('id_role') == 2)
                                @if($transaksi_layanan-> status_transaksi_layanan == 'Belum Selesai')
                                    <div class="text-center mt-4">
                                        <a href="/transaksi_layanan/{{ $transaksi_layanan->id_transaksi_layanan}}/createlayanan" class="btn btn-primary">Tambah Layanan</a>
                                    </div>
                                @endif
                            @elseif(Session::get('id_role') == 3)
                                @if($transaksi_layanan-> status_transaksi_layanan == 'Menunggu Pembayaran')
                                    <div class="text-center mt-4">
                                        <a href="/transaksi_layanan/{{ $transaksi_layanan->id_transaksi_layanan}}/createlayanan" class="btn btn-primary">Tambah Layanan</a>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <br>
                        <!-- Pembayaran -->
                        @if(Session::get('id_role') == 3)
                            @if($transaksi_layanan-> status_transaksi_layanan == 'Menunggu Pembayaran')
                                <div class="panel">
                                    <h3 class="text-center"> Pembayaran Layanan </h3>
                                    <div class="panel-body">
                                        <form method="post" action="/transaksi_layanan/{{$transaksi_layanan->id_transaksi_layanan}}/pembayaran" enctype="multipart/form-data">
                                        @csrf
                                            <table class="table table-basic">
                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        <th class="">Total Transaksi</th>
                                                        <th>{{$transaksi_layanan->total_transaksi_layanan}}</th>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        <th class="">Diskon yang diterima</th>
                                                        <th><input type="number" id="diskon" name="diskon" placeholder="Rp. " value="{{old('diskon')}}"></th>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        <th class="">Uang yang diterima</th>
                                                        <th><input type="number" id="uang_customer" name="uang_customer" placeholder="Rp. "></th>
                                                    </div>
                                                </td>
                                            </tr>
                                            </table>
                                            <div class="text-center mt-10">
                                                    <button type="submit" class="btn btn-primary">Bayar</button>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @if($transaksi_layanan-> status_transaksi_layanan == 'Lunas')
                            <div class="panel">
                                <h3 class="text-center"> Detail Pembayaran </h3>
                                <div class="panel-body">
                                    <table class="table table-basic">
                                        <tr>
                                            <td>Total Transaksi</td>
                                            <td>:</td>
                                            <td>{{$transaksi_layanan->total_transaksi_layanan}}</td>
                                        </tr>
                                        <tr>
                                            <td>Diskon</td>
                                            <td>:</td>
                                            <td>{{$transaksi_layanan->diskon}}</td>
                                        </tr>
                                        @if (session('status'))
                                            <tr>
                                                <td>Uang yang diterima</td>
                                                <td>:</td>
                                                <td name="uang" value="{{Session::get('uang_customer')}}">{{Session::get('uang_customer')}}</td>
                                            </tr>
                                            <tr>
                                                <td>Kembalian</td>
                                                <td>:</td>
                                                <td name="kembali" value="{{Session::get('kembalian')}}" >{{Session::get('kembalian')}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                    <div class="col-md-12 text-center">
                                        <form action="/transaksi_layanan/{{$transaksi_layanan->id_transaksi_layanan}}/cetakStruk" method="get">    
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm"><i class="lnr lnr-printer"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<!-- Modal Delete Transaksi -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                </div>
                    <form action="{{ $transaksi_layanan->id_transaksi_layanan }}" method="post" class="d-inline">
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

<!-- Modal Delete layanan -->
    <div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="myModalLabel">Delete Confirmation</h4>
                </div>
                    <form action="{{ $transaksi_layanan->id_transaksi_layanan}}/{{$detail_transaksi_layanan->id_detail_layanan}}" method="post" class="d-inline">
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

<!-- Modal Verifikasi transaksi layanan -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="myModalLabel">verifikasi</h4>
                    </div>
                    <form action="{{$transaksi_layanan->id_transaksi_layanan}}/sms" method="post">
                        @csrf
                        <div class="modal-body">
                            <p class="text-center">
                               Apakah kamu yakin untuk memverifikasi transaksi_layanan ini?
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