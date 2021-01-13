<!DOCTYPE html>
<html>

<head>
    <title>Cetak Surat Pengadaan Kouvee Pet Shop</title>
</head>
<style>
    .tabledetail{
        border-collapse: collapse;
        border: 1px solid;
        padding: 5px;
    }
    .putus{
        border: 2px dashed;
    }
    body{
        border-collapse: collapse;
        border: 2px solid;
        font-family: arial, sans-serif;
        font-size: 12px;
        width: 700px;
        margin: 0 auto;
    }
</style>
<body>
    <table border align="center">
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><img src="https://cdn.pixabay.com/photo/2020/06/01/23/24/pet-5248761_960_720.jpg" width="180px"></td>
            <td>
                <center>
                    <font size="5">Kouvee Pet Shop</font><br>
                    <font size="3"> Jl. Moses Gatotkaca No. 22 Yogyakarta 55281</font><br>
                    <font size="3">Telp. (0274) 357735 </font><br>
                    <font size="3">http://www.sayanghewan.com</font>
                </center>
            </td>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td colspan="3"><font size="3"><center><strong>SURAT PEMESANAN</strong></center></font></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td colspan="3" align="right"><strong>No : {{$pengadaan->kode_pengadaan}}</strong></td>
        </tr>
        <tr>
            <td colspan="2" rowspan="3" class="putus">
                Kepada Yth<br>
                {{$pengadaan->Supplier->nama_supplier}}<br>
                {{$pengadaan->Supplier->alamat_supplier}}<br>
                {{$pengadaan->Supplier->telepon_supplier}}
            </td>
            <td align="right"><strong>Tanggal : {{date(' d F Y', strtotime($pengadaan->tanggal_pengadaan))}}</strong></center></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        
        <tr><td><br></td></tr>
        <tr><td><br></td></tr>
        <tr>
            <td colspan="3"><font size="2">Mohon untuk disediakan produk-produk berikut ini : </font></td>
        </tr>
        <tr>
            <td colspan="3">
            <table cellspacing="0" width='530px' align="center">
                <thead align="left">
                    <tr>
                        <th class="tabledetail">No</th>
                        <th class="tabledetail">Nama Produk</th>
                        <th class="tabledetail">Satuan</th>
                        <th class="tabledetail">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1 @endphp
                    @foreach( $detail_pengadaan as $detail_pengadaan)
                        @if($detail_pengadaan->id_pengadaan == $pengadaan->id_pengadaan)
                            <tr>
                                <td class="tabledetail"><center>{{ $i++ }}</center></td>
                                <td class="tabledetail">{{ $detail_pengadaan-> nama_produk}}</td>
                                <td class="tabledetail">Rp. {{ $detail_pengadaan-> harga_produk}},-</td>
                                <td class="tabledetail"><center>{{ $detail_pengadaan-> jumlah_detail_pengadaan}}</center></td>
                            </tr>
                        @endif
                    @endforeach
                </tbody> 
            </table>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3">
                <table align="right" width='185px'>
                    
                        <tr>
                            <td>Dicetak tanggal {{date(' d F Y', strtotime($waktuNyetak))}}</td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr><td><br></td></tr>
    </table>
</body>
