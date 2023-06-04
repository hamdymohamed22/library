<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    // register =================
    public function register(Request $request)
    {
        // validation 
        $validation =  Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email|string|max:255",
            "password" => "required|confirmed|min:6|string",
        ]);
        // check if any fails or errors 
        if ($validation->fails()) {
            return response()->json([
                "msg" => $validation->errors()
            ], 301);
        }

        // hashing password 
        $password = bcrypt($request->password);
        // create 
        $access_token = Str::random(64);
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password,
            "access_token" => $access_token,
        ]);

        // return response

        return response()->json([
            "msg" => "category created successfuly"
        ], 201);
    }

    // login =====================
    public function login(Request $request)
    {
        // validation 
        $validation =  Validator::make($request->all(), [
            "email" => "required|email|unique:users,email|string|max:255",
            "password" => "required|min:6|string",
        ]);
        // check if any fails or errors 
        if ($validation->fails()) {
            return response()->json([
                "msg" => $validation->errors()
            ], 301);
        }

        // chek on user email 

        $user = User::where("email", "=", "$request->email")->first();


        if ($user) {
            # password
            $check_pass = Hash::check($request->password, $user->password);
            if ($check_pass) {
                // update access_token 
                $access_token = Str::random(64);
                $user->update([
                    "access_token" => $access_token,
                ]);
                // return response and access token
                return response()->json([
                    "msg" => "login successfuly",
                    "access_token"=>"$access_token"
                ], 200);



            } else {
                return response()->json([
                    "msg" => "whoops!,credential not match"
                ], 301);
            }
        } else {
            return response()->json([
                "msg" => "whoops!,credential not match"
            ], 301);
        }
    }
    // logout 

    public function logout(Request $request){
        $access_token = $request->header('access_token');
        if ($access_token != null) {
            $user = User::where("access_token","=",$access_token)->first();
            if ($user) {
                // update it to null 
                $user->update([
                    "access_token" => null
                ]);
                // return responce loged out 
                return response()->json([
                    "msg" => "you loged out successfuly"
                ], 200);
            }else{
                return response()->json([
                    "msg" => "user not exist"
                ], 404);
            }

        }else {
            return response()->json([
                "msg" => "not valid access_token"
            ], 404);
        }
    }

}
