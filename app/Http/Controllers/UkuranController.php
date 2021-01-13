<?php

namespace App\Http\Controllers;

use App\Ukuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UkuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ukuran = DB::table('ukuran')
        ->whereNull('tanggal_hapus_ukuran_log')
        ->get();
       return view('ukuran.index',['ukuran' => $ukuran]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ukuran.create');
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
            'nama_ukuran' => 'required'
        ]);

        $ukuran= new ukuran;
        $ukuran->nama_ukuran = $request->nama_ukuran;
        $ukuran->user_ukuran_log = Session::get('nama_pegawai');
        $ukuran->save();
        // Ukuran::create($request->all());
        return redirect('/ukuran')->with('status', 'Data ukuran Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ukuran $ukuran)
    {
        return view('ukuran.show', compact('ukuran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ukuran $ukuran)
    {
        return view('ukuran.edit',compact('ukuran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ukuran $ukuran)
    {
        $request->validate([
            'nama_ukuran' => 'required'
        ]);
        Ukuran::where('id_ukuran', $ukuran->id_ukuran)
                ->update([
                    'nama_ukuran' => $request->nama_ukuran,
                    'user_ukuran_log' => Session::get('nama_pegawai'),
                ]);
                return redirect('/ukuran')->with('status', 'Data ukuran berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukuran $ukuran)
    {
        Ukuran:: destroy($ukuran->id_ukuran);
        return redirect('/ukuran')->with('status', 'Data ukuran berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $ukuran = DB::table('ukuran')
        ->whereNull('tanggal_hapus_ukuran_log')
        ->where('nama_ukuran','like','%'.$search.'%')->paginate(10);
        return view('/ukuran/index',['ukuran'=> $ukuran]);
    }
}
