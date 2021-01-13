<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis = DB::table('jenis')
                ->whereNull('tanggal_hapus_jenis_log')
                ->get();
       return view('jenis.index',['jenis' => $jenis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jenis.create');
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
            'nama_jenis' => 'required'
        ]);

        $jenis = new jenis;
        $jenis->nama_jenis = $request->nama_jenis;
        $jenis->user_jenis_log = Session::get('nama_pegawai');
        $jenis->save();
        // Jenis::create($request->all());
        return redirect('/jenis')->with('status', 'Data jenis Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jenis $jenis)
    {
        return view('jenis.show', compact('jenis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jenis $jenis)
    {
        return view('jenis.edit',compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jenis $jenis)
    {
        $request->validate([
            'nama_jenis' => 'required'
        ]);
        Jenis::where('id_jenis', $jenis->id_jenis)
                ->update([
                    'nama_jenis' => $request->nama_jenis,
                    'user_jenis_log' => Session::get('nama_pegawai'),
                ]);
                return redirect('/jenis')->with('status', 'Data jenis berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jenis $jenis)
    {
        Jenis:: destroy($jenis->id_jenis);
        return redirect('/jenis')->with('status', 'Data jenis berhasil dihapus!');
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $jenis = DB::table('jenis')
                ->whereNull('tanggal_hapus_jenis_log')
                ->where('nama_jenis','like','%'.$search.'%')->paginate(10);
        return view('/jenis/index',['jenis'=> $jenis]);
    }
}
