<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function layanan()
    {
        $layanan = DB::table('layanan')
                    ->whereNull('tanggal_hapus_layanan_log')
                    ->get();
       return view('layanan',['layanan' => $layanan]);
    }
    
    public function searchLayanan(Request $request)
    {
        $search = $request->get('search');
        $layanan = DB::table('layanan')
        ->whereNull('tanggal_hapus_layanan_log')
        ->where('nama_layanan','like','%'.$search.'%')->paginate(10);
        return view('layanan',['layanan'=> $layanan]);
    }

    public function produk()
    {
        $produk = DB::table('produk')
                    ->whereNull('tanggal_hapus_produk_log')
                    ->get();
       return view('produk',['produk' => $produk]);
    }

    public function searchProduk(Request $request)
    {
        $search = $request->get('search');
        $produk = DB::table('produk')
        ->whereNull('tanggal_hapus_produk_log')
        ->where('nama_produk','like','%'.$search.'%')->paginate(10);
        return view('produk',['produk'=> $produk]);
    }

    public function produk1()
    {
        $produk = DB::table('produk')
                    ->whereNull('tanggal_hapus_produk_log')
                    ->get();
       return view('produk1',['produk' => $produk]);
    }

    public function searchProduk1(Request $request)
    {
        $search1 = $request->get('search1');
        $produk1 = DB::table('produk')
        ->whereNull('tanggal_hapus_produk_log')
        ->where('nama_produk','like','%'.$search.'%')->paginate(10);
        return view('produk1',['produk1'=> $produk1]);
    }

}
