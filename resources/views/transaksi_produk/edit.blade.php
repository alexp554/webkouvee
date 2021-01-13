@extends('layout/main')

@section('title', 'Form Ubah data Transaksi')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Ubah Transaksi</h3>
                        <div class="panel-body">
                            <form method="post" action="/transaksi_produk/{{$transaksi_produk->id_transaksi_produk}}">
                                @method('patch')
                                @csrf
                                    <div class="form-group">
                                        <label for="customer">Customer</label>
                                        <select name="id_customer" id="id_customer" class="form-control">
                                            @foreach ($customer as $customer) 
                                                
                                                <option value="{{ $customer->id_customer }}" {{ $customer->id_customer == $transaksi_produk->id_customer ? 'selected' : '' }}>{{$customer->nama_customer}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
