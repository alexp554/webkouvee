@extends('layout/main')

@section('title', 'Layanan')

@section('container')
@if(Session::get('login'))
<div class="main">
@else
<div class="wrapper">
@endif
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="panel"> -->
                        <br><br><br>
                        <h1 class="text-center">Daftar Layanan</h1>
                        <br>
                        <!-- <div class="panel-body"> -->
                            <div class="col">
                                <form action="/search_layanan_kami" method="get">
                                    <div class="input-group ukuran">
                                        <input type="search" name="search" class="form-control" placeholder="Cari nama layanan">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="text-right">
                                <a href="/layanan_kami" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                            </div>
                            <br>
                            @if(session('status'))
                                <div class="alert alert-success text-center">
                                <i class="fa fa-check-circle"></i>
                                    {{session('status')}}
                                </div>
                            @endif

                            <div">
                                @foreach( $layanan as $layanan)
                                    <div class="col-md-3">
                                        <div class="panel panel-scrooling">
                                            <div class="panel-body">
                                                <!-- <img src="https://cdn1-www.dogtime.com/assets/uploads/2017/12/dog-grooming-mistakes-1-720x407.jpg" class="card-img-top" width="30" height="180"> -->
                                                <!-- <div class="metric"> -->
                                                    <p>
                                                        <h3 class="card-title text-center">{{ $layanan-> nama_layanan}}</h3>
                                                        <p class="text-center">Rp {{ $layanan-> harga_layanan}}</p>
                                                        <!-- <br>
                                                        <div class="text-center">
                                                            <a href="/layanan/{{ $layanan->id_layanan}}" class="btn btn-warning btn-sm">Detail</a>
                                                        </div> -->

                                                    </p>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                
                            </div>
                        <!-- </div> -->


                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">Kouvee Pet Shop <br> Jl. Moses Gatotkaca No. 22 Yogyakarta 55281 <br> Telp. (0274) 357735 <br> http://www.sayanghewan.com
</div>
@endsection
<style>
  .ukuran{
   width:500px;
  }
  .tombol{
        height:34px;
    }
    .footer {
 position:absolute;
 bottom:0;
 width:100%;
 height:100px;   /* Contoh tinggi footer 60px */
 background: #000000;
}
 </style>