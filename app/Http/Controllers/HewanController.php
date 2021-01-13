<?php

namespace App\Http\Controllers;

use App\Hewan;
use App\Jenis;
use App\Ukuran;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hewan = DB::table('hewan')
                ->join('customer','customer.id_customer','=','hewan.id_customer')
                ->join('jenis','jenis.id_jenis','=','hewan.id_jenis')
                ->join('ukuran','ukuran.id_ukuran','=','hewan.id_ukuran')
                // ->select('hewan.*','customer.nama_customer','jenis.nama_jenis','ukuran.nama_ukuran')
                ->whereNull('tanggal_hapus_hewan_log')
                ->get();
        return view('hewan/index',['hewan' => $hewan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = Jenis::all();
        $ukuran = Ukuran::all();
        $customer = Customer::all();
        $data = array(
            'jenis' => $jenis,
            'ukuran' => $ukuran,
            'customer' => $customer
        );
        return view('hewan.create',$data);
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
            'nama_hewan' => 'required',
            'tanggal_lahir_hewan' => 'required'
        ]);
        
        $hewan= new hewan;
        $hewan->nama_hewan = $request->nama_hewan;
        $hewan->tanggal_lahir_hewan = $request->tanggal_lahir_hewan;
        $hewan->id_jenis = $request->id_jenis;
        $hewan->id_ukuran = $request->id_ukuran;
        $hewan->id_customer = $request->id_customer;
        $hewan->user_hewan_log = Session::get('nama_pegawai');

        $hewan->save();
        // Hewan::create($request->all());
        return redirect('/hewan')->with('status', 'Data Hewan Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Hewan $hewan)
    {
        return view('hewan.show', compact('hewan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hewan $hewan)
    {
        $jenis = Jenis::all();
        $ukuran = Ukuran::all();
        $customer = Customer::all();
        $data = array(
            'jenis' => $jenis,
            'ukuran' => $ukuran,
            'customer' => $customer
        );
        return view('hewan/edit', compact('hewan'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hewan $hewan)
    {
        $request->validate([
            'nama_hewan' => 'required',
            'tanggal_lahir_hewan' => 'required'
        ]);

        Hewan::where('id_hewan', $hewan->id_hewan)
            ->update([
                'nama_hewan' => $request->nama_hewan,
                'tanggal_lahir_hewan' => $request->tanggal_lahir_hewan,
                'id_jenis' => $request->id_jenis,
                'id_ukuran' => $request->id_ukuran,
                'id_customer' => $request->id_customer,
                'user_hewan_log' => Session::get('nama_pegawai'),
            ]);
            return redirect('/hewan')->with('status', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hewan $hewan)
    {
        Hewan::destroy($hewan->id_hewan);
        return redirect('/hewan')->with('status', 'Data berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $hewan = DB::table('hewan')
        ->join('customer','customer.id_customer','=','hewan.id_customer')
        ->join('jenis','jenis.id_jenis','=','hewan.id_jenis')
        ->join('ukuran','ukuran.id_ukuran','=','hewan.id_ukuran')
        ->select('hewan.*','customer.nama_customer','jenis.nama_jenis','ukuran.nama_ukuran')
        ->whereNull('tanggal_hapus_hewan_log')
        ->where('nama_hewan','like','%'.$search.'%')->paginate(10);
        return view('/hewan/index',['hewan'=> $hewan]);
    }
}
