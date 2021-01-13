@extends('layout/main')

@section('title', 'Fornm edit data hewan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">

                        <h3 class="text-center">Edit Data Hewan</h3>
                        <div class="panel-body">
                        <form method="post" action="/hewan/{{$hewan->id_hewan}}">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Hewan</label>
                                <input type="text" class="form-control @error('nama_hewan') is-invalid @enderror" id="nama" name="nama_hewan" placeholder="Masukkan nama Hewan" value="{{$hewan->nama_hewan}}">
                                @error('nama_hewan')
                                    <div class="ivalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal Lahir Hewan</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal_lahir_hewan" placeholder="Masukkan tanggal lahir hewan" value="{{$hewan->tanggal_lahir_hewan}}">
                                @error('tanggal_lahir_hewan')
                                    <div class="ivalid-feedback text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nama">Ukuran Hewan</label>
                                <select name="id_ukuran" id="id_ukuran" class="form-control" >
                                    @foreach ($ukuran as $ukur)
                                        <option value="{{ $ukur->id_ukuran }}" {{ $ukur->id_ukuran == $hewan->id_ukuran ? 'selected' : '' }}>{{$ukur->nama_ukuran}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Jenis Hewan</label>
                                <select name="id_jenis" id="id_jenis" class="form-control">
                                    @foreach ($jenis as $jenis) 
                                        <option value="{{ $jenis->id_jenis }}" {{ $jenis->id_jenis == $hewan->id_jenis ? 'selected' : '' }}>{{$jenis->nama_jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Customer Hewan</label>
                                <select name="id_customer" id="id_customer" class="form-control">
                                    @foreach ($customer as $customer)
                                        <option value="{{ $customer->id_customer }}" {{ $customer->id_customer == $hewan->id_customer ? 'selected' : '' }}>{{$customer->nama_customer}}</option>
                                    @endforeach
                                </select>
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