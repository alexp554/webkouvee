@extends('layout/main')

@section('title', 'Detail Transaksi Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center"> Detail Transaksi Produk </h3>
                        <div class="panel-body">
                            @if(Session::get('id_role') == 2)
                                @if($transaksi_produk-> status_transaksi_produk != 'Lunas')
                                    <div class="text-right">
                                        <a href="{{$transaksi_produk->id_transaksi_produk}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                    </div>
                                @endif
                            @endif
                            <br>
                            <table class="table table-basic">
                                <tr>
                                    <td>ID</td>
                                    <td>:</td>
                                    <td>{{$transaksi_produk->id_transaksi_produk}}</td>
                                </tr>
                                <tr>
                                    <td>Kode Transaksi</td>
                                    <td>:</td>
                                    <td>{{$transaksi_produk->kode_transaksi_produk}}</td>
                                </tr>
                                <tr>
                                    <td>Nama Customer</td>
                                    <td>:</td>
                                    @if($transaksi_produk->Customer->nama_customer == 'Non-Member')
                                        <td>{{$transaksi_produk->Customer->nama_customer.'-'.$transaksi_produk->id_transaksi_produk}}</td>
                                    @elseif($transaksi_produk->Customer->nama_customer != 'Non-Member')
                                        <td>{{ $transaksi_produk->Customer->nama_customer}}</td>
                                    @endif
                                </tr>
                                @if(Session::get('id_role') == 2)
                                    @if($transaksi_produk-> status_transaksi_produk == 'Menunggu Pembayaran')
                                        <tr>
                                            <td>Total Transaksi</td>
                                            <td>:</td>
                                            <td>{{$transaksi_produk->total_transaksi_produk}}</td>
                                        </tr>
                                    @endif
                                @endif
                                <tr>
                                    <td>Status Transaksi</td>
                                    <td>:</td>
                                    <td>{{$transaksi_produk->status_transaksi_produk}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Transaksi</td>
                                    <td>:</td>
                                    <td>{{$transaksi_produk->tanggal_transaksi_produk}}</td>
                                </tr>
                                <tr>
                                    <td>User Add Log</td>
                                    <td>:</td>
                                    <td>{{ $transaksi_produk-> user_transaksi_add}}</td>
                                </tr>
                                <tr>
                                    <td>User Edit Log</td>
                                    <td>:</td>
                                    <td>{{ $transaksi_produk-> user_transaksi_edit}}</td>
                                </tr>
                                
                            </table>
                            <br><br>
                            <div class="text-center">
                                <tr>
                                <td>Ditambah pada: {{ $transaksi_produk-> tanggal_tambah_transaksi_log}}</td>
                                <td> | | </td>
                                <td>Diubah pada: {{ $transaksi_produk-> tanggal_ubah_transaksi_log}}</td>
                                </tr>
                            </div>
                        <div>
                            <a href="/transaksi_produk" class="btn btn-info md-5">Kembali</a>
                        </div>
                        @if(Session::get('id_role') == 2)
                            @if($transaksi_produk-> status_transaksi_produk != 'Lunas')
                                <div class="col-md-12 text-right">
                                    <form action="{{$transaksi_produk->id_transaksi_produk}}" method="post">
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
                        <h3 class="text-center"> Detail Produk </h3>
                        <div class="panel-body">
                            <table class="table">
                                <thead class="thead">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Jumlah Produk</th>
                                        <th scope="col">Subtotal Produk</th>
                                        @if($transaksi_produk-> status_transaksi_produk == 'Menunggu Pembayaran')
                                            <th scope="col">Aksi</th>
                                        @endif
                                        <!-- @if(Session::get('id_role') == 3)
                                            @if($transaksi_produk->Customer->nama_customer != 'Non-Member')
                                                <th scope="col">Diskon Satuan Produk</th>
                                            @endif
                                        @endif -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $detail_transaksi_produk as $detail_transaksi_produk)
                                        @if($detail_transaksi_produk->id_transaksi_produk == $transaksi_produk->id_transaksi_produk) 
                                            <tr>
                                                <!-- <th scope="row">{{ $loop->iteration}}</th> -->
                                                <td>{{ $detail_transaksi_produk-> id_detail_produk}}</td>
                                                <td>{{ $detail_transaksi_produk-> nama_produk}}</td>
                                                <td>{{ $detail_transaksi_produk-> jumlah_detail_produk}}</td>
                                                <td>{{ $detail_transaksi_produk-> subtotal_detail_produk}}</td>
                                                @if($transaksi_produk-> status_transaksi_produk == 'Menunggu Pembayaran')
                                                    <td>
                                                        <a href="/transaksi_produk/{{ $transaksi_produk->id_transaksi_produk}}/{{$detail_transaksi_produk->id_detail_produk}}/editProduk" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                        <form action="{{ $transaksi_produk->id_transaksi_produk}}/{{$detail_transaksi_produk->id_detail_produk}}" method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk tersebut?')"><i class="lnr lnr-trash"></i></button>
                                                        </form>
                                                    </td>
                                                @endif



                                                <!-- @if(Session::get('id_role') == 3)
                                                    @if($transaksi_produk-> status_transaksi_produk == 'Menunggu Pembayaran')
                                                        @if($transaksi_produk->Customer->nama_customer != 'Non-Member')
                                                            <td>
                                                                <input type="number" id="diskon_produk" name="diskon_produk.'$transaksi_produk->id_transaksi_produk'" placeholder="Rp. ">
                                                            </td>
                                                        @endif
                                                    @elseif($transaksi_produk-> status_transaksi_produk != 'Menunggu Pembayaran')

                                                    @endif
                                                @endif -->
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                                @if($transaksi_produk-> status_transaksi_produk == 'Menunggu Pembayaran')
                                    <div class="text-center mt-4">
                                        <a href="/transaksi_produk/{{ $transaksi_produk->id_transaksi_produk}}/createProduk" class="btn btn-primary">Tambah Produk</a>
                                    </div>
                                @endif
                        </div>
                    </div>
                    <br>
                        <!-- Pembayaran -->
                        @if(Session::get('id_role') == 3)
                            @if($transaksi_produk-> status_transaksi_produk == 'Menunggu Pembayaran')
                                <div class="panel">
                                    <h3 class="text-center"> Pembayaran Produk </h3>
                                    <div class="panel-body">
                                        <form method="post" action="/transaksi_produk/{{$transaksi_produk->id_transaksi_produk}}/pembayaran" enctype="multipart/form-data">
                                        @csrf
                                            <table class="table table-basic">
                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        <th class="">Total Transaksi</th>
                                                        <th>{{$transaksi_produk->total_transaksi_produk}}</th>
                                                    </div>
                                                </td>
                                            </tr>
                                            @if($transaksi_produk->Customer->nama_customer != 'Non-Member')
                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        <th class="">Diskon yang diterima</th>
                                                        <th><input type="number" id="diskon" name="diskon" placeholder="Rp. " value="{{old('diskon')}}"></th>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
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

                        @if($transaksi_produk-> status_transaksi_produk != 'Menunggu Pembayaran')
                            <div class="panel">
                                <h3 class="text-center"> Detail Pembayaran </h3>
                                <div class="panel-body">
                                    <table class="table table-basic">
                                        <tr>
                                            <td>Total Transaksi</td>
                                            <td>:</td>
                                            <td>{{$transaksi_produk->total_transaksi_produk}}</td>
                                        </tr>
                                        @if($transaksi_produk->Customer->nama_customer != 'Non-Member')
                                            <tr>
                                                <td>Diskon</td>
                                                <td>:</td>
                                                <td>{{$transaksi_produk->diskon}}</td>
                                            </tr>
                                        @endif
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
                                        <form action="/transaksi_produk/{{$transaksi_produk->id_transaksi_produk}}/cetakStruk" method="get">    
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