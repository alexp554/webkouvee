<?php

namespace App\Http\Controllers;

use App\TransaksiProduk;
use App\DetailTransaksiProduk;
use App\Customer;
use App\Produk;
use App\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class TransaksiProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi_produk = DB::table('transaksi_produk')
                    ->join('customer','customer.id_customer','=','transaksi_produk.id_customer')
                    ->whereNull('tanggal_hapus_transaksi_log')
                    ->get();
       return view('transaksi_produk.index',['transaksi_produk' => $transaksi_produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = Customer::all();
        $data = array(
            'customer' => $customer
        );
        return view('transaksi_produk.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi_produk = new TransaksiProduk;
        //$transaksi_produk->status_transaksi_produk = $request->status_transaksi_produk;
        $transaksi_produk->tanggal_transaksi_produk = now();
        //$pengadaan->tanggal_pengadaan = now()->timestamp;
        
        $transaksi_produk->user_transaksi_add = Session::get('nama_pegawai');
        $transaksi_produk->status_transaksi_produk = 'Menunggu Pembayaran';
        $transaksi_produk->id_customer = $request->id_customer;
        $last_id = TransaksiProduk::latest()->first()->id_transaksi_produk;
        $temp_id = $last_id+1;
       
        // $request->tanggal_transaksi_produk = date("ymd");

        if($temp_id < 10)
        {
            $transaksi_produk->kode_transaksi_produk = 'PR'.'-'.date("dmy").'-'.'0'.($temp_id);
        }
        else 
        {
            $transaksi_produk->kode_transaksi_produk = 'PR'.'-'.date("dmy").'-'.($temp_id);
        }

        // if($request->id_customer = )
        //     $customer = DB::table('customer')
        //     ->where([
        //         ['id_customer', $request->id_customer],
        //     ])->first();

        //     $non_member = $customer->nama_customer.'-'.$temp_id;

        //     $customer = new Customer;
        //     $customer->nama_customer = $non_member;
        //     $customer->user_customer_log = Session::get('nama_pegawai');
        //     $cusomter->save();
        // else
        // {
        //     $transaksi_produk->id_customer = $request->id_customer;
        // }


        // if($request->id_customer != 15)
        // {
        // }
        // else
        // {
        //     $transaksi_produk->id_customer = ($request->id_customer).'-'.($temp_id);
            
        // }
            //$pengadaan->kode_pengadaan = concat('PO-',toString($request->tanggal_pengadaan),'-',$request->id_supplier);
            $transaksi_produk->save();

            return redirect('/transaksi_produk')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiProduk $transaksi_produk)
    {
        // return view('detail_transaksi_produk.index', compact('detail_transaksi_produk'));
        $detail_transaksi_produk = DB::table('detail_transaksi_produk')
                    ->join('transaksi_produk','transaksi_produk.id_transaksi_produk','=','detail_transaksi_produk.id_transaksi_produk')
                    ->join('produk','produk.id_produk','=','detail_transaksi_produk.id_produk')
                    ->get();
                    return view('transaksi_produk/show', compact('transaksi_produk'),['detail_transaksi_produk' => $detail_transaksi_produk]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiProduk $transaksi_produk)
    {
        $customer = Customer::all();
        return view('transaksi_produk.edit',compact('transaksi_produk'),['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,TransaksiProduk $transaksi_produk)
    {
        // $request->validate([
        //     'tanggal_transaksi_produk' => 'required'
        // ]);
        TransaksiProduk::where('id_transaksi_produk', $transaksi_produk->id_transaksi_produk)
                ->update([
                    'id_customer' => $request->id_customer,
                    'tanggal_transaksi_produk' => now(),
                    // 'status_transaksi_produk' => $request->status_transaksi_produk,
                    'user_transaksi_edit' => Session::get('nama_pegawai'),
                ]);

        return redirect('/transaksi_produk')->with('status', 'Data Transaksi Produk berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiProduk $transaksi_produk)
    {
        TransaksiProduk::where('id_transaksi_produk', $transaksi_produk->id_transaksi_produk)
                ->update([
                    'user_transaksi_delete' => Session::get('nama_pegawai'),
                ]);
        TransaksiProduk:: destroy($transaksi_produk->id_transaksi_produk);
        return redirect('/transaksi_produk')->with('status', 'Data transaksi produk berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $transaksi_produk = DB::table('transaksi_produk')
                    ->join('customer','transaksi_produk.id_customer','=','customer.id_customer')
                    ->whereNull('tanggal_hapus_transaksi_log')
                    ->where('nama_customer','like','%'.$search.'%')
                    ->orwhere('kode_transaksi_produk','like','%'.$search.'%')->paginate(10);
        return view('/transaksi_produk/index',['transaksi_produk'=> $transaksi_produk]);
    }

    public function createProduk(TransaksiProduk $transaksi_produk)
    {
        $produk = Produk::all();
        $data = array(
            'produk' => $produk
        );
        return view('detail_transaksi_produk.create',compact('transaksi_produk'),$data);
    }

    public function storeProduk(Request $request, TransaksiProduk $transaksi_produk)
    {
        $request->validate([
            'jumlah_detail_produk' => 'required'
        ]);
        
        
        $detail_transaksi_produk = new DetailTransaksiProduk;
        $detail_transaksi_produk->jumlah_detail_produk = $request->jumlah_detail_produk;
        $detail_transaksi_produk->id_produk = $request->id_produk;
        $detail_transaksi_produk->id_transaksi_produk = $transaksi_produk->id_transaksi_produk;
        $detail_transaksi_produk->subtotal_detail_produk = $request->jumlah_detail_produk * Produk::where('id_produk', $request->id_produk)->first()->harga_produk;
        $detail_transaksi_produk->save();
        
        $subtotal_produk = $request->jumlah_detail_produk * Produk::where('id_produk', $request->id_produk)->first()->harga_produk;
        $transaksi_produk->total_transaksi_produk = $transaksi_produk->total_transaksi_produk + $subtotal_produk;
        $transaksi_produk->save();


        // $produk = DB::table('produk')
        // ->where([
        //     ['id_produk', $request->id_produk],
        // ])->first();

        // $stok_produk_update = $produk->stok_produk - $request->jumlah_detail_produk;

        // Produk::where('id_produk', $request->id_produk)
        //         ->update
        //         ([
        //             'stok_produk' => $stok_produk_update,
        //         ]);
    

        TransaksiProduk::where('id_transaksi_produk', $transaksi_produk->id_transaksi_produk)
                ->update([
                    'user_transaksi_edit' => Session::get('nama_pegawai'),
                ]);

        return redirect()->route('ShowDetailTransaksiProduk',compact('transaksi_produk'))->with('status', 'Data produk berhasil ditambah');
    }

    public function editProduk(TransaksiProduk $transaksi_produk, DetailTransaksiProduk $detail_transaksi_produk)
    {
        $produk = Produk::all();
        
        return view('detail_transaksi_produk.edit',compact('transaksi_produk','detail_transaksi_produk'),['produk'=>$produk]);
    }

    public function updateProduk(Request $request, TransaksiProduk $transaksi_produk, DetailTransaksiProduk $detail_transaksi_produk)
    {
        $request->validate([
            'jumlah_detail_produk' => 'required',
        ]);
        DetailTransaksiProduk::where('id_detail_produk', $detail_transaksi_produk->id_detail_produk)
                ->update([
                    'id_produk' => $request->id_produk,
                    'jumlah_detail_produk' => $request->jumlah_detail_produk,
                    'subtotal_detail_produk' => $request->jumlah_detail_produk * Produk::where('id_produk', $request->id_produk)->first()->harga_produk,
                ]);

        // $produk = DB::table('produk')
        // ->where([
        //     ['id_produk', $request->id_produk],
        // ])->first();

        // $stok_produk_update = ($produk->stok_produk + $detail_transaksi_produk->jumlah_detail_produk) - $request->jumlah_detail_produk;

        // Produk::where('id_produk', $request->id_produk)
        //         ->update
        //         ([
        //             'stok_produk' => $stok_produk_update,
        //         ]);
        
        TransaksiProduk::where('id_transaksi_produk', $transaksi_produk->id_transaksi_produk)
        ->update([
            'user_transaksi_edit' => Session::get('nama_pegawai'),
        ]);

        $subtotal_produk = $request->jumlah_detail_produk * Produk::where('id_produk', $request->id_produk)->first()->harga_produk;
        $transaksi_produk->total_transaksi_produk = ($transaksi_produk->total_transaksi_produk - $detail_transaksi_produk->subtotal_detail_produk) + $subtotal_produk;
        $transaksi_produk->save();

        return redirect()->route('ShowDetailTransaksiProduk',compact('transaksi_produk'))->with('status', 'Data produk berhasil diubah');
    }

    public function destroyProduk(TransaksiProduk $transaksi_produk, DetailTransaksiProduk $detail_transaksi_produk)
    {
        $transaksi_produk->total_transaksi_produk = $transaksi_produk->total_transaksi_produk - $detail_transaksi_produk->subtotal_detail_produk;
        $transaksi_produk->save();

        // $produk = DB::table('produk')
        // ->where([
        //     ['id_produk', $detail_transaksi_produk->id_produk],
        // ])->first();

        // $stok_produk_update = $produk->stok_produk + $detail_transaksi_produk->jumlah_detail_produk;

        // Produk::where('id_produk', $detail_transaksi_produk->id_produk)
        //         ->update
        //         ([
        //             'stok_produk' => $stok_produk_update,
        //         ]);

        TransaksiProduk::where('id_transaksi_produk', $transaksi_produk->id_transaksi_produk)
        ->update([
            'user_transaksi_edit' => Session::get('nama_pegawai'),
        ]);
        DetailTransaksiProduk::destroy($detail_transaksi_produk->id_detail_produk);

        return redirect()->route('ShowDetailTransaksiProduk',compact('transaksi_produk'))->with('status', 'Data produk berhasil dihapus');
    }

    public function pembayaran(Request $request,TransaksiProduk $transaksi_produk)
    {
        // dump($request);
        if($transaksi_produk->total_transaksi_produk > $request->uang_customer)
        {
            return redirect()->route('ShowDetailTransaksiProduk',compact('transaksi_produk'))->with('gagal', 'Maaf uang yang diterima kurang');
        }
        else
        {
            $detail_transaksi_produk = DB::table('detail_transaksi_produk')
            ->join('transaksi_produk','transaksi_produk.id_transaksi_produk', '=', 'detail_transaksi_produk.id_transaksi_produk')
            ->where('detail_transaksi_produk.id_transaksi_produk','=', $transaksi_produk->id_transaksi_produk)
            ->get();

            $produk = DB::table('produk')
            ->get();

            foreach($detail_transaksi_produk as $dp){
                foreach($produk as $p)
                {
                    if($dp->id_produk == $p->id_produk)
                    {
                        Produk::where('id_produk', $dp->id_produk)
                        ->update
                        ([
                            'stok_produk' => $p->stok_produk - $dp->jumlah_detail_produk,
                        ]);
                    }
                }
            }

            $kembalian = $request->uang_customer - ($transaksi_produk->total_transaksi_produk - $request->diskon);

            // $data = array(
            //     'uang_customer' => $request->uang_customer,
            //     'diskon_produk' => $request->diskon_produk,
            //     'kembalian' => $kembalian
            // );

            $transaksi_produk->status_transaksi_produk = 'Lunas';
            $transaksi_produk->diskon = $request->diskon;
            $transaksi_produk->save();

            TransaksiProduk::where('id_transaksi_produk', $transaksi_produk->id_transaksi_produk)
                ->update([
                    'user_transaksi_edit' => Session::get('nama_pegawai'),
                ]);

            return redirect()->route('ShowDetailTransaksiProduk',compact('transaksi_produk'))->with('status', 'Transaksi Pembayaran Sukses')
            ->with('uang_customer', $request->uang_customer)
            ->with('diskon', $request->diskon)
            ->with('kembalian', $kembalian);
           
        }
    }

    public function cetakStruk(TransaksiProduk $transaksi_produk)
    {
        $detail_transaksi_produk = DB::table('detail_transaksi_produk')
                    ->join('transaksi_produk','transaksi_produk.id_transaksi_produk','=','detail_transaksi_produk.id_transaksi_produk')
                    ->join('produk','produk.id_produk','=','detail_transaksi_produk.id_produk')
                    ->get();
                  
        $produk = Produk::all();
        $customer = Customer::all();
        $hewan = Hewan::all();

        $totalnya = $transaksi_produk->total_transaksi_produk - $transaksi_produk->diskon;

        $data = array(
            'transaksi_produk' => $transaksi_produk,
            'detail_transaksi_produk' => $detail_transaksi_produk,
            'produk' => $produk,
            'customer' => $customer,
            'hewan' => $hewan,
            'totalnya'=> $totalnya
        );
    
        $pdf = PDF::loadview('transaksi_produk.cetakStruk', $data);
        return $pdf->stream();
        // return view('transaksi_produk.cetakStruk', $data);
        //return $pdf->download('laporan-review-pdf.pdf');
    
    }
}
