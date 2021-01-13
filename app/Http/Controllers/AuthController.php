<?php

namespace App\Http\Controllers;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        if(!Session::get('login'))
        {
            return view('auths.login');
        }
        return redirect('/');
    }

    public function postlogin(Request $request)
    {
        // dd($request->all());
        // $id = $request->get('id_pegawai');
        // $pegawai = DB::table('pegawai');
        // if(Auth::attempt($request->only('nama_pegawai','password_pegawai'))){
        //     return redirect('/');
        // }
        // return redirect('/login');
        $password = $request->password;
        $nama_pegawai = $request->nama_pegawai;
 
         $this->validate($request, [
             'nama_pegawai'=>'required',
             'password'=>'required',
         ]);
         $data = Pegawai::where('nama_pegawai',$nama_pegawai)->first();
    //    return($data);
       if($data)
       {
           if(Hash::check($password,$data->password))
           {
               Session::put('id_pegawai', $data->id_pegawai);
               Session::put('id_role', $data->id_role);
               Session::put('nama_pegawai', $data->nama_pegawai);
               Session::put('login', TRUE);
               if($data->id_role == 1)
               {
                    return redirect('/produk');
               }
               else
               {
                   return redirect('/');
               }
           }
           else{
              return redirect('/login')->withInput($request->only('nama_pegawai'))->with('false-password','Password Salah');
           }
       }
       else{
           return redirect('login')->with('false-nama_pegawai','Nama pegawai tidak terdaftar');
       }
    }

    public function logout()
    {
        //$this->guard()->logout();
        //$request->session()->invalidate();


        Auth::logout();
        Session::flush();
        return redirect('/');
    }
}
