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
                            <form method="post" action="/transaksi_layanan/{{$transaksi_layanan->id_transaksi_layanan}}">
                                @method('patch')
                                @csrf
                                    <div class="form-group">
                                        <label for="hewan">Hewan</label>
                                        <select name="id_hewan" id="id_hewan" class="form-control">
                                            @foreach ($hewan as $hewan) 
                                                
                                                <option value="{{ $hewan->id_hewan }}" {{ $hewan->id_hewan == $transaksi_layanan->id_hewan ? 'selected' : '' }}>{{$hewan->nama_hewan}}</option>
                                                
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
