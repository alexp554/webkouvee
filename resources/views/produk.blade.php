@extends('layout/main')

@section('title', 'Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- <div class="panel"> -->
            
                        <h1 class="text-center mt-4">Daftar Produk</h1>

                        <!-- <div class="panel-body"> -->
                            <!-- <div class="col">
                                <form action="/search_produk_kami" method="get">
                                    <div class="input-group ukuran">
                                        <input type="search" name="search" class="form-control" placeholder="Cari nama produk">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div> -->
                            <div class="text-left">
                                <a href="/produk_kami1" class="btn btn-success"><i class="lnr lnr-dice"></i></a>
                            </div>
                            <div class="text-right">
                                <a href="/produk_kami" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                            </div>
                            <br>
                            @if(session('status'))
                                <div class="alert alert-success text-center">
                                <i class="fa fa-check-circle"></i>
                                    {{session('status')}}
                                </div>
                            @endif

                            <div>
                                <table class="table" id="table-datatables">
                                    <thead class="thead">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Harga Produk</th>
                                            <th scope="col">Stok Produk</th>
                                            <th scope="col">Gambar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $produk as $produk)
                                            <tr>
                                                <th scope="row">{{$produk-> id_produk}}</th>
                                                <td>{{ $produk-> nama_produk}}</td>
                                                <td>{{ $produk-> harga_produk}}</td>
                                                <td>{{ $produk-> stok_produk}}</td>
                                                <td>
                                                    <img src="{{asset($produk->image_path)}}" alt="image_path" width="180" height="180">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>    
                                </table>
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