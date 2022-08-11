<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;//處理時間格式的套件
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed',
            'account' => 'required',
            'address' => 'required|string',
            'phone' => 'required|string',
            'tel' => 'string'
        ]);
        
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'account' => $request->account,
            'address' => $request->address,
            'phone' => $request->phone,
            'tel' => $request->tel,
        ]);

        $user->save();

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_token
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            //'remember_token' => 'boolean'
        ]);

        $credentials = $request->only(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
    
        $tokenResult = $user->createToken('Personal Access Token'); //createToken 方法來為給定使用者發放 Token,Token 的名稱作為該方法的第一個參數，並將 scopes 的一組可選陣列作為它的第二個參數
        $token = $tokenResult->accessToken;
        // if ($request->remember_token)
        //     $token->expires_at = Carbon::now()->addWeeks(1);

        //$token->save();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            // 'expires_at' => Carbon::parse(
            //     $token->expires_on
            // )->toDateTimeString() //過期時間
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        //echo $request;
        if(!$request->user()){
            echo "erro";
        }else
        return response()->json($request->user());
    }

    public function updateUser(Request $request, User $user)
    {
        $user = $request->user();
        $user->update($request->all());
        $password = bcrypt($request->password);
        $user->update(['password' => $password]);
        return response($user,201);
    }
}