@extends('layout.main')

@section('title', 'Layanan Terlaris')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                        <h1 class="text-center" >Laporan Layanan Terlaris</h1>
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
                        <form action="/layananTerlaris" method="get">
                            <div class="form-group">
                                <!-- <label for="tahun" style="color: whitesmoke">Tahun</label><br> -->
                                <select name="tahun" id="tahun" class="btn btn-sm dropdown-toggle" width:200px" value="{{ old('tahun') }}">
                                    <option value="none" selected disabled hidden>TAHUN TRANSAKSI</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                </select>
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </span>
                                </br>
                                @if($tahun!=NULL)
                                
                                @endif
                            </div>
                        </form>

                        @if($tahun!=NULL)
                            <h6 class="mt-4">DATA LAYANAN TAHUN {{$tahun->thn}}</h6>
                        @elseif($tahun==NULL)
                            <h6 class="mt-4">DATA LAYANAN TAHUN TERSEBUT KOSONG</h6>
                        @endif
                    <div class="panel">
                        <div class="panel-body">
                            <table class="table table-hover"">
                                <thead>
                                    <tr>
                                        <th style="text-align:center" scope="col">Bulan</th>
                                        <th style="text-align:center" scope="col">Nama Layanan</th>
                                        <th style="text-align:center" scope="col">Jumlah Layanan Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @php($i=0)
                                @foreach( $transaksi_layanan as $transaksi_layanan )
                                        <td style="text-align:center">{{$bulan[$i]}}</td>
                                        @php($i++)
                                        @if($transaksi_layanan == NULL)
                                            <td style="text-align:center">-</td>
                                            <td style="text-align:center">-</td>
                                        @elseif($transaksi_layanan != NULL)
                                            <td style="text-align:center">{{ $transaksi_layanan->nama_layanan }}</td>
                                            <td style="text-align:center">{{ $transaksi_layanan->count }}</td>
                                        @endif
                                    </tr>
                                    @endforeach
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