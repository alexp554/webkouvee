@extends('layout/main')

@section('title', 'Form tambah data Pengadaan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Tambah Pengadaan</h3>
                        <form method="post" action="/pengadaan">
                        @csrf
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="supplier">Supplier</label>
                                    <select name="id_supplier" id="id_supplier" class="form-control">
                                    @foreach($supplier as $supplier)
                                        <option value="{{ $supplier->id_supplier }}">{{$supplier->nama_supplier}}</option>
                                    @endforeach
                                    </select>
                                    <br>
                                    <label for="tanggal pengadaan">Tanggal pengadaan </label>
                                    <input type="date" class="form-control @error('tanggal_pengadaan') is-invalid @enderror" id="tanggal_pengadaan" name="tanggal_pengadaan" placeholder="Masukkan Tanggal Pengadaan" value="{{old('tanggal_pengadaan')}}">
                                    @error('tanggal_pengadaan')
                                        <div class="ivalid-feedback">{{$message}}</div>
                                    @enderror
                                    <br>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
