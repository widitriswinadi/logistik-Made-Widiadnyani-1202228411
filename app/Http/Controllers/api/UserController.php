<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;  //memanggil librarry validator
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;
use Carbon\Carbon; //memanggil library carbon fungsi datetime iat line 34


class UserController extends Controller
{
    public function login(Request $request){
        //melakukan validasi
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //kondisi ketika inputan salah
        if($validator->fails()){
            return response()->json($validator->messages(),422);
        }

        //kondisi inputan ada di tabel user
        if(Auth::attempt($validator->validated())){
            //isian dari token
            $payload = [
                'iss' => 'https://logistik.com',
                'name' => Auth::user()->name,
                'role' => Auth::user()->role,
                'iat' => Carbon::now()->timestamp,  //waktu ketika token di generate
                'exp' => Carbon::now()->timestamp + 60*60*2 //waktu ketika token sudah expired
            ];
            //generate token
            $jwt = JWT::encode($payload, env('JWT_SECRET_KEY'), 'HS256');

            //kirim token keuser
            return response()->json([
                'messages' => 'Token berhasl di generate',
                'name' => Auth::user()->name,
                'token' => 'Bearer '.$jwt
            ],200);
        }
        //kondisi ketika user yg diinputkan tdk ada ditabel user
        return response()->json([
            'message'=>'Pengguna Tidak ditemukan'
        ],422);

    }
}
