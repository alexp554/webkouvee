@extends('layout/main')

@section('title', 'Form edit data layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                        <h3 class="text-center">Edit Data Layanan</h3>
                        <div class="panel-body">
                        <form method="post" action="/transaksi_layanan/{{ $transaksi_layanan->id_transaksi_layanan}}/{{$detail_transaksi_layanan->id_detail_layanan}}">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="Nama_layanan">Nama Layanan</label>
                                <select name="id_layanan" id="id_layanan" class="form-control" >
                                    @foreach ($layanan as $layanan)
                                        <option value="{{ $layanan->id_layanan }}" {{ $layanan->id_layanan == $detail_transaksi_layanan->id_layanan ? 'selected' : '' }}>{{$layanan->nama_layanan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_detail_layanan">Jumlah layanan</label>
                                <input type="number" class="form-control @error('jumlah_detail_layanan') is-invalid @enderror" id="jumlah_detail_layanan" name="jumlah_detail_layanan" placeholder="Masukkan Jumlah layanan" value="{{$detail_transaksi_layanan->jumlah_detail_layanan}}">
                                @error('jumlah_detail_layanan')
                                    <div class="ivalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <br>
                            <div class="text-left">
                                <button type="submit" class="btn btn-primary">Ubah Data</button>
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