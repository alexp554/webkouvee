@extends('layout/main')

@section('title', 'Transaksi Layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h1 class="text-center">Laporan Pengadaan Tahunan</h1>
      <div class="panel-body">
                        <form action="/pengadaanTahunan" method="get">
                            <div class="form-group">
                                <!-- <label for="tahun" style="color: whitesmoke">Tahun</label><br> -->
                                <select name="tahun" id="tahun" class="btn btn-sm dropdown-toggle"value="{{ old('tahun') }}">
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
                                <br>
                            </div>
                        </form>
   
                        @if($tahun!=NULL)
                            <h4>DATA PENGADAAN TAHUN {{$tahun->thn}}</h4>
                        @elseif($tahun==NULL)
                            <h4>DATA PENGADAAN TAHUN TERSEBUT KOSONG</h4>
                        @endif

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Jumlah Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @php($i=0)
                            @foreach( $pengadaanTahunan as $pt )
                                    <td>{{$bulan[$i]}}</td>
                                    @php($i++)
                                        @if($pt == NULL)
                                            <td>-</td>
                                        @elseif($pt != NULL)
                                            <td >Rp. {{ $pt->total }}</td>
                                        @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td> </td>
                                <th colspan="3">Rp. {{$subtotalsetahun->subtotal}}</th>
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

<style>
  .ukuran{
   width:500px;
  }
  .tombol{
        height:34px;
    }
 </style>