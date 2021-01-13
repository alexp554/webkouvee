<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = DB::table('supplier')
        ->whereNull('tanggal_hapus_supplier_log')
        ->get();
       return view('supplier.index',['supplier' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplier/create');
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
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'telepon_supplier' => 'required|numeric'
        ]);
        
        $supplier = new supplier;
        $supplier->nama_supplier = $request->nama_supplier;
        $supplier->alamat_supplier = $request->alamat_supplier;
        $supplier->telepon_supplier = $request->telepon_supplier;
        $supplier->user_supplier_log = Session::get('nama_pegawai');
        $supplier->save();
        // Supplier::create($request->all());
        return redirect('/supplier')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('supplier/show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'alamat_supplier' => 'required',
            'telepon_supplier' => 'required|numeric'
        ]);

        Supplier::where('id_supplier', $supplier->id_supplier)
                ->update([
                    'nama_supplier' => $request->nama_supplier,
                    'alamat_supplier' => $request->alamat_supplier,
                    'telepon_supplier' => $request->telepon_supplier,
                    'user_supplier_log' => Session::get('nama_pegawai')
                ]);
                return redirect('/supplier')->with('status', 'Data supplier berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        Supplier:: destroy($supplier->id_supplier);
        return redirect('/supplier')->with('status', 'Data supplier berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $supplier = DB::table('supplier')
        ->whereNull('tanggal_hapus_supplier_log')
        ->where('nama_supplier','like','%'.$search.'%')->paginate(10);
        return view('/supplier/index',['supplier'=> $supplier]);
    }
}
