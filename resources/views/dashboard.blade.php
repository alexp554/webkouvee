@extends('layout/main')

@section('title', 'Dashboard')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h2 class="text-center">Dashboard</h2>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                            @if(Session::get('id_role') == 1)
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/hewan"><img src="{{asset('tampilan/assets/dashboard/hewan.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/hewan">Hewan</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/customer"><img src="{{asset('tampilan/assets/dashboard/customer.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/customer">Customer</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/produk"><img src="{{asset('tampilan/assets/dashboard/produk.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/produk">Produk</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/layanan"><img src="{{asset('tampilan/assets/dashboard/layanan.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/layanan">Layanan</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/jenis"><img src="{{asset('tampilan/assets/dashboard/jenis.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/jenis">Jenis</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/ukuran"><img src="{{asset('tampilan/assets/dashboard/ukuran.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/ukuran">Ukuran</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/supplier"><img src="{{asset('tampilan/assets/dashboard/supplier.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/supplier">Supplier</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/pegawai"><img src="{{asset('tampilan/assets/dashboard/pegawai.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/pegawai">Pegawai</a>
                                    </div>
                                </div>
                                @elseif(Session::get('id_role') == 2)
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/hewan"><img src="{{asset('tampilan/assets/dashboard/hewan.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/hewan">Hewan</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/customer"><img src="{{asset('tampilan/assets/dashboard/customer.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/customer">Customer</a>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/transaksi_produk"><img src="{{asset('tampilan/assets/dashboard/transaksi produk.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/transaksi_produk">Transaksi dan Pembayaran Produk</a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="kotak">
                                        <a href="/transaksi_layanan"><img src="{{asset('tampilan/assets/dashboard/transaksi layanan.jpg')}}" width="298" height="130" alt=""></a>
                                        <br>
                                        <a href="/transaksi_layanan">Transaksi dan Pembayaran Layanan</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .kotak{
        background-color: #; 
        border: 1px solid #DCDCDC; 
        height: 180; margin: 10px 0px; 
        text-align: center; 
        width: 300;
    }
</style>