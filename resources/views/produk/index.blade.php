@extends('layout/main')

@section('title', 'Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="panel"> -->
                        @foreach( $produk as $p)
                            @if($p-> stok_produk == $p-> stok_min_produk || $p-> stok_produk < $p-> stok_min_produk )
                                <div class="alert alert-danger text-center">
                                    <i class="fa fa-exclamation-circle"></i>
                                    Ada produk yang hampir habis 
                                <br><br>
                                        <a href="/notifikasi" class="btn btn-info">Tampilkan produknya</a>
                                </div>
                                @break
                            @endif
                        @endforeach
                        <h1 class="text-center mt-4">Daftar Produk</h1>

                        <!-- <div class="panel-body"> -->
                            <div class="text-right">
                                <a href="/produk/create" class="btn btn-primary">Tambah Produk</a>
                            </div>
                            <div class="col">
                                <form action="/search_produk" method="get">
                                    <div class="input-group ukuran">
                                        <input type="search" name="search" class="form-control" placeholder="Cari nama produk">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="text-right">
                                <a href="/produk" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                            </div>
                            <br>
                            @if(session('status'))
                                <div class="alert alert-success text-center">
                                <i class="fa fa-check-circle"></i>
                                    {{session('status')}}
                                </div>
                            @endif

                            <div>
                                @foreach( $produk as $produk)
                                <div class="col-md-3">
                                    <div class="panel panel-scrooling">
                                        <div class="panel-body">
                                            <div class="text-center">
                                            <!-- <img src="https://cdn1-www.dogtime.com/assets/uploads/2017/12/dog-grooming-mistakes-1-720x407.jpg" width="180" height="180"> -->
                                            <img src="{{asset($produk->image_path)}}" alt="image_path" width="180" height="180">
                                            </div>
                                            
                                            <p>
                                                <h4 class="text-center">{{ $produk-> nama_produk}}</h4>
                                                <p class="text-center">Rp {{ $produk-> harga_produk}}</p>
                                                <div class="text-center">
                                                    <a href="/produk/{{ $produk->id_produk}}" class="btn btn-warning btn-sm">Detail</a>
                                                    <!-- <a href="" class="btn btn-success btn-sm">Input</a> -->
                                                </div>
                                            </p>
                                            
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