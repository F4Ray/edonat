<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Donatur;
use App\Models\Pengajuan;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return User::create([
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'id_role' => 2,
        //     'id_profile' => 3
        // ]);
        if ($data['daftar_sebagai'] == "3") {
            $penerima = new Pengajuan;
            $penerima->nama_siswa = $data['name'];
            $penerima->status = 0;
        } else {
            $donatur = new Donatur;
            $donatur->nama = $data['name'];
        }

        $user = new User;
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->id_role = $data['daftar_sebagai'];


        if ($data['daftar_sebagai'] == "3") {
            $user->id_profile = 9999;
            $penerima->save();
            $penerima->user()->save($user);
        } else {
        $user->id_pengajuan = 9999;
            $donatur->save();
            $donatur->user()->save($user);
        }

        return $user;
    }
}