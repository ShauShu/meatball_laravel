<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Commodity;

class AdminController extends Controller
{
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $email = $request->email;
        $password = $request->password;
        if(!Auth::attempt(['email' => $email, 'password' => $password, 'admin'=> true]))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
    
        $tokenResult = $user->createToken('Admin Access Token'); //createToken 方法來為給定使用者發放 Token,Token 的名稱作為該方法的第一個參數，並將 scopes 的一組可選陣列作為它的第二個參數
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
    
    public function indexUsers()
    {
        $users = User::get();
        return response(['users' => $users], 200);
    }

    public function showUser(User $user)
    {
        return response($user, 200);
    }

    public function storeComm(Request $request)
    {
        $commodity = Commodity::create($request->all());
        return response($commodity, 201);
    }

    public function destroyComm(Commodity $commodity)
    {
        $commodity->delete();
        return response("",204);
    }

    public function updateComm(Request $request, Commodity $commodity)
    {
        $commodity->update($request->all());
        return response($commodity,201);
    }
    
}
