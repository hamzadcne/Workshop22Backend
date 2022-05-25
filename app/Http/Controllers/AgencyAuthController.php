<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AgencyAuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if user already exists
        $user = Agency::where('email', $request->email)->first();
        if ($user) {
            return response('The provided email already exists.', 403);
            // throw ValidationException::withMessages([
            //     'email' => ['The provided email already exists.'],
            // ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = Agency::create($input);
        
        $response['token'] =  $user->createToken($request->email)->plainTextToken;
        $response['user'] = $user;
        return response(json_encode($response), 201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
            
        $user = Agency::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response('The provided credentials are incorrect.', 403);
            // throw ValidationException::withMessages([
            //     'email' => ['The provided credentials are incorrect.'],
            // ]);
        }
    
        $response['token'] =  $user->createToken($request->email)->plainTextToken;
        $response['user'] = $user;
        return response(json_encode($response));
    }
}
