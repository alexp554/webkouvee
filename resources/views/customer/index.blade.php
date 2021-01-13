@extends('layout/main')

@section('title', 'Customer')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h1 class="text-center">Daftar Customer</h1>
						<div class="panel-body">
                            <div class="col text-right">
                                <a href="/customer/create" class="btn btn-primary">Tambah Customer</a>
                            </div>
                                <form action="/search_customer" method="get">
                                    <div class="input-group ukuran">
                                        <input type="search" name="search" class="form-control" placeholder="Cari nama customer">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                                <div class="text-right">
                                    <a href="/customer" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success text-center">
                                    <i class="fa fa-check-circle"></i>
                                        {{session('status')}}
                                    </div>
                                @endif
                                <table class="table">
                                        <thead class="thead">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Customer</th>
                                                <th scope="col">Alamat</th>
                                                <th scope="col">Tanggal Lahir</th>
                                                <th scope="col">Nomor Telephone</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $customer as $customer)
                                                <tr>
                                                        <th scope="row">{{ $loop->iteration}}</th>
                                                        <td>{{ $customer-> nama_customer}}</td>
                                                        <td>{{ $customer-> alamat_customer}}</td>
                                                        <td>{{ $customer-> tgl_lahir_customer}}</td>
                                                        <td>{{ $customer-> telepon_customer}}</td>
                                                        <td>
                                                            <a href="/customer/{{ $customer->id_customer}}" class="btn btn-warning btn-sm">Detail</a>
                                                        </td>
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

<style>
  .ukuran{
   width:500px;
  }
  .tombol{
        height:34px;
    }
 </style>