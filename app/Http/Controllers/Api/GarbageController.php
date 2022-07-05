<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Garbages;
use Illuminate\Http\Request;

class GarbageController extends Controller
{
    //
    function index(){
        $garb = Garbages::get();
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
            'user_id' => 'required',
            'no_sacks' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'type' => 'required',
            'mrf_id' => 'required',
        ]);

        $garb = new Garbages();
        $garb->user_id = $request->user_id;
        $garb->no_sacks = $request->no_sacks;
        $garb->latitude = $request->latitude;
        $garb->longitude = $request->longitude;
        $garb->type = $request->type;
        $garb->mrf_id = $request->mrf_id;
        $garb->save();

        return response()->json([
            "status" => 1,
            "message" => "Data Saved",
            "data" => $garb
        ], 200);
    }

    function update(Request $request){

    }

    function delete($id){

    }
}
