<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = DB::table('customer')
                    ->whereNull('tanggal_hapus_customer_log')
                    ->get();
       return view('customer.index',['customer' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer/create');
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
            'nama_customer' => 'required',
            'alamat_customer' => 'required',
            'tgl_lahir_customer' => 'required',
            'telepon_customer' => 'required|numeric'
        ]);
        
        $customer= new customer;
        $customer->nama_customer = $request->nama_customer;
        $customer->alamat_customer = $request->alamat_customer;
        $customer->telepon_customer = $request->telepon_customer;
        $customer->tgl_lahir_customer = $request->tgl_lahir_customer;
        $customer->user_customer_log = Session::get('nama_pegawai');

        $customer->save();
        // Customer::create($request->all());

        return redirect('/customer')->with('status', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer/show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'nama_customer' => 'required',
            'alamat_customer' => 'required',
            'tgl_lahir_customer' => 'required',
            'telepon_customer' => 'required|numeric'
        ]);
        Customer::where('id_customer', $customer->id_customer)
                ->update([
                    'nama_customer' => $request->nama_customer,
                    'alamat_customer' => $request->alamat_customer,
                    'tgl_lahir_customer' => $request->tgl_lahir_customer,
                    'telepon_customer' => $request->telepon_customer,
                    'user_customer_log' => Session::get('nama_pegawai')
                ]);
                return redirect('/customer')->with('status', 'Data customer berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        Customer:: destroy($customer->id_customer);
        return redirect('/customer')->with('status', 'Data customer berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $customer = DB::table('customer')
                    ->whereNull('tanggal_hapus_customer_log')
                    ->where('nama_customer','like','%'.$search.'%')->paginate(10);
        return view('/customer/index',['customer'=> $customer]);
    }
}
