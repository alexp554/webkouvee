@extends('layout/main')

@section('title', 'Form tambah data Transaksi Layanan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Tambah Transaksi Layanan</h3>
                        <form method="post" action="/transaksi_layanan">
                        @csrf
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="hewan">Hewan</label>
                                    <select name="id_hewan" id="id_hewan" class="form-control">
                                    @foreach($hewan as $hewan)
                                        <option value="{{ $hewan->id_hewan }}">{{$hewan->nama_hewan}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <br>
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
