<?php

namespace App\Http\Controllers\API\Backend\Auth;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        
        // return $request->all();
        $user = $request->validate([
            'email'             => 'required|email',
            'password'          => 'required'
        ]);


         $credential = Auth::attempt($request->only('email', 'password'));

       if($credential){

        $user = Auth::user();
        $token = $user->createToken('vehicle-inventory')->plainTextToken;

        $response = [
            'user'              => $user,
            'token'             => $token,
            'status'            => true,
            'message'           => 'Sign In successful!'
        ];

        // User::find(Auth::user()->id)->update(['is_online' => 1]);

        return response($response, 201);

       } else {

            // if (! $user || ! Hash::check($request->password, $user->password)) {

            //     // throw ValidationException::withMessages([
            //     //     'email' => ['The provided credentials are incorrect.'],
            //     // ]);

            //     return response([
            //         'message' => ['These credentials do not match our records.']
            //     ], 404);

            // }

            return response()->json([
                [
                    'message' => 'These credentials do not match our records.',
                    'status'  => false
                ], 404
            ]);

       }
    
        
    } 

    public function signOut()
    {
        // User::find(Auth::user()->id)->update(['is_online' => 0]);
        Auth::logout();
        return response()->json([
            'status' => 200,
            'message' => 'Sign Out Successfully!'
        ]);
    }

    


}
