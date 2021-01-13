<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pegawai = DB::table('pegawai')
                    ->whereNull('tanggal_hapus_pegawai_log')
                            ->join('role','pegawai.id_role','=','role.id_role')
                            // ->select('pegawai.*','role.nama_role')
                            ->get();
        /* dump($pegawai);*/
        return view('pegawai/index',['pegawai' => $pegawai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();

        return view('pegawai.create',['role'=> $role]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $pegawai= new pegawai;
        // $pegawai->nama_pegawai = $request->nama_pegawai;
        // $pegawai->alamat_pegawai = $request->alamat_pegawai;
        // $pegawai->tanggal_lahir_pegawai = $request->tanggal_lahir;
        // $pegawai->nomor_telepon_pegawai = $request->nomor_telepon;

        // $pegawai->save();
        
        $request->validate([
            'nama_pegawai' => 'required|unique:pegawai,nama_pegawai',
            'alamat_pegawai' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
            'tanggal_lahir_pegawai' => 'required',
            'nomor_telepon_pegawai' => 'required|numeric'
        ]);
        
        $pegawai= new pegawai;
        $pegawai->nama_pegawai = $request->nama_pegawai;
        $pegawai->password = bcrypt($request->password);
        $pegawai->alamat_pegawai = $request->alamat_pegawai;
        $pegawai->nomor_telepon_pegawai = $request->nomor_telepon_pegawai;
        $pegawai->tanggal_lahir_pegawai = $request->tanggal_lahir_pegawai;
        $pegawai->id_role = $request->id_role;
        $pegawai->user_pegawai_log = Session::get('nama_pegawai');

        $pegawai->save();
        // Pegawai::create($request->all());
        return redirect('/pegawai')->with('status', 'Data Pegawai Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return view('pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        $role = Role::all();

        return view('pegawai.edit',compact('pegawai'),['role'=> $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'alamat_pegawai' => 'required',
            'tanggal_lahir_pegawai' => 'required',
            'nomor_telepon_pegawai' => 'required|numeric'
        ]);

        Pegawai::where('id_pegawai', $pegawai->id_pegawai)
                ->update([
                    'nama_pegawai' => $request->nama_pegawai,
                    'alamat_pegawai' => $request->alamat_pegawai,
                    'id_role' => $request->id_role,
                    'tanggal_lahir_pegawai' => $request->tanggal_lahir_pegawai,
                    'nomor_telepon_pegawai' => $request->nomor_telepon_pegawai,
                    'user_pegawai_log' => Session::get('nama_pegawai'),
                ]);

        $data = Pegawai::where('id_pegawai', $pegawai->id_pegawai)->first();
        $pass_lama = $request->pass_lama;
        $pass_baru = $request->pass_baru;
        // return [$request,$data];
        if(Hash::check($pass_lama,$data->password))
        {
            $data->password = bcrypt($pass_baru);
            $data->update();
            return redirect('/pegawai')->with('status', 'Data pegawai dan password berhasil diubah!');
        }
        else
        {
            return redirect('/pegawai')->with('status', 'Data pegawai berhasil diubah!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        Pegawai:: destroy($pegawai->id_pegawai);
        return redirect('/pegawai')->with('status', 'Data pegawai berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $pegawai = DB::table('pegawai')
                    ->join('role','pegawai.id_role','=','role.id_role')
                    ->select('pegawai.*','role.nama_role')
                    ->whereNull('tanggal_hapus_pegawai_log')
                    ->where('nama_pegawai','like','%'.$search.'%')->paginate(10);
        return view('/pegawai/index',['pegawai'=> $pegawai]);
    }
}