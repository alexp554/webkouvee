<?php

namespace App\Http\Controllers;

use App\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = DB::table('layanan')
                    ->whereNull('tanggal_hapus_layanan_log')
                    ->get();
       return view('layanan.index',['layanan' => $layanan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layanan.create');
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
            'nama_layanan' => 'required',
            'harga_layanan' => 'required'
        ]);
        $layanan= new layanan;
        $layanan->nama_layanan = $request->nama_layanan;
        $layanan->harga_layanan = $request->harga_layanan;
        $layanan->user_layanan_log = Session::get('nama_pegawai');
        $layanan->save();
        // Layanan::create($request->all());
        return redirect('/layanan')->with('status', 'Data Layanan Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Layanan $layanan)
    {
        return view('layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Layanan $layanan)
    {
        return view('layanan.edit',compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama_layanan' => 'required',
            'harga_layanan' => 'required'
        ]);
        Layanan::where('id_layanan', $layanan->id_layanan)
                ->update([
                    'nama_layanan' => $request->nama_layanan,
                    'harga_layanan' => $request->harga_layanan,
                    'user_layanan_log' => Session::get('nama_pegawai'),
                ]);
                return redirect('/layanan')->with('status', 'Data layanan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layanan $layanan)
    {
        Layanan:: destroy($layanan->id_layanan);
        return redirect('/layanan')->with('status', 'Data layanan berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $layanan = DB::table('layanan')
        ->whereNull('tanggal_hapus_layanan_log')
        ->where('nama_layanan','like','%'.$search.'%')->paginate(10);
        return view('/layanan/index',['layanan'=> $layanan]);
    }
    
}
