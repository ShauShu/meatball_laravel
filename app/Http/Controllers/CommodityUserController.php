<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\CommodityUser;

class CommodityUserController extends Controller
{
    public function indexComm(Request $request)
    {
        $user = $request->user();
        $id = $user->id;
        $currentUser = User::find($id);
        $commodities = $currentUser->commodities()->orderby('id')->get();
        //$commodities->makeHidden('pivot');
        foreach ($commodities as $commodity){
            
            $count = $commodity->pivot->count;
            $commodity->count=$count;
        }

        return response($commodities, 200);
    }
    public function storeComm(Request $request)
    {
        $userId = $request->user()->id;
        $commodityId = $request->commodityId;
        $count = $request->count;
        $commodity = CommodityUser::create(['user_id'=>$userId,'commodity_id'=>$commodityId,'count'=>$count]);
        return response($commodity, 201);
    }

}
