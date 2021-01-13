<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = DB::table('produk')
                    ->whereNull('tanggal_hapus_produk_log')
                    ->get();
       return view('produk.index',['produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_produk' => 'required',
            'satuan_produk' => 'required',
            'stok_produk' => 'required',
            'stok_min_produk' => 'required',
            'harga_produk' => 'required',
            'image_path' => 'required'
        ]);
        // Produk::create($request->all());
        // if($request->hasFile('image_path')){
        //     $request->file('foto_produk')->move('images/',$request->file('foto_produk')->getClientOriginalName());
        //     $foto_produk = $request->file('foto_produk')->getClientOriginalName();
        //     // $request->save();
        // }
        // return redirect('/produk')->with('status', 'Data Produk Berhasil Ditambah');
        $image_path = $request->image_path;
        $new_foto_produk = time().$image_path->getClientOriginalName();
        $produk = Produk::create([
            'nama_produk' => $request->nama_produk,
            'satuan_produk' => $request->satuan_produk,
            'stok_produk' => $request->stok_produk,
            'stok_min_produk' => $request->stok_min_produk,
            'harga_produk' => $request->harga_produk,
            'image_path' => 'public/images/'.$new_foto_produk,
            'user_produk_log' => Session::get('nama_pegawai')
        ]);
        $image_path->move('public/images/',$new_foto_produk);
        return redirect('/produk')->with('status', 'Data Produk Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('produk.edit',compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required',
            'satuan_produk' => 'required',
            'stok_produk' => 'required',
            'stok_min_produk' => 'required',
            'harga_produk' => 'required'
        ]);
        // $produk = Produk::findorfail($produk->id_produk);
        // if($request->has('foto_produk')){
        //     $foto_produk = $request->foto_produk;
        //     $new_foto_produk = time().$foto_produk->getClientOriginalName();
        //     $foto_produk->move('public/images/',$new_foto_produk);
        // }

        // $produk_data = [
        //     'nama_produk' => $request->nama_produk,
        //     'satuan_produk' => $request->satuan_produk,
        //     'stok_produk' => $request->stok_produk,
        //     'stok_min_produk' => $request->stok_min_produk,
        //     'harga_produk' => $request->harga_produk,
        //     'foto_produk'=> 'public/images/'.$new_foto_produk
        // ];
        // $produk->tags()->sync($request->tags);
        // $produk->update($produk_data);
    // $produk->nama_produk = $request->nama_produk;
    // $produk->satuan_produk = $request->satuan_produk;

    // if($request->has('foto_produk')) {
    //     $foto_produk = $request->file('foto_produk');
    //     $new_foto_produk = $foto_produk->getClientOriginalName();
    //     $foto_produk->move('public/images/',$new_foto_produk);
    //     $produk->foto_produk = $request->file('foto_produk')->getClientOriginalName();
    // }

    // $produk->update();

    if($request->has('image_path')){
        $image_path = $request->image_path;
        $new_foto_produk = time().$image_path->getClientOriginalName();
        $image_path->move('public/images',$new_foto_produk);
        Produk::where('id_produk', $produk->id_produk)
                ->update
                ([
                    'nama_produk' => $request->nama_produk,
                    'satuan_produk' => $request->satuan_produk,
                    'stok_produk' => $request->stok_produk,
                    'stok_min_produk' => $request->stok_min_produk,
                    'harga_produk' => $request->harga_produk,
                    'image_path'=> 'public/images/'.$new_foto_produk,
                    'user_produk_log' => Session::get('nama_pegawai')
                ]);
    }
    else{
        Produk::where('id_produk', $produk->id_produk)
                    ->update
                    ([
                        'nama_produk' => $request->nama_produk,
                        'satuan_produk' => $request->satuan_produk,
                        'stok_produk' => $request->stok_produk,
                        'stok_min_produk' => $request->stok_min_produk,
                        'harga_produk' => $request->harga_produk,
                        'user_produk_log' => Session::get('nama_pegawai')
                    ]);
    }
        return redirect('/produk')->with('status', 'Data Produk berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        Produk:: destroy($produk->id_produk);
        return redirect('/produk')->with('status', 'Data Produk berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $produk = DB::table('produk')
        ->whereNull('tanggal_hapus_produk_log')
        ->where('nama_produk','like','%'.$search.'%')->paginate(10);
        return view('/produk/index',['produk'=> $produk]);
    }

    public function notifikasiProduk()
    {
        $produk = DB::table('produk')
                    ->whereColumn('stok_produk','=','stok_min_produk')
                    ->orWhereColumn('stok_produk','<','stok_min_produk')
                    ->whereNull('tanggal_hapus_produk_log')
                    ->orderBy('id_produk')
                    ->get();

        // echo $produk;
       return view('/produk/index',['produk' => $produk]);
    }
}
