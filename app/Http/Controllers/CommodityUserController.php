<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

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
}
