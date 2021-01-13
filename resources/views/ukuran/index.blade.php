@extends('layout/main')

@section('title', 'Ukuran')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <h3 class="text-center">Daftar Ukuran Hewan</h3>
                            <div class="panel-body">
                                <div class="col text-right">
                                    <a href="/ukuran/create" class="btn btn-primary">Tambah Ukuran Hewan</a>
                                </div>
                                <div class="col my-4">
                                    <form action="/search_ukuran" method="get">
                                        <div class="input-group ukuran">
                                            <input type="search" name="search" class="form-control" placeholder="Cari ukuran">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-secondary tombol"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="text-right">
                                    <a href="/ukuran" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i></a>
                                </div>
                                @if (session('status'))
                                    <div class="alert alert-success text-center">
                                        <i class="fa fa-check-circle"></i>
                                        {{session('status')}}
                                    </div>
                                @endif
                                <table class="table table-sm">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Id</th>
                                                <th scope="col">Nama Ukuran</th>
                                                <th scope="col">User Log</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach( $ukuran as $ukuran)
                                                <tr>
                                                        <th scope="row">{{ $loop->iteration}}</th>
                                                        <td>{{ $ukuran-> id_ukuran}}</td>
                                                        <td>{{ $ukuran-> nama_ukuran}}</td>
                                                        <td>{{ $ukuran-> user_ukuran_log}}</td>
                                                        <td>
                                                            <a href="/ukuran/{{$ukuran->id_ukuran}}/edit" class="btn btn-primary btn-sm"><i class="lnr lnr-pencil"></i></a>
                                                            <a href="/ukuran/{{$ukuran->id_ukuran}}/destroy" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data tersebut?')"><i class="lnr lnr-trash"></i></a>
                                                            <!-- <form action="/jenis" method="post" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form> -->
                                                        </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
  .ukuran{
   width:500px;
  }
    .tombol{
        height:34px;
    }
 </style>