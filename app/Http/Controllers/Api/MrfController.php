<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mrf;
use Illuminate\Http\Request;

class MrfController extends Controller
{
    //
    function index(){
        $mrf = Mrf::get();
        return response()->json([
            "status" => 1,
            "message" => "Fetched Data",
            "data" => $mrf
        ], 200);
    }

    function getMrf($id){
        $mrf = Mrf::find($id);
        return response()->json([
            "status" => 1,
            "message" => "Fetched Data",
            "data" => $mrf
        ], 200);
    }

    function create(Request $request){
        $request->validate([
            'barangay' => 'required',
            'code' => 'required',
        ]);

        $mrf = new Mrf();
        $mrf->barangay = $request->barangay;
        $mrf->code = $request->code;
        $mrf->save();

        return response()->json([
            "status" => 1,
            "message" => "Saved Data",
            "data" => $mrf
        ], 200);
    }

    function update(Request $request){
        $mrf = Mrf::find($request->id);
        $mrf->barangay = !empty($request->barangay) ? $request->barangay : $mrf->barangay;
        $mrf->code = !empty($request->code) ? $request->code : $mrf->code;
        $mrf->save();

        return response()->json([
            "status" => 1,
            "message" => "Saved Data",
            "data" => $mrf
        ], 200);
    }

    function delete($id){
        $mrf = Mrf::find($id);
        $mrf->delete();

        return response()->json([
            "status" => 1,
            "message" => "Deleted Data",
        ], 200);
    }
}
