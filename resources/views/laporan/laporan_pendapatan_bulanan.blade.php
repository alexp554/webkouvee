@extends('layout.main')

@section('title', 'Data Pendapatan Bulanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                    <h1 class="text-center">Laporan Pendapatan Bulanan</h1>
                    <div class="panel-body">
    <!--<div class="row">
        <div class="col-6">
            <form action="/searchPemesanan" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </span>
                </div>
            </form>
        </div>
    </div>-->
    <form action="/pendapatanBulanan" method="get">
        <div class="form-group">
            <!-- <label for="tahun" style="color: whitesmoke">Tahun</label><br> -->
            <select name="tahun" id="tahun" class="btn btn-sm dropdown-toggle" style="width:200px" value="{{ old('tahun') }}">
                <option value="none" selected disabled hidden>TAHUN TRANSAKSI</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2025</option>
            </select>
            <select name="bulan" id="bulan" class="btn btn-sm dropdown-toggle" style="width:200px" value="{{ old('bulan') }}">
                <option value="none" selected disabled hidden>BULAN TRANSAKSI</option>
                <option value="1">JANUARI</option>
                <option value="2">FEBRUARI</option>
                <option value="3">MARET</option>
                <option value="4">APRIL</option>
                <option value="5">MEI</option>
                <option value="6">JUNI</option>
                <option value="7">JULI</option>
                <option value="8">AGUSTUS</option>
                <option value="9">SEPTEMBER</option>
                <option value="10">OKTOBER</option>
                <option value="11">NOVEMBER</option>
                <option value="12">DESEMBER</option>
            </select>
            <span class="input-group-prepend">
                <button type="submit" class="btn btn-primary">Cari</button>
            </span>
            </br>
        </div>
    </form>

    @if($tahun!=NULL && $bulan!=NULL)
        <h6 class="mt-4">Data Pendapatan Bulan {{$bulan->bln}} Tahun {{$tahun->thn}}</h6>
    @elseif($tahun==NULL && $bulan==NULL)
        <h6 class="mt-4">DATA PENDAPATAN TAHUN TERSEBUT KOSONG</h6>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Nama Jasa Layanan</th>
                <th style="text-align:center" scope="col">Harga</th>
            </tr>
        </thead>
        <tbody>
        <tr>
        @php($i=1)
        @foreach( $bulananLayanan as $bulananLayanan )
                <td style="text-align:center">{{$i}}</td>
                @php($i++)
                @if($bulananLayanan == NULL)
                    <td style="text-align:center">-</td>
                    <td style="text-align:center">-</td>
                @elseif($bulananLayanan != NULL)
                    <td style="text-align:center">{{ $bulananLayanan->nama_layanan }}</td>
                    <td style="text-align:center">Rp. {{ $bulananLayanan->total }}</td>
                @endif
            </tr>
        @endforeach
        <tr>
            <td style="text-align:center"> </td>
            <td style="text-align:center"> </td>
            <th colspan="3" style="text-align:center">Rp. {{ $totalBulanLayanan->subtotal }}</th>
        </tr>
        </tbody>
    </table>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Nama Produk</th>
                <th style="text-align:center" scope="col">Harga</th>
            </tr>
        </thead>
        <tbody>
        <tr>
        @php($i=1)
        @foreach( $bulananProduk as $bulananProduk )
                <td style="text-align:center">{{$i}}</td>
                @php($i++)
                @if($bulananProduk == NULL)
                    <td style="text-align:center">-</td>
                    <td style="text-align:center">-</td>
                @elseif($bulananProduk != NULL)
                    <td style="text-align:center">{{ $bulananProduk->nama_produk }}</td>
                    <td style="text-align:center">Rp. {{ $bulananProduk->total }}</td>
                @endif
            </tr>
        @endforeach
        <tr>
            <td style="text-align:center"> </td>
            <td style="text-align:center"> </td>
            <th colspan="3" style="text-align:center">Rp. {{ $totalBulanProduk->subtotal }}</th>
        </tr>
        </tbody>
    </table>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection