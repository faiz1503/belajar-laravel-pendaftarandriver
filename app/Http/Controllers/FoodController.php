<?php

namespace App\Http\Controllers;

use App\ModelFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('daftar_food');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function login() {
        return view('login_food');
    }

    public function loginPost(Request $request) {
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|min:6'
        ];

        $message = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Format Email Salah',
            'password.required'     => 'Password wajib diisi',
            'password.min'          => 'Password minimal 6 Digit',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('index_food');

        } else { // false

            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect('login_food')->with(['alert' => 'Email atau Password anda salah!']);
        }
    }

    public function logout_food() {
        Session::flush();
        return redirect('login_food')->with('alert', 'Anda telah Log Out');
    }

    public function register() {
        return view('daftar_food');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_bisnis'   => 'required|min:4|alpha',
            'tipe_bisnis'   => 'required|alpha',
            'alamat'        => 'required',
            'kota'          => 'required|alpha',
            'nama_depan'    => 'required|min:4|alpha',
            'nama_belakang' => 'required|min:4|alpha',
            'no_hp'         => 'required|numeric|min:10',
            'email'         => 'required|email|unique:merchants_food',
            'password'      => 'required|min:6',
        ];

        $message = [
            'nama_bisnis.required'       => 'Nama Bisnis wajib diisi',
            'nama_bisnis.min'            => 'Nama Bisnis Minimal 4 Digit',
            'nama_bisnis.alpha'          => 'Nama Bisnis Harus Berupa huruf',
            'tipe_bisnis.required'       => 'Tipe Bisnis wajib diisi',
            'tipe_bisnis.alpha'          => 'Tipe Bisnis Harus Berupa huruf',
            'alamat.required'            => 'Alamat wajib diisi',
            'kota.required'              => 'Kota wajib diisi',
            'kota.alpha'                 => 'Kota Harus Berupa huruf',
            'nama_depan.required'        => 'Nama depan wajib diisi',
            'nama_depan.min'             => 'Nama depan Minimal 4 Digit',
            'nama_depan.alpha'           => 'Nama depan Harus Berupa huruf',
            'nama_belakang.required'     => 'Nama belakang wajib diisi',
            'nama_belakang.min'          => 'Nama belakang Minimal 4 Digit',
            'nama_belakang.alpha'        => 'Nama belakang Harus Berupa huruf',
            'no_hp.required'             => 'Nomor HP wajib diisi',
            'no_hp.min'                  => 'Nomor HP Minimal 10 Digit',
            'no_hp.alpha'                => 'Nomor HP Harus Berupa Angka',
            'password.required'          => 'Password wajib diisi',
            'password.min'               => 'Password minimal 6 Digit',
            'email.required'             => 'Email wajib diisi',
            'email.email'                => 'Format Email yang digunakan salah',
            'email.unique'               => 'Email Sudah Digunakan',
            'password.required'          => 'Password wajib diisi',
            'passwrod.min'               => 'Password Minimal 6 karakter',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data =  new ModelFood();
        $data->nama_bisnis      = $request->nama_bisnis;
        $data->tipe_bisnis      = $request->tipe_bisnis;
        $data->alamat           = $request->alamat;
        $data->kota             = $request->kota;
        $data->nama_depan       = $request->nama_depan;
        $data->nama_belakang    = $request->nama_belakang;
        $data->no_hp            = $request->no_hp;
        $data->email            = $request->email;
        $data->password         = bcrypt($request->password);
        $data->save();
        return redirect('login_food')->with('alert-success','Anda berhasil daftar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('index_food');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editsuratperusahaan($id)
    {
        $food = \App\ModelFood::findOrFail($id);
        return view('editsuratperusahaan',compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatesuratperusahaan(Request $request)
    {
        $data = \App\ModelFood::findOrFail($request->id);

        $this->validate($request, [
            'suratperusahaan' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->suratperusahaan != ''){
            $path = base_path().'/public/data_file/food_merchant/';

            //code for remove old file
            if($data->suratperusahaan != ''  && $data->suratperusahaan != null){
                 $file_old = $path.$data->suratperusahaan;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('suratperusahaan');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['suratperusahaan' => $filename]);
       }

        return redirect()->route('index_food')->with('alert-success','Data berhasil diubah!');
    }

    public function editsuratdirektur($id)
    {
        $food = \App\ModelFood::findOrFail($id);
        return view('editsuratdirektur',compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatesuratdirektur(Request $request)
    {
        $data = \App\ModelFood::findOrFail($request->id);

        $this->validate($request, [
            'suratdirektur' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->suratdirektur != ''){
            $path = base_path().'/public/data_file/food_merchant/';

            //code for remove old file
            if($data->suratdirektur != ''  && $data->suratdirektur != null){
                 $file_old = $path.$data->suratdirektur;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('suratdirektur');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['suratdirektur' => $filename]);
       }

        return redirect()->route('index_food')->with('alert-success','Data berhasil diubah!');
    }

    public function editsuratpenanggungjawab($id)
    {
        $food = \App\ModelFood::findOrFail($id);
        return view('editsuratpenanggungjawab',compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatesuratpenanggungjawab(Request $request)
    {
        $data = \App\ModelFood::findOrFail($request->id);

        $this->validate($request, [
            'suratpenanggungjawab' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->suratpenanggungjawab != ''){
            $path = base_path().'/public/data_file/food_merchant/';

            //code for remove old file
            if($data->suratpenanggungjawab != ''  && $data->suratpenanggungjawab != null){
                 $file_old = $path.$data->suratpenanggungjawab;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('suratpenanggungjawab');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['suratpenanggungjawab' => $filename]);
       }

        return redirect()->route('index_food')->with('alert-success','Data berhasil diubah!');
    }

    public function editsuratpembayaran($id)
    {
        $food = \App\ModelFood::findOrFail($id);
        return view('editsuratpembayaran',compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatesuratpembayaran(Request $request)
    {
        $data = \App\ModelFood::findOrFail($request->id);

        $this->validate($request, [
            'suratpembayaran' => 'required|file|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if($request->suratpembayaran != ''){
            $path = base_path().'/public/data_file/food_merchant/';

            //code for remove old file
            if($data->suratpembayaran != ''  && $data->suratpembayaran != null){
                 $file_old = $path.$data->suratpembayaran;
                 unlink($file_old);
            }

            //upload new file
            $file = $request->file('suratpembayaran');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);

            //for update in table
            $data->update(['suratpembayaran' => $filename]);
       }

        return redirect()->route('index_food')->with('alert-success','Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
