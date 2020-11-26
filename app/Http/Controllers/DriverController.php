<?php

namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DriverController extends Controller
{
    public function index() {
        if(!Session::get('login')){
            return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        }
        else{
            return view('index');
        }
    }

    public function login() {
        return view('login');
    }

    public function loginPost(Request $request) {
        $no_hp = $request->no_hp;
        $password = $request->password;

        $data = ModelUser::where('no_hp',$no_hp)->first();
        if($data){ //apakah no_hp tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                Session::put('nama_depan',$data->nama_depan);
                Session::put('nama_belakang',$data->nama_belakang);
                Session::put('no_hp',$data->no_hp);
                Session::put('tipe_driver',$data->tipe_driver);
                Session::put('login',TRUE);
                return redirect('/');
            }
            else{
                return redirect('login')->with('alert','No HP atau Password anda salah!');
            }
        }
        else{
            return redirect('login')->with('alert','No HP atau Password anda salah!');
        }
    }

    public function logout() {
        Session::flush();
        return redirect('login')->with('alert', 'Anda telah Log Out');
    }

    public function register() {
        return view('register');
    }

    public function registerPost(Request $request) {
        $this->validate($request, [
            'nama_depan' => 'required|min:4|alpha',
            'nama_belakang' => 'required|min:4|alpha',
            'no_hp' => 'required|numeric|min:10',
            'password' => 'required|min:6',
            'tipe_driver' => 'required|alpha',
        ]);

        $data =  new ModelUser();
        $data->nama_depan = $request->nama_depan;
        $data->nama_belakang = $request->nama_belakang;
        $data->no_hp = $request->no_hp;
        $data->password = bcrypt($request->password);
        $data->tipe_driver = $request->tipe_driver;
        $data->save();
        return redirect('login')->with('alert-success','Anda berhasil register');
    }
}
