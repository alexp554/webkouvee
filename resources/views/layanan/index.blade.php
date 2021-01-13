@extends('layout/main')

@section('title', 'Layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="panel"> -->
            
                        <h1 class="text-center">Daftar Layanan</h1>

                        <!-- <div class="panel-body"> -->
                            <div class="text-right">
                                <a href="/layanan/create" class="btn btn-primary">Tambah Layanan</a>
                            </div>
                            <div class="col">
                                <form action="/search_layanan" method="get">
                                    <div class="input-group ukuran">
                                        <input type="search" name="search" class="form-control" placeholder="Cari nama layanan">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="text-right">
                                <a href="/layanan" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
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
                                                        <br>
                                                        <div class="text-center">
                                                            <a href="/layanan/{{ $layanan->id_layanan}}" class="btn btn-warning btn-sm">Detail</a>
                                                            <!-- <a href="" class="btn btn-success btn-sm">Input</a> -->
                                                        </div>

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
@endsection
<style>
  .ukuran{
   width:500px;
  }
  .tombol{
        height:34px;
    }
 </style>