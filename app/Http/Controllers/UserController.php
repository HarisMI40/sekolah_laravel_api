<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        
        return response()->json(["data" => User::all()]);
    }

    public function store(Request $request){
        $user = User::create([
            "name"=> $request->nama,
            "email"=> $request->email,
            "password"=> Hash::make($request->password),
        ]);

        return response()->json(["message" => "Akun User Berhasil Dibuat" , "data" => $user]);
    }


    public function update(Request $request, $id){
        $user = User::find($id);

        $user->update([
            "name" => $request->nama,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);


        return response(["message" => "Data Berhasil di Update", "data" => $user]);
    }


    public function destroy($id){
        $user = User::find($id);

        $user->delete();

        if(!$user){
            return response()->json(["message" => "Data User Gagal Dihapus"]);
        }
        
        return response()->json(["message" => "Data User Berhasil Dihapus"]);
        

    }
}
