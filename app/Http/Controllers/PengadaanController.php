<?php

namespace App\Http\Controllers;

use App\Pengadaan;
use App\Supplier;
use App\DetailPengadaan;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;

class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengadaan = DB::table('pengadaan')
                    ->join('supplier','supplier.id_supplier','=','pengadaan.id_supplier')
                    ->whereNull('tanggal_hapus_pengadaan_log')
                    ->orderBy('id_pengadaan')
                    ->get();
       return view('pengadaan.index',['pengadaan' => $pengadaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $data = array(
            'supplier' => $supplier
        );
        return view('pengadaan.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pengadaan' => 'required'
        ]);
        
        $pengadaan = new pengadaan;
        // $pengadaan->status_pengadaan = $request->status_pengadaan;
        $pengadaan->tanggal_pengadaan = $request->tanggal_pengadaan;
        //$pengadaan->tanggal_pengadaan = now()->timestamp;
        $pengadaan->id_supplier = $request->id_supplier;
        $pengadaan->user_pengadaan_log = Session::get('nama_pegawai');
        $pengadaan->status_pengadaan = 'Belum Selesai';

        $last_id = Pengadaan::latest()->first()->id_pengadaan;
        $temp_id = $last_id+1;
       
        //$tanggal 	= date("Y-m-d");

        if($temp_id < 10)
        {
            $pengadaan->kode_pengadaan = 'PO'.'-'.($request->tanggal_pengadaan).'-'.'0'.($temp_id);
        }
        else 
        {
            $pengadaan->kode_pengadaan = 'PO'.'-'.($request->tanggal_pengadaan).'-'.($temp_id);
        }
            //$pengadaan->kode_pengadaan = concat('PO-',toString($request->tanggal_pengadaan),'-',$request->id_supplier);
            $pengadaan->save();

            return redirect('/pengadaan')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pengadaan $pengadaan)
    {
        $detail_pengadaan = DB::table('detail_pengadaan')
                    ->join('pengadaan','pengadaan.id_pengadaan','=','detail_pengadaan.id_pengadaan')
                    ->join('produk','produk.id_produk','=','detail_pengadaan.id_produk')
                    ->get();

        return view('pengadaan/show', compact('pengadaan'), ['detail_pengadaan' => $detail_pengadaan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengadaan $pengadaan)
    {
        $supplier = Supplier::all();
        return view('pengadaan.edit',compact('pengadaan'),['supplier'=>$supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Pengadaan $pengadaan)
    {
        $request->validate([
            'tanggal_pengadaan' => 'required'
        ]);
        Pengadaan::where('id_pengadaan', $pengadaan->id_pengadaan)
                ->update([
                    'id_supplier' => $request->id_supplier,
                    'tanggal_pengadaan' => $request->tanggal_pengadaan,
                    // 'status_pengadaan' => $request->status_pengadaan,
                    'user_pengadaan_log' => Session::get('nama_pegawai'),
                ]);

        return redirect('/pengadaan')->with('status', 'Data pengadaan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengadaan $pengadaan)
    {
        Pengadaan:: destroy($pengadaan->id_pengadaan);
        return redirect('/pengadaan')->with('status', 'Data pengadaan berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $pengadaan = DB::table('pengadaan')
                    ->join('supplier','pengadaan.id_supplier','=','supplier.id_supplier')
                    ->whereNull('tanggal_hapus_pengadaan_log')
                    ->where('nama_supplier','like','%'.$search.'%')->paginate(10);
        return view('//pengadaan/index',['pengadaan'=> $pengadaan]);
    }

    public function createProduk(Pengadaan $pengadaan)
    {
        $produk = Produk::all();
        $data = array(
            'produk' => $produk
        );
        return view('detail_pengadaan.create',compact('pengadaan'),$data);
    }

    public function storeProduk(Request $request, Pengadaan $pengadaan)
    {
        $request->validate([
            'jumlah_detail_pengadaan' => 'required',
            'subtotal_detail_pengadaan' => 'required'
        ]);
        
        $detail_pengadaan = new DetailPengadaan;
        $detail_pengadaan->jumlah_detail_pengadaan = $request->jumlah_detail_pengadaan;
        $detail_pengadaan->id_produk = $request->id_produk;
        $detail_pengadaan->id_pengadaan = $pengadaan->id_pengadaan;
        $detail_pengadaan->subtotal_detail_pengadaan = $request->subtotal_detail_pengadaan;
        $detail_pengadaan->save();

        $pengadaan->total_pengadaan = $pengadaan->total_pengadaan + $request->subtotal_detail_pengadaan;
        $pengadaan->save();
        
        return redirect()->route('ShowDetailPengadaaan',compact('pengadaan'))->with('status', 'Data produk berhasil ditambah');
    }

    public function editProduk(Pengadaan $pengadaan, DetailPengadaan $detail_pengadaan)
    {
        $produk = Produk::all();
        
        return view('detail_pengadaan.edit',compact('pengadaan','detail_pengadaan'),['produk'=>$produk]);
    }

    public function updateProduk(Request $request, Pengadaan $pengadaan, DetailPengadaan $detail_pengadaan)
    {
        $request->validate([
            'jumlah_detail_pengadaan' => 'required',
            'subtotal_detail_pengadaan' => 'required'
        ]);
        DetailPengadaan::where('id_detail_pengadaan', $detail_pengadaan->id_detail_pengadaan)
                ->update([
                    'id_produk' => $request->id_produk,
                    'jumlah_detail_pengadaan' => $request->jumlah_detail_pengadaan,
                    'subtotal_detail_pengadaan' => $request->subtotal_detail_pengadaan,
                ]);

        $pengadaan->total_pengadaan = ($pengadaan->total_pengadaan - $detail_pengadaan->subtotal_detail_pengadaan) + $request->subtotal_detail_pengadaan;
        $pengadaan->save();

        return redirect()->route('ShowDetailPengadaaan',compact('pengadaan'))->with('status', 'Data produk berhasil diubah');
    }

    public function destroyProduk(Pengadaan $pengadaan, DetailPengadaan $detail_pengadaan)
    {
        $pengadaan->total_pengadaan = $pengadaan->total_pengadaan - $detail_pengadaan->subtotal_detail_pengadaan;
        $pengadaan->save();
        
        DetailPengadaan::destroy($detail_pengadaan->id_detail_pengadaan);

        return redirect()->route('ShowDetailPengadaaan',compact('pengadaan'))->with('status', 'Data produk berhasil dihapus');
    }

    public function verifikasi(Pengadaan $pengadaan)
    {
        
        $detail_pengadaan = DB::table('detail_pengadaan')
        ->join('pengadaan','pengadaan.id_pengadaan', '=', 'detail_pengadaan.id_pengadaan')
        ->where('detail_pengadaan.id_pengadaan','=', $pengadaan->id_pengadaan)
        ->get();

        // $detail_pengadaan = DB::table('detail_pengadaan')
        // // ->join('pengadaan','detail_pengadaan.id_pengadaan','=','pengadaan.id_pengadaan')
        //  ->where(
        //     'id_pengadaan', '=', $pengadaan->id_pengadaaan
        //  )
        // ->get();
        
        // $detail_pengadaan = Detail_Pengadaan::all()->where;

        // $produk = DB::table('produk')
        // ->join('detail_pengadaan','detail_pengadaan.id_produk','=','detail_pengadaan.id_produk')
        // ->where('produk.id_produk','=', $detail_pengadaan->id_produk)
        // ->get();

        $produk = DB::table('produk')
        ->join('detail_pengadaan','produk.id_produk', '=', 'detail_pengadaan.id_produk')
        ->join('pengadaan','detail_pengadaan.id_pengadaan', '=', 'pengadaan.id_pengadaan')
        ->where('detail_pengadaan.id_pengadaan','=', $pengadaan->id_pengadaan)
        ->get();

        foreach($detail_pengadaan as $dp){
            // echo $dp->id_detail_pengadaan;
            foreach($produk as $p)
            if($p->id_produk == $dp->id_produk)
            {
                Produk::where('id_produk', $p->id_produk)
                ->update
                ([
                    'stok_produk' => $p->stok_produk + $dp->jumlah_detail_pengadaan,
                ]);
            }
        }
        
        $pengadaan->status_pengadaan = 'Selesai';
        $pengadaan->save();

        // $last_id = Detail_Pengadaan::latest()->first()->id_detail_pengadaan;
        
        // $last_id2 = Produk::latest()->first()->id_produk;

         //$detailIDproduk = $detail_pengadaan->id_produk;
        // $produkID = $produk->id_produk;
        // for ($detail_pengadaan->id_detail_pengadaan  = 0; $detail_pengadaan->id_detail_pengadaan  < $last_id; $detail_pengadaan->id_detail_pengadaan++)
        // {
        //     if($detail_pengadaan->id_pengadaan == $pengadaan->id_pengadaan)
        //     {
        //         // for ($produk->id_produk  = 1; $produk->id_produk  < $last_id2; $produk->id_produk ++)
        //         // {
        //             // if($produk->id_produk == $detail_pengadaan->id_produk)
        //             // {
        //                 //$stok_update = $produk->stok_produk + $detail_pengadaan->jumlah_detail_pengadaan;

        //                 // Produk::where('id_produk', $produk->id_produk)
        //                 // ->update
        //                 // ([
        //                 //     'stok_produk' => $stok_update,
        //                 // ]);
        //                     // $produk->save();
        //                  dump($detail_pengadaan);
        //             // }
        //         // }
        //     }
        // }

        // echo $pengadaan->id_pengadaan;
        // dump($produk);
        // dump($detail_pengadaan);

        return redirect()->route('ShowDetailPengadaaan',compact('pengadaan'))->with('status', 'Data pengadaan berhasil diverifikasi dan produk otomatis ditambahkan');
    }

    public function pesan(Pengadaan $pengadaan)
    {
        $pengadaan->status_pengadaan = 'Pemesanan Sedang Diproses';
        $pengadaan->save();
        return redirect('/pengadaan')->with('status', 'Berhasil Melakukan Pengadaan Produk');
    }

    public function cetakStruk(Pengadaan $pengadaan)
    {
        $detail_pengadaan = DB::table('detail_pengadaan')
                    ->join('pengadaan','pengadaan.id_pengadaan','=','detail_pengadaan.id_pengadaan')
                    ->join('produk','produk.id_produk','=','detail_pengadaan.id_produk')
                    ->get();
                  
        $supplier = Supplier::all();

        $waktuNyetak = now();

        $data = array(
            'pengadaan' => $pengadaan,
            'detail_pengadaan' => $detail_pengadaan,
            'supplier' => $supplier,
            'waktuNyetak' => $waktuNyetak
        );
    
        $pdf = PDF::loadview('pengadaan.cetakStruk', $data);
        return $pdf->stream();

        // return view('pengadaan.cetakStruk', $data);

        //return $pdf->download('laporan-review-pdf.pdf');
    
    }
}
