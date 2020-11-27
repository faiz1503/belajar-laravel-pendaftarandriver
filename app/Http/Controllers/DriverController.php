<?php

namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Validator;

class DriverController extends Controller
{
    public function index() {
        // if(!Session::get('login')){
        //     return redirect('login')->with('alert','Anda belum login, silahkan login terlebih dahulu');
        // }
        // else{
        //     //returns true or false
        //     //ambil data dari database
        //     // $driver = DB::table('users_driver')->get();
        //     //kirim data ke view home
        // }
        return view('index');
    }

    public function login() {
        return view('login');
    }

    public function loginPost(Request $request) {
        $rules = [
            'no_hp'                 => 'required|min:10|numeric',
            'password'              => 'required|min:6'
        ];

        $message = [
            'no_hp.required'        => 'No HP wajib diisi',
            'no_hp.min'             => 'Nomor Hp Minimal 10 Digit',
            'no_hp.numeric'         => 'Nomor Hp Harus Berupa Angka',
            'password.required'     => 'Password wajib diisi',
            'password.min'          => 'Password minimal 6 Digit',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'no_hp'     => $request->input('no_hp'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('index');

        } else { // false

            //Login Fail
            Session::flash('error', 'No HP atau password salah');
            return redirect('login')->with(['alert' => 'No HP atau Password anda salah!']);
        }
        // $no_hp = $request->no_hp;
        // $password = $request->password;

        // $data = ModelUser::where('no_hp',$no_hp)->first();
        // if($data){ //apakah no_hp tersebut ada atau tidak
        //     if(Hash::check($password,$data->password)){
        //         Session::put('id',$data->id);
        //         Session::put('nama_depan',$data->nama_depan);
        //         Session::put('nama_belakang',$data->nama_belakang);
        //         Session::put('no_hp',$data->no_hp);
        //         Session::put('tipe_driver',$data->tipe_driver);
        //         Session::put('login',TRUE);
        //         return redirect('/index');
        //     }
        //     else{
        //         return redirect('login')->with('alert','No HP atau Password anda salah!');
        //     }
        // }
        // else{
        //     return redirect('login')->with('alert','No HP atau Password anda salah!');
        // }
    }

    public function logout() {
        Session::flush();
        return redirect('login')->with('alert', 'Anda telah Log Out');
    }

    public function register() {
        return view('register');
    }

    public function registerPost(Request $request) {
        $rules = [
            'nama_depan' => 'required|min:4|alpha',
            'nama_belakang' => 'required|min:4|alpha',
            'no_hp' => 'required|numeric|min:10|unique:users_driver',
            'password' => 'required|min:6',
            'tipe_driver' => 'required|alpha',
        ];

        $message = [
            'nama_depan.required'       => 'Nama depan wajib diisi',
            'nama_depan.min'            => 'Nama depan Minimal 4 Digit',
            'nama_depan.alpha'          => 'Nama depan Harus Berupa huruf',
            'nama_belakang.required'    => 'Nama belakang wajib diisi',
            'nama_belakang.min'         => 'Nama belakang Minimal 4 Digit',
            'nama_belakang.alpha'       => 'Nama belakang Harus Berupa huruf',
            'no_hp.required'            => 'Nomor HP wajib diisi',
            'no_hp.min'                 => 'Nomor HP Minimal 10 Digit',
            'no_hp.alpha'               => 'Nomor HP Harus Berupa Angka',
            'no_hp.unique'              => 'Nomor HP Sudah Digunakan',
            'password.required'         => 'Password wajib diisi',
            'password.min'              => 'Password minimal 6 Digit',
            'tipe_driver.required'      => 'Tipe Driver wajib diisi',
            'tipe_driver.min'           => 'Tipe Driver harus huruf',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data =  new ModelUser();
        $data->nama_depan = $request->nama_depan;
        $data->nama_belakang = $request->nama_belakang;
        $data->no_hp = $request->no_hp;
        $data->password = bcrypt($request->password);
        $data->tipe_driver = $request->tipe_driver;
        $data->save();
        return redirect('login')->with('alert-success','Anda berhasil register');
    }

    public function editktp($id) {
        $driver = \App\ModelUser::findOrFail($id);
        return view('editktp',compact('driver'));
    }

    public function updatektp(Request $request) {

        $data = \App\ModelUser::findOrFail($request->id);

        $this->validate($request, [
            'ktp' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->ktp != ''){
            $path = base_path().'/public/data_file/';

            //code for remove old file
            if($data->ktp != ''  && $data->ktp != null){
                 $file_old = $path.$data->ktp;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('ktp');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['ktp' => $filename]);
       }

        return redirect()->route('index')->with('alert-success','Data berhasil diubah!');
    }

    public function editsim($id) {
        $driver = \App\ModelUser::findOrFail($id);
        return view('editsim',compact('driver'));
    }

    public function updatesim(Request $request) {

        $data = \App\ModelUser::findOrFail($request->id);

        $this->validate($request, [
            'sim' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->sim != ''){
            $path = base_path().'/public/data_file/';

            //code for remove old file
            if($data->sim != ''  && $data->sim != null){
                 $file_old = $path.$data->sim;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('sim');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['sim' => $filename]);
       }

        return redirect()->route('index')->with('alert-success','Data berhasil diubah!');
    }

    public function editstnk($id) {
        $driver = \App\ModelUser::findOrFail($id);
        return view('editstnk',compact('driver'));
    }

    public function updatestnk(Request $request) {

        $data = \App\ModelUser::findOrFail($request->id);

        $this->validate($request, [
            'stnk' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->stnk != ''){
            $path = base_path().'/public/data_file/';

            //code for remove old file
            if($data->stnk != ''  && $data->stnk != null){
                 $file_old = $path.$data->stnk;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('stnk');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['stnk' => $filename]);
       }

        return redirect()->route('index')->with('alert-success','Data berhasil diubah!');
    }

    public function editskck($id) {
        $driver = \App\ModelUser::findOrFail($id);
        return view('editskck',compact('driver'));
    }

    public function updateskck(Request $request) {

        $data = \App\ModelUser::findOrFail($request->id);

        $this->validate($request, [
            'skck' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->skck != ''){
            $path = base_path().'/public/data_file/';

            //code for remove old file
            if($data->skck != ''  && $data->skck != null){
                 $file_old = $path.$data->skck;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('skck');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['skck' => $filename]);
       }

        return redirect()->route('index')->with('alert-success','Data berhasil diubah!');
    }

    public function editsuratkesehatan($id) {
        $driver = \App\ModelUser::findOrFail($id);
        return view('editsuratkesehatan',compact('driver'));
    }

    public function updatesuratkesehatan(Request $request) {

        $data = \App\ModelUser::findOrFail($request->id);

        $this->validate($request, [
            'suratkesehatan' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->suratkesehatan != ''){
            $path = base_path().'/public/data_file/';

            //code for remove old file
            if($data->suratkesehatan != ''  && $data->suratkesehatan != null){
                 $file_old = $path.$data->suratkesehatan;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('suratkesehatan');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['suratkesehatan' => $filename]);
       }

        return redirect()->route('index')->with('alert-success','Data berhasil diubah!');
    }
}
