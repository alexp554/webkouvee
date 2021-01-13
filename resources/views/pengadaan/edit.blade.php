@extends('layout/main')

@section('title', 'Form Ubah data Pengadaan')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Ubah Pengadaan</h3>
                        <div class="panel-body">
                            <form method="post" action="/pengadaan/{{$pengadaan->id_pengadaan}}">
                                @method('patch')
                                @csrf
                                    <div class="form-group">
                                        <label for="supplier">Supplier</label>
                                        <select name="id_supplier" id="id_supplier" class="form-control">
                                            @foreach ($supplier as $supplier) 
                                                
                                                <option value="{{ $supplier->id_supplier }}" {{ $supplier->id_supplier == $pengadaan->id_supplier ? 'selected' : '' }}>{{$supplier->nama_supplier}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status_pengadaan" id="status_pengadaan" class="form-control">
                                            <option value="{{$pengadaan->status_pengadaan}}"> {{$pengadaan->status_pengadaan}}</option>
                                            @if($pengadaan->status_pengadaan == 'Selesai')
                                                <option value="Belum Selesai">Belum Selesai</option>
                                            @else
                                                <option value="Selesai">Selesai</option>
                                            @endif
                                        </select>
                                    </div> -->
                                    <br>
                                        <label for="tanggal pengadaan">Tanggal Pengadaan</label>
                                        <input type="date" class="form-control @error('tanggal_pengadaan') is-invalid @enderror" id="tanggal_pengadaan" name="tanggal_pengadaan" placeholder="Masukkan Tanggal Lahir" value="{{$pengadaan->tanggal_pengadaan}}">
                                        @error('tanggal_pengadaan')
                                            <div class="ivalid-feedback">{{$message}}</div>
                                        @enderror
                                    <br>
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
