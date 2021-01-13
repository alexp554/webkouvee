@extends('layout/main')

@section('title', 'Form tambah data Hewan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Tambah Hewan</h3>
                        <div class="panel-body">
                            <form method="post" action="/hewan">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control @error('nama_hewan') is-invalid @enderror" id="nama" name="nama_hewan" placeholder="Masukkan nama Hewan" value="{{old('nama_hewan')}}">
                                    @error('nama_hewan')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama">Jenis</label>
                                    <select name="id_jenis" id="id_jenis" class="form-control">
                                    @foreach($jenis as $jenis)
                                        <option value="{{ $jenis->id_jenis }}">{{$jenis->nama_jenis}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Ukuran</label>
                                    <select name="id_ukuran" id="id_ukuran" class="form-control">
                                    @foreach($ukuran as $ukuran)
                                        <option value="{{ $ukuran->id_ukuran }}">{{$ukuran->nama_ukuran}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select name="id_customer" id="id_customer" class="form-control">
                                    @foreach($customer as $customer)
                                        <option value="{{ $customer->id_customer }}">{{$customer->nama_customer}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Lahir Hewan</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal_lahir_hewan" placeholder="Masukkan tanggal lahir hewan" value="{{old('tanggal_lahir_hewan')}}">
                                    @error('tanggal_lahir_hewan')
                                        <div class="ivalid-feedback text-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <br>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
