<?php

namespace App\Http\Controllers;

use App\Pengadaan;
use App\DetailTransaksiLayanan;
use App\TransaksiLayanan;
use App\TransaksiProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    public function produkTerlaris(Request $request)
    {
        $search = $request->get('tahun');
            for($i = 1; $i <= 12; $i++){
                $transaksi_produk[$i] = \DB::table('transaksi_produk')
                ->join('detail_transaksi_produk','transaksi_produk.id_transaksi_produk','=','detail_transaksi_produk.id_transaksi_produk')
                ->join('produk','detail_transaksi_produk.id_produk','=','produk.id_produk')
                ->whereYear('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log',$search)
                ->whereMonth('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log',$i)
                ->where('status_transaksi_produk','Lunas')
                ->select(DB::raw('DATE_FORMAT(detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log, "%M") as bln'),
                    'produk.nama_produk as nama_produk',
                    \DB::raw('FORMAT(SUM(detail_transaksi_produk.jumlah_detail_produk),0) as count'))
                ->groupBy('produk.nama_produk')
                ->groupBy('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log')
                ->orderBy('count','DESC')
                ->first();
                // $detail_transaksi_produk = DetailTransaksiLayanan::all();
            }
            $bulanSuper = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            
            $tahun = \DB::table('transaksi_produk')
            ->join('detail_transaksi_produk','transaksi_produk.id_transaksi_produk','=','detail_transaksi_produk.id_transaksi_produk')
            ->join('produk','detail_transaksi_produk.id_produk','=','produk.id_produk')
            ->whereYear('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log',$search)
            // ->whereMonth('transaksi.tgl_transaksi',$i)
            ->select(DB::raw('DATE_FORMAT(detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log, "%Y") as thn'))
            ->groupBy('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log')
            ->first();

            $this->data['transaksi_produk'] = $transaksi_produk;
            $this->data['bulan'] = $bulanSuper;
            $this->data['tahun'] = $tahun;
            return view('laporan.laporan_produk_terlaris', $this->data);
    }
    public function layananTerlaris(Request $request)
    {
        $search = $request->get('tahun');
            for($i = 1; $i <= 12; $i++){
                $transaksi_layanan[$i] = \DB::table('transaksi_layanan')
                ->join('detail_transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
                ->join('layanan','detail_transaksi_layanan.id_layanan','=','layanan.id_layanan')
                ->whereYear('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$search)
                ->whereMonth('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$i)
                ->where('status_transaksi_layanan','Lunas')
                ->select(DB::raw('DATE_FORMAT(detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log, "%M") as bln'),
                    'layanan.nama_layanan as nama_layanan',
                    \DB::raw('FORMAT(SUM(detail_transaksi_layanan.jumlah_detail_layanan),0) as count'))
                ->groupBy('layanan.nama_layanan')
                ->groupBy('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log')
                ->orderBy('count','DESC')
                ->first();
                // $detail_transaksi_layanan = DetailTransaksiLayanan::all();
            }
            $bulanSuper = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            
            $tahun = \DB::table('transaksi_layanan')
            ->join('detail_transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
            ->join('layanan','detail_transaksi_layanan.id_layanan','=','layanan.id_layanan')
            ->whereYear('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$search)
            // ->whereMonth('transaksi.tgl_transaksi',$i)
            ->select(DB::raw('DATE_FORMAT(detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log, "%Y") as thn'))
            ->groupBy('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log')
            ->first();

            $this->data['transaksi_layanan'] = $transaksi_layanan;
            $this->data['bulan'] = $bulanSuper;
            $this->data['tahun'] = $tahun;
            return view('laporan.laporan_layanan_terlaris', $this->data);
    }

    public function pendapatanBulanan(Request $request)
    {
            $searchTahun = $request->get('tahun');
            $searchBulan = $request->get('bulan');
                // $bulananLayanan = \DB::table('transaksi_layanan')
                // ->join('detail_transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
                // ->join('layanan','detail_transaksi_layanan.id_layanan','=','layanan.id_layanan')
                // ->where('transaksi_layanan.status_transaksi_layanan','Lunas')
                // ->whereYear('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchTahun)
                // ->whereMonth('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchBulan)
                // ->select(DB::raw('layanan.nama_layanan as nama_l'),DB::raw('FORMAT(SUM(detail_transaksi_layanan.subtotal_detail_layanan),0) as total'))
                // ->groupBy('nama_l')

                $bulananLayanan = TransaksiLayanan::select(DB::raw("layanan.nama_layanan as nama_layanan"),
                DB::raw("FORMAT(SUM(detail_transaksi_layanan.subtotal_detail_layanan),0) as total"))
                ->join('detail_transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
                ->join('layanan','detail_transaksi_layanan.id_layanan','=','layanan.id_layanan')
                ->where('status_transaksi_layanan','Lunas')
                ->whereNull('tanggal_hapus_layanan_log')
                ->whereYear('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchTahun)
                ->whereMonth('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchBulan)
                ->groupBy('nama_layanan')
                ->get();

                $bulananProduk = TransaksiProduk::select(DB::raw("produk.nama_produk as nama_produk"),
                DB::raw("FORMAT(SUM(detail_transaksi_produk.subtotal_detail_produk),0) as total"))
                ->join('detail_transaksi_produk','transaksi_produk.id_transaksi_produk','=','detail_transaksi_produk.id_transaksi_produk')
                ->join('produk','detail_transaksi_produk.id_produk','=','produk.id_produk')
                ->where('status_transaksi_produk','Lunas')
                ->whereNull('tanggal_hapus_produk_log')
                ->whereYear('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log',$searchTahun)
                ->whereMonth('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log',$searchBulan)
                ->groupBy('nama_produk')
                ->get();

        $totalBulanLayanan = DB::table('transaksi_layanan')
        ->join('detail_transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
        ->where('status_transaksi_layanan','Lunas')
        ->whereYear('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchTahun)
        ->whereMonth('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchBulan)
        ->select(DB::raw('FORMAT(SUM(subtotal_detail_layanan),0) as subtotal'))
        ->first();

        $totalBulanProduk = DB::table('transaksi_produk')
        ->join('detail_transaksi_produk','transaksi_produk.id_transaksi_produk','=','detail_transaksi_produk.id_transaksi_produk')
        ->where('status_transaksi_produk','Lunas')
        ->whereYear('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log',$searchTahun)
        ->whereMonth('detail_transaksi_produk.tanggal_tambah_detail_transaksi_produk_log',$searchBulan)
        ->select(DB::raw('FORMAT(SUM(subtotal_detail_produk),0) as subtotal'))
        ->first();

        $tahun = \DB::table('transaksi_layanan')
        ->join('detail_transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
        ->join('layanan','detail_transaksi_layanan.id_layanan','=','detail_transaksi_layanan.id_layanan')
        ->where('status_transaksi_layanan','Lunas')
        ->whereNull('tanggal_hapus_layanan_log')
        ->whereYear('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchTahun)
        ->whereMonth('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchBulan)
        ->select(DB::raw('DATE_FORMAT(detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log, "%Y") as thn'))
        ->groupBy('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log')
        ->first();

        $bulanSuper = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $bulan = \DB::table('transaksi_layanan')
        ->join('detail_transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
        ->join('layanan','detail_transaksi_layanan.id_layanan','=','detail_transaksi_layanan.id_layanan')
        ->where('status_transaksi_layanan','Lunas')
        ->whereNull('tanggal_hapus_layanan_log')
        ->whereYear('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchTahun)
        ->whereMonth('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log',$searchBulan)
        ->select(DB::raw('DATE_FORMAT(detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log, "%M") as bln'))
        ->groupBy('detail_transaksi_layanan.tanggal_tambah_detail_transaksi_layanan_log')
        ->first();

        $bulan1 = $searchBulan;
        
        $this->data['bulananLayanan'] = $bulananLayanan;
        $this->data['bulananProduk'] = $bulananProduk;
        $this->data['totalBulanLayanan'] = $totalBulanLayanan;
        $this->data['totalBulanProduk'] = $totalBulanProduk;


        $this->data['bulan1'] = $bulan1;
        $this->data['bulan'] = $bulan;
        $this->data['tahun'] = $tahun;

        return view('laporan.laporan_pendapatan_bulanan', $this->data);
    }

    public function laporanPengadaanTahunan(Request $request)
    {
        $search = $request->get('tahun');

        for($i = 1; $i<= 12; $i++){
            
            $pengadaanTahunan[$i] = \DB::table('pengadaan')
            ->where('status_pengadaan','Selesai')
            ->whereYear('pengadaan.tanggal_pengadaan',$search)
            ->whereMonth('pengadaan.tanggal_pengadaan',$i)
            ->select(DB::raw('DATE_FORMAT(pengadaan.tanggal_pengadaan,"%M") as bln'),
                DB::raw('FORMAT(SUM(pengadaan.total_pengadaan),0) as total'))
            ->groupBy('bln')
            ->first();

            // $pengadaanTahunan[$i] = Pengadaan::select(DB::raw("pengadaan.tanggal_pengadaan as bln"), 
            // DB::raw("FORMAT(SUM(pengadaan.total_pengadaan),0) as total"))
            // ->where('pengadaan.status_pengadaan','Selesai')
            // ->whereYear('pengadaan.tanggal_pengadaan',$search)
            // ->whereMonth('pengadaan.tanggal_pengadaan',$i)
            // ->groupBy('bln')
            // ->orderBy('total','DESC')
            // ->get();
        }
        
        $subtotalsetahun = DB::table('pengadaan')
        ->where('status_pengadaan','Selesai')
        ->whereYear('pengadaan.tanggal_pengadaan',$search)
        ->select(DB::raw('FORMAT(SUM(total_pengadaan),0) as subtotal'))
        ->first();

        $bulanSuper = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        
        $tahun = \DB::table('pengadaan')
        ->where('status_pengadaan','Selesai')
        ->whereYear('pengadaan.tanggal_pengadaan',$search)
        ->select(DB::raw('DATE_FORMAT(pengadaan.tanggal_pengadaan, "%Y") as thn'))
        ->groupBy('pengadaan.tanggal_pengadaan')
        ->first();
        
        $this->data['pengadaanTahunan'] = $pengadaanTahunan;
        $this->data['subtotalsetahun'] = $subtotalsetahun;
        $this->data['bulan'] = $bulanSuper;
        $this->data['tahun'] = $tahun;

        return view('laporan.laporan_pengadaan_tahunan', $this->data);
    }

    public function laporanPengadaanBulanan(Request $request){
        $searchTahun = $request->get('tahun');
        $searchBulan = $request->get('bulan');
        
        $pengadaanBulan = Pengadaan::select(DB::raw("produk.nama_produk as nama_produk"),
        DB::raw("FORMAT(SUM(detail_pengadaan.subtotal_detail_pengadaan),0) as total"))
        ->join('detail_pengadaan','pengadaan.id_pengadaan','=','detail_pengadaan.id_pengadaan')
        ->join('produk','detail_pengadaan.id_produk','=','produk.id_produk')
        ->whereYear('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchTahun)
        ->whereMonth('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchBulan)
        ->groupBy('nama_produk')
        ->orderBy('total','DESC')
        ->get();

        $subtotalsebulan = DB::table('pengadaan')
        ->join('detail_pengadaan','pengadaan.id_pengadaan','=','detail_pengadaan.id_pengadaan')
        ->join('produk','produk.id_produk','=','detail_pengadaan.id_produk')
        ->whereNull('tanggal_hapus_pengadaan_log')
        ->whereYear('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchTahun)
        ->whereMonth('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchBulan)
        ->select(DB::raw('FORMAT(SUM(detail_pengadaan.subtotal_detail_pengadaan),0) as subtotal'))
        ->first();

        $tahun = \DB::table('detail_pengadaan')
        ->join('produk','produk.id_produk','=','detail_pengadaan.id_produk')
        ->whereYear('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchTahun)
        ->whereMonth('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchBulan)
        ->select(DB::raw('FORMAT(SUM(IFNULL(subtotal_detail_pengadaan,0)),0) as total'))
        ->groupBy('detail_pengadaan.tanggal_tambah_detail_pengadaan_log')
        ->first();

        $bulanSuper = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $bulan = \DB::table('pengadaan')
        ->join('detail_pengadaan','pengadaan.id_pengadaan','=','detail_pengadaan.id_pengadaan')
        ->join('produk','produk.id_produk','=','detail_pengadaan.id_produk')
        ->whereYear('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchTahun)
        ->whereMonth('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchBulan)
        ->select(DB::raw('FORMAT(SUM(IFNULL(subtotal_detail_pengadaan,0)),0) as subtotal'))
        ->groupBy('detail_pengadaan.tanggal_tambah_detail_pengadaan_log')
        ->first();

        $bulan1 = $searchBulan;
        
        $this->data['pengadaanBulan'] = $pengadaanBulan;
        $this->data['subtotalsebulan'] = $subtotalsebulan;

        // $this->data['subtotalsetahun'] = $subtotalsetahun;
        $this->data['bulan1'] = $bulan1;
        $this->data['bulan'] = $bulan;
        $this->data['tahun'] = $tahun;

        return view('laporan.laporan_pengadaan_bulanan', $this->data);
    }

    public function cetakPengadaanBulanan(Request $request){
        $searchTahun = $request->get('tahun');
        $searchBulan = $request->get('bulan');
        
        $pengadaanBulan = Pengadaan::select(DB::raw("produk.nama_produk as nama_produk"),
        DB::raw("FORMAT(SUM(detail_pengadaan.subtotal_detail_pengadaan),0) as total"))
        ->join('detail_pengadaan','pengadaan.id_pengadaan','=','detail_pengadaan.id_pengadaan')
        ->join('produk','detail_pengadaan.id_produk','=','produk.id_produk')
        ->whereYear('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchTahun)
        ->whereMonth('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchBulan)
        ->groupBy('nama_produk')
        ->orderBy('total','DESC')
        ->get();

        $subtotalsebulan = DB::table('pengadaan')
        ->join('detail_pengadaan','pengadaan.id_pengadaan','=','detail_pengadaan.id_pengadaan')
        ->join('produk','produk.id_produk','=','detail_pengadaan.id_produk')
        ->whereYear('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchTahun)
        ->whereMonth('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchBulan)
        ->select(DB::raw('FORMAT(SUM(IFNULL(detail_pengadaan.subtotal_detail_pengadaan,0)),0) as subtotal'))
        ->first();

        $tahun = \DB::table('detail_pengadaan')
        ->join('produk','produk.id_produk','=','detail_pengadaan.id_produk')
        ->whereYear('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchTahun)
        ->whereMonth('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchBulan)
        ->select(DB::raw('FORMAT(SUM(IFNULL(subtotal_detail_pengadaan,0)),0) as total'))
        ->groupBy('detail_pengadaan.tanggal_tambah_detail_pengadaan_log')
        ->first();

        $bulanSuper = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $bulan = \DB::table('pengadaan')
        ->join('detail_pengadaan','pengadaan.id_pengadaan','=','detail_pengadaan.id_pengadaan')
        ->join('produk','produk.id_produk','=','detail_pengadaan.id_produk')
        ->whereYear('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchTahun)
        ->whereMonth('detail_pengadaan.tanggal_tambah_detail_pengadaan_log',$searchBulan)
        ->select(DB::raw('FORMAT(SUM(IFNULL(subtotal_detail_pengadaan,0)),0) as subtotal'))
        ->groupBy('detail_pengadaan.tanggal_tambah_detail_pengadaan_log')
        ->first();

        $bulan1 = $searchBulan;
        
        $this->data['pengadaanBulan'] = $pengadaanBulan;
        $this->data['subtotalsebulan'] = $subtotalsebulan;

        // $this->data['subtotalsetahun'] = $subtotalsetahun;
        $this->data['bulan1'] = $bulan1;
        $this->data['bulan'] = $bulan;
        $this->data['tahun'] = $tahun;

        // $pdf = PDF::loadview('cetakLaporan.pengadaan_bulanan',$this->data);
        // return $pdf->download('laporan_pengadaan_bulanan.pdf');
        // return view('laporan.laporan_pengadaan_bulanan', $this->data);
    }
}
