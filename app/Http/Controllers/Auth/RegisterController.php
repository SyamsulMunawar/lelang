<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
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
            'nama'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
            'level'     => ['required'],
            'umur'      =>['required', 'integer'],
            'alamat'    =>['required'],
            'no_hp'     =>['required', 'string', 'max:15'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $id = User::max('id');
        $id_user    = '';

        if($id == null){
            $data['level'] == 'peserta_lelang' ? $id_user == 'PL0001' : $id_user = 'P00001';
        }
        elseif($id !== null)
        {
            $jumlah_karakter_id = strlen($id);
            $data['level'] == 'peserta_lelang' ? $total_karakter = 4 : $total_karakter = 5;

            for($jumlah_karakter_id; $jumlah_karakter_id < $total_karakter; $jumlah_karakter_id++)
            {
                $id_user .= '0';
            }
                $id_user .= $id;
                if($data['level'] == 'peserta_lelang')
                {
                    $id_user = 'PL' . $id_user++;
                }
                elseif($data['level'] == 'pelelang')
                {
                    $id_user = 'P' . $id_user++;
                }
        }
        
        return User::create([
            'id_user'   => $id_user,
            'nama'      => $data['nama'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
            'level'     => $data['level'],
            'umur'      => $data['umur'],
            'alamat'    => $data['alamat'],
            'no_hp'     => $data['no_hp'],
        ]);
    }
}
