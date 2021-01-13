@extends('layout/main')

@section('title', 'Form tambah data Transaksi Layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                    <h3 class="text-center">Tambah Layanan</h3>
                        <div class="panel-body">
                            <form method="post" action="/transaksi_layanan/{{$transaksi_layanan->id_transaksi_layanan}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Layanan</label>
                                    <select name="id_layanan" id="id_layanan" class="form-control">
                                    @foreach($layanan as $layanan)
                                        <option value="{{ $layanan->id_layanan }}">{{$layanan->nama_layanan}}</option>
                                    @endforeach
                                    </select>
                                    <br>
                                    <label for="jumlah_detail_layanan">Jumlah Layanan</label>
                                    <input type="number" class="form-control @error('jumlah_detail_layanan') is-invalid @enderror" id="jumlah_detail_layanan" name="jumlah_detail_layanan" placeholder="Masukkan jumlah layanan" value="{{old('jumlah_detail_layanan')}}">
                                    @error('jumlah_detail_layanan')
                                        <div class="ivalid-feedback">{{$message}}</div>
                                    @enderror
                                    <br>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
