<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Garbages;
use App\Models\Mrf;
use Illuminate\Http\Request;

class GarbageController extends Controller
{
    //
    function index(){
        $garb = Garbages::join('users', 'users.id', 'garbages.user_id')
        ->join('mrf', 'mrf.id', 'garbages.mrf_id')
        ->get();

        return response()->json([
            "status" => 1,
            "message" => "Fetched Data",
            "data" => $garb
        ], 200);
    }

    function getGarbageTotalType($type){
        $garb = Garbages::where('type', $type)->count();
        return response()->json([
            "status" => 1,
            "message" => "Fetched Data",
            "data" => $garb
        ], 200);
    }

    function getGarbageType($type){
        $garb = Garbages::where('type', $type)->get();
        return response()->json([
            "status" => 1,
            "message" => "Fetched Data",
            "data" => $garb
        ], 200);
    }

    function getGarbage($id){
        $garb = Garbages::find($id);
        return response()->json([
            "status" => 1,
            "message" => "Fetched Data",
            "data" => $garb
        ], 200);
    }

    function create(Request $request){
        $request->validate([
            'no_sacks' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'type' => 'required',
            'mrf_id' => 'required',
        ]);

        $mrf = Mrf::where('code', $request->mrf_id)->first();

        if($mrf){
            $garb = new Garbages();
            $garb->user_id = auth()->user()->id;
            $garb->no_sacks = $request->no_sacks;
            $garb->latitude = $request->latitude;
            $garb->longitude = $request->longitude;
            $garb->type = $request->type;
            $garb->mrf_id = $mrf->mrf_id;
            $garb->save();
    
            return response()->json([
                "status" => 1,
                "message" => "Data Saved",
                "data" => $garb
            ], 200);
        }else{
            return response()->json([
                "status" => 0,
                "message" => "MRF ID Not Found",
            ], 400);
        }
        
    }

    function update(Request $request){

    }

    function delete($id){

    }
}
