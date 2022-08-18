<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Commodity;
use App\Models\Comm_change;
use Illuminate\Support\Facades\Storage;

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
    
    public function indexUsers()//回傳所有使用者
    {
        $users = User::get();
        return response(['users' => $users], 200);
    }

    public function showUser(User $user)//回傳特定使用者
    {
        return response($user, 200);
    }

    public function storeComm(Request $request)//新增商品
    {
        $commodity = Commodity::create($request->all());
        return response($commodity, 201);
    }

    public function destroyComm(Commodity $commodity)//刪除商品
    {
        $commodity->delete();
        return response("",204);
    }

    public function updateComm(Request $request, Commodity $commodity)//更新商品
    {
        $commodity->update($request->all());
        return response($commodity,201);
    }
    
    public function indexCommChanges()//回傳所有商品異動資料
    {
        $Commchanges = Comm_change::get();
        return response(['Commchanges' => $Commchanges], 200);
    }

    public function showCommChanges(Commodity $commodity)//回傳特定使用者
    {
        $id = $commodity->id;
        $commodity = Commodity::find($id);
        $storeCommChanges = $commodity->comm_changes;
        return response($storeCommChanges, 200);
    }

    public function storeCommStock(Request $request)//新增商品
    {
        $commodityId = $request->commodity_id;
        $count = $request->count;
        $commChange = Comm_change::create(['commodity_id'=>$commodityId,'count'=>$count]);
        return response($commChange, 201);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $path = $request->file('file')->storeAs('photo', $filename);
        Storage::disk('s3')->put($path, file_get_contents($file));
        if (Storage::disk('s3')->exists('photo/'.$filename)) {
            $url = Storage::disk('s3')->url('photo/'.$filename);
            return $url;
        }else{
            return 'unfound';
        }
    }
    public function geturl(Request $request)
    {
        $filename = $request->filename;
        if (Storage::disk('s3')->exists('photo/'.$filename)) {
            $url = Storage::disk('s3')->url('photo/'.$filename);
            return $url;
        }else{
            return 'unfound';
        }
    }
}
