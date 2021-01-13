@extends('layout/main')

@section('title', 'Form tambah data Transaksi Produk')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Tambah Transaksi Produk</h3>
                        <form method="post" action="/transaksi_produk">
                        @csrf
                            <div class="panel-body">
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="customer">Customer</label>
                                    <select name="id_customer" id="id_customer" class="form-control">
                                    @foreach($customer as $customer)
                                        <option value="{{ $customer->id_customer }}">{{$customer->nama_customer}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
