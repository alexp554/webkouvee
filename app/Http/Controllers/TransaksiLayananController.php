<?php

namespace App\Http\Controllers;

use App\TransaksiLayanan;
use App\DetailTransaksiLayanan;
use App\Hewan;
use App\Layanan;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Nexmo\Laravel\Facade\Nexmo;
use PDF;

class TransaksiLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi_layanan = DB::table('transaksi_layanan')
                    ->join('hewan','hewan.id_hewan','=','transaksi_layanan.id_hewan')
                    ->join('jenis','jenis.id_jenis','=','hewan.id_jenis')
                    ->join('ukuran','ukuran.id_ukuran','=','hewan.id_ukuran')
                    ->whereNull('tanggal_hapus_transaksi_log')
                    ->orderBy('id_transaksi_layanan')
                    ->get();

       return view('transaksi_layanan.index',['transaksi_layanan' => $transaksi_layanan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hewan = Hewan::all();
        $data = array(
            'hewan' => $hewan
        );
        return view('transaksi_layanan.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi_layanan = new TransaksiLayanan;
        $transaksi_layanan->tanggal_transaksi_layanan = now();
        $transaksi_layanan->id_hewan = $request->id_hewan;
        $transaksi_layanan->user_transaksi_add = Session::get('nama_pegawai');
        $transaksi_layanan->status_transaksi_layanan = 'Belum Selesai';

        $last_id = TransaksiLayanan::latest()->first()->id_transaksi_layanan;
        $temp_id = $last_id+1;

        if($temp_id < 10)
        {
            $transaksi_layanan->kode_transaksi_layanan = 'LY'.'-'.date("dmy").'-'.'0'.($temp_id);
        }
        else 
        {
            $transaksi_layanan->kode_transaksi_layanan = 'LY'.'-'.date("dmy").'-'.($temp_id);
        }

        $transaksi_layanan->save();

        return redirect('/transaksi_layanan')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiLayanan $transaksi_layanan)
    {
        // return view('detail_transaksi_produk.index', compact('detail_transaksi_produk'));
        $detail_transaksi_layanan = DB::table('detail_transaksi_layanan')
                    ->join('transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
                    ->join('layanan','layanan.id_layanan','=','detail_transaksi_layanan.id_layanan')
                    ->get();
                    return view('transaksi_layanan/show', compact('transaksi_layanan'),['detail_transaksi_layanan' => $detail_transaksi_layanan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiLayanan $transaksi_layanan)
    {
        $hewan = Hewan::all();
        return view('transaksi_layanan.edit',compact('transaksi_layanan'),['hewan'=>$hewan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,TransaksiLayanan $transaksi_layanan)
    {
        TransaksiLayanan::where('id_transaksi_layanan', $transaksi_layanan->id_transaksi_layanan)
                ->update([
                    'id_hewan' => $request->id_hewan,
                    'tanggal_transaksi_layanan' => now(),
                    'user_transaksi_edit' => Session::get('nama_pegawai'),
                ]);

        return redirect('/transaksi_layanan')->with('status', 'Data Transaksi layanan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiLayanan $transaksi_layanan)
    {
        TransaksiLayanan::where('id_transaksi_layanan', $transaksi_layanan->id_transaksi_layanan)
                ->update([
                    'user_transaksi_delete' => Session::get('nama_pegawai'),
                ]);

        TransaksiLayanan:: destroy($transaksi_layanan->id_transaksi_layanan);
        return redirect('/transaksi_layanan')->with('status', 'Data transaksi layanan berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $transaksi_layanan = DB::table('transaksi_layanan')
                    ->join('hewan','transaksi_layanan.id_hewan','=','hewan.id_hewan')
                    ->whereNull('tanggal_hapus_transaksi_log')
                    ->where('nama_hewan','like','%'.$search.'%')->paginate(10);
        return view('/transaksi_layanan/index',['transaksi_layanan'=> $transaksi_layanan]);
    }

    public function createLayanan(TransaksiLayanan $transaksi_layanan)
    {
        $layanan = Layanan::all();
        $data = array(
            'layanan' => $layanan
        );
        return view('detail_transaksi_layanan.create',compact('transaksi_layanan'),$data);
    }

    public function storeLayanan(Request $request, TransaksiLayanan $transaksi_layanan)
    {
        $request->validate([
            'jumlah_detail_layanan' => 'required'
        ]);
        
        
        $detail_transaksi_layanan = new DetailTransaksiLayanan;
        $detail_transaksi_layanan->jumlah_detail_layanan = $request->jumlah_detail_layanan;
        $detail_transaksi_layanan->id_layanan = $request->id_layanan;
        $detail_transaksi_layanan->id_transaksi_layanan = $transaksi_layanan->id_transaksi_layanan;
        $detail_transaksi_layanan->subtotal_detail_layanan = $request->jumlah_detail_layanan * Layanan::where('id_layanan', $request->id_layanan)->first()->harga_layanan;
        $detail_transaksi_layanan->save();
        
        $subtotal_layanan = $request->jumlah_detail_layanan * Layanan::where('id_layanan', $request->id_layanan)->first()->harga_layanan;
        $transaksi_layanan->total_transaksi_layanan = $transaksi_layanan->total_transaksi_layanan + $subtotal_layanan;
        $transaksi_layanan->save();

        TransaksiLayanan::where('id_transaksi_layanan', $transaksi_layanan->id_transaksi_layanan)
                ->update([
                    'user_transaksi_edit' => Session::get('nama_pegawai'),
                ]);

        return redirect()->route('ShowDetailTransaksiLayanan',compact('transaksi_layanan'))->with('status', 'Data layanan berhasil ditambah');
    }

    public function editLayanan(TransaksiLayanan $transaksi_layanan, DetailTransaksiLayanan $detail_transaksi_layanan)
    {
        $layanan = Layanan::all();
        
        return view('detail_transaksi_layanan.edit',compact('transaksi_layanan','detail_transaksi_layanan'),['layanan'=>$layanan]);
    }

    public function updateLayanan(Request $request, TransaksiLayanan $transaksi_layanan, DetailTransaksiLayanan $detail_transaksi_layanan)
    {
        $request->validate([
            'jumlah_detail_layanan' => 'required',
        ]);
        DetailTransaksiLayanan::where('id_detail_layanan', $detail_transaksi_layanan->id_detail_layanan)
                ->update([
                    'id_layanan' => $request->id_layanan,
                    'jumlah_detail_layanan' => $request->jumlah_detail_layanan,
                    'subtotal_detail_layanan' => $request->jumlah_detail_layanan * Layanan::where('id_layanan', $request->id_layanan)->first()->harga_layanan,
                ]);
        
        TransaksiLayanan::where('id_transaksi_layanan', $transaksi_layanan->id_transaksi_layanan)
        ->update([
            'user_transaksi_edit' => Session::get('nama_pegawai'),
        ]);

        $subtotal_layanan = $request->jumlah_detail_layanan * Layanan::where('id_layanan', $request->id_layanan)->first()->harga_layanan;
        $transaksi_layanan->total_transaksi_layanan = ($transaksi_layanan->total_transaksi_layanan - $detail_transaksi_layanan->subtotal_detail_layanan) + $subtotal_layanan;
        $transaksi_layanan->save();

        return redirect()->route('ShowDetailTransaksiLayanan',compact('transaksi_layanan'))->with('status', 'Data layanan berhasil diubah');
    }

    public function destroyLayanan(TransaksiLayanan $transaksi_layanan, DetailTransaksiLayanan $detail_transaksi_layanan)
    {
        $transaksi_layanan->total_transaksi_layanan = $transaksi_layanan->total_transaksi_layanan - $detail_transaksi_layanan->subtotal_detail_layanan;
        $transaksi_layanan->save();

        TransaksiLayanan::where('id_transaksi_layanan', $transaksi_layanan->id_transaksi_layanan)
        ->update([
            'user_transaksi_edit' => Session::get('nama_pegawai'),
        ]);
        DetailTransaksiLayanan::destroy($detail_transaksi_layanan->id_detail_layanan);

        return redirect()->route('ShowDetailTransaksiLayanan',compact('transaksi_layanan'))->with('status', 'Data layanan berhasil dihapus');
    }

    public function sendSms(TransaksiLayanan $transaksi_layanan)
    {
        
        $detail_transaksi_layanan = DB::table('detail_transaksi_layanan')
        ->join('transaksi_layanan','transaksi_layanan.id_transaksi_layanan', '=', 'detail_transaksi_layanan.id_transaksi_layanan')
        ->where('detail_transaksi_layanan.id_transaksi_layanan','=', $transaksi_layanan->id_transaksi_layanan)
        ->get();

        $transaksi_layanan->status_transaksi_layanan = 'Menunggu Pembayaran';
        $transaksi_layanan->save();

        foreach($detail_transaksi_layanan as $dp){
            if($dp->id_layanan == 1)
            {
                $nomor_hp = DB::table('customer')
                ->join('hewan','customer.id_customer', '=', 'hewan.id_customer')
                ->join('transaksi_layanan','hewan.id_hewan', '=', 'transaksi_layanan.id_hewan')
                ->where('hewan.id_hewan','=', $transaksi_layanan->id_hewan)
                ->first()
                ->nomor_telepon;

                //echo $nomor_hp;

                $nama_hewan = DB::table('hewan')
                ->join('transaksi_layanan','transaksi_layanan.id_hewan', '=', 'hewan.id_hewan')
                ->where('hewan.id_hewan','=', $transaksi_layanan->id_hewan)
                ->first()
                ->nama_hewan;

                // echo $nama_hewan;

                Nexmo::message()->send([
                    'to' => '62'.$nomor_hp,
                    'from' => 'Pet Shop',
                    'text' => 'Transaksi Layanan'.'
---'.$transaksi_layanan->kode_transaksi_layanan.'---
'.'

'.'Dengan layanan Grooming hewan anda yang bernama'.' '.$nama_hewan.' '.'telah selesai, silahkan ke kasir untuk melakukan pembayaran
                    
'.'
----------'
                ]);

                return redirect()->route('ShowDetailTransaksiLayanan',compact('transaksi_layanan'))->with('status', 'Layanan telah selesai dan SMS berhasil dikirim, silahkan menuju ke kasir untuk melakukan pembayaran');
            }
            else
            {
                return redirect()->route('ShowDetailTransaksiLayanan',compact('transaksi_layanan'))->with('status', 'Layanan telah selesai, silahkan menuju ke kasir untuk melakukan pembayaran');
            }
        }

    }

    // public function sms(TransaksiLayanan $transaksi_layanan)
    // {
    //     Nexmo::message()->send([
    //         'to' => '628979767067',
    //         'from' => 'Vonage APIs',
    //         'text' => 'Hello from Vonage SMS API'
    //     ]);

    //     Session::flash('success', 'SMS berhasil dikirim');
    //     return redirect()->route('ShowDetailTransaksiLayanan',compact('transaksi_layanan'))->with('status', 'Data Transaksi Layanan berhasil diverifikasi');
    // }

    public function pembayaran(Request $request,TransaksiLayanan $transaksi_layanan)
    {
        if($transaksi_layanan->total_transaksi_layanan > $request->uang_customer)
        {
            return redirect()->route('ShowDetailTransaksiLayanan',compact('transaksi_layanan'))->with('gagal', 'Maaf uang yang diterima kurang');
        }
        else
        {
            $detail_transaksi_layanan = DB::table('detail_transaksi_layanan')
                    ->join('transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
                    ->join('layanan','layanan.id_layanan','=','detail_transaksi_layanan.id_layanan')
                    ->get();

            $kembalian = $request->uang_customer - ($transaksi_layanan->total_transaksi_layanan - $request->diskon);

            $transaksi_layanan->status_transaksi_layanan = 'Lunas';
            $transaksi_layanan->diskon = $request->diskon;
            $transaksi_layanan->save();

            TransaksiLayanan::where('id_transaksi_layanan', $transaksi_layanan->id_transaksi_layanan)
                ->update([
                    'user_transaksi_edit' => Session::get('nama_pegawai'),
                ]);

            return redirect()->route('ShowDetailTransaksiLayanan',compact('transaksi_layanan'))->with('status', 'Transaksi Pembayaran Sukses')
            ->with('uang_customer', $request->uang_customer)
            ->with('diskon', $request->diskon)
            ->with('kembalian', $kembalian);
           
        }
    }

    public function cetakStruk(TransaksiLayanan $transaksi_layanan)
    {
        $detail_transaksi_layanan = DB::table('detail_transaksi_layanan')
                    ->join('transaksi_layanan','transaksi_layanan.id_transaksi_layanan','=','detail_transaksi_layanan.id_transaksi_layanan')
                    ->join('layanan','layanan.id_layanan','=','detail_transaksi_layanan.id_layanan')
                    ->get();
                  
        $layanan = Layanan::all();
        $hewan = Hewan::all();

        $totalnya = $transaksi_layanan->total_transaksi_layanan - $transaksi_layanan->diskon;

        $data = array(
            'transaksi_layanan' => $transaksi_layanan,
            'detail_transaksi_layanan' => $detail_transaksi_layanan,
            'layanan' => $layanan,
            'hewan' => $hewan,
            'totalnya'=> $totalnya
        );
    
        $pdf = PDF::loadview('transaksi_layanan.cetakStruk', $data);
        return $pdf->stream();
        
        // return view('transaksi_layanan.cetakStruk', $data);
        //return $pdf->download('laporan-review-pdf.pdf');
    
    }

    public function filterPertama(Request $request)
    {
        $transaksi_layanan = DB::table('transaksi_layanan')
                    ->join('hewan','hewan.id_hewan','=','transaksi_layanan.id_hewan')
                    ->join('jenis','jenis.id_jenis','=','hewan.id_jenis')
                    ->join('ukuran','ukuran.id_ukuran','=','hewan.id_ukuran')
                    ->whereNull('tanggal_hapus_transaksi_log')
                    ->where('transaksi_layanan.status_transaksi_layanan','=', 'Menunggu Pembayaran')
                    ->orderBy('id_transaksi_layanan')
                    ->get();

        return view('/transaksi_layanan/index',['transaksi_layanan'=> $transaksi_layanan]);
    }

    public function filterKedua(Request $request)
    {
        $transaksi_layanan = DB::table('transaksi_layanan')
                    ->join('hewan','hewan.id_hewan','=','transaksi_layanan.id_hewan')
                    ->join('jenis','jenis.id_jenis','=','hewan.id_jenis')
                    ->join('ukuran','ukuran.id_ukuran','=','hewan.id_ukuran')
                    ->whereNull('tanggal_hapus_transaksi_log')
                    ->where('transaksi_layanan.status_transaksi_layanan','=', 'Lunas')
                    ->orderBy('id_transaksi_layanan')
                    ->get();

        return view('/transaksi_layanan/index',['transaksi_layanan'=> $transaksi_layanan]);
    }
}
