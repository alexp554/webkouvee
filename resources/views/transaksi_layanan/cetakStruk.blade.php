<!DOCTYPE html>
<html>

<head>
    <title>Cetak Struk Layanan Kouvee Pet Shop</title>
</head>
<style>
    .tabledetail{
        border-collapse: collapse;
        border: 1px solid;
        padding: 5px;
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
    <table align="center">
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
            <td colspan="3"><font size="3"><center><strong>NOTA LUNAS</strong></center></font></td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td align="right">{{date(' d F Y H:i', strtotime($transaksi_layanan->tanggal_tambah_transaksi_log))}}</center></td>
        </tr>
        <tr>
            <td>{{$transaksi_layanan->kode_transaksi_layanan}}</td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td>Member : {{$transaksi_layanan->Hewan->Customer->nama_customer}} ({{$transaksi_layanan->Hewan->nama_hewan}} - {{$transaksi_layanan->Hewan->Jenis->nama_jenis}})</td>
            <td align="right" colspan="2">CS : {{ $transaksi_layanan-> user_transaksi_add}}</td>
        </tr>
        <tr>
            <td>Telepon : {{$transaksi_layanan->Hewan->Customer->telepon_customer}}</td>
            <td align="right" colspan="2">Kasir : {{Session::get('nama_pegawai')}}</td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tr>
            <td colspan="3"><font size="3"><center><strong>Jasa Layanan</strong></center></font></td>
        </tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td colspan="3">
            <table cellspacing="0" width='610px' align="center">
                <thead align="left">
                    <tr>
                        <th class="tabledetail">No</th>
                        <th class="tabledetail">Nama Jasa Layanan</th>
                        <th class="tabledetail">Harga</th>
                        <th class="tabledetail">Jumlah</th>
                        <th class="tabledetail">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=1 @endphp
                    @foreach( $detail_transaksi_layanan as $detail_transaksi_layanan)
                        @if($detail_transaksi_layanan->id_transaksi_layanan == $transaksi_layanan->id_transaksi_layanan)
                            <tr>
                                <td class="tabledetail"><center>{{ $i++ }}</center></td>
                                <td class="tabledetail">{{ $detail_transaksi_layanan-> nama_layanan}}</td>
                                <td class="tabledetail">Rp. {{ $detail_transaksi_layanan-> harga_layanan}},-</td>
                                <td class="tabledetail"><center>{{ $detail_transaksi_layanan-> jumlah_detail_layanan}}</center></td>
                                <td class="tabledetail">Rp. {{ $detail_transaksi_layanan-> subtotal_detail_layanan}},-</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody> 
            </table>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td colspan="3"><hr></td>
        </tr>
        <tr>
            <td colspan="3">
                <table align="right" width='185px'>
                    
                        <tr>
                            <td>Sub Total</td>
                            <td>Rp. {{ $transaksi_layanan-> total_transaksi_layanan}}, - </td>
                        </tr>
                        <tr>
                            <td>Diskon</td>
                            <td>Rp. {{ $transaksi_layanan->diskon}}, -</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td>Rp. {{$totalnya}}</td>
                        </tr>
                </table>
            </td>
        </tr>
        <tr><td><br></td></tr>
    </table>
</body>
