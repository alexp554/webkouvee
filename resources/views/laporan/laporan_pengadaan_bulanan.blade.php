@extends('layout.main')

@section('title', 'Data Pengadaan Bulanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                    <h3 class="text-center">Laporan Pengadaan Bulanan</h3>
                        <div class="panel-body">
                            <form action="/pengadaanBulanan" method="get">
                                <div class="form-group">
                                    <!-- <label for="tahun" style="color: whitesmoke">Tahun</label><br> -->
                                    <select name="tahun" id="tahun" class="btn btn-sm dropdown-toggle" style="width:200px" value="{{ old('tahun') }}">
                                        <option value="none" selected disabled hidden>TAHUN TRANSAKSI</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2019</option>
                                        <option value="2022">2018</option>
                                        <option value="2023">2017</option>
                                        <option value="2024">2016</option>
                                        <option value="2025">2015</option>
                                        <option value="2026">2014</option>
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
                            </form>

                            <br><br>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="text-align:center" scope="col">No</th>
                                        <th style="text-align:center" scope="col">Nama Produk</th>
                                        <th style="text-align:center" scope="col">Jumlah Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @php($i=1)
                                @foreach( $pengadaanBulan as $pb )
                                        <td style="text-align:center">{{$i}}</td>
                                        @php($i++)
                                        @if($pb == NULL)
                                            <td style="text-align:center">-</td>
                                            <td style="text-align:center">-</td>
                                        @elseif($pb != NULL)
                                            <td style="text-align:center">{{ $pb->nama_produk }}</td>
                                            <td style="text-align:center">Rp. {{ $pb->total }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr>
                                    <td style="text-align:center"> </td>
                                    <td style="text-align:center"> </td>
                                    <th colspan="3" style="text-align:center">Rp. {{ $subtotalsebulan->subtotal }}</th>
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