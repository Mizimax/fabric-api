<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

   public function getImageHome() {
    $res = DB::table('images')->select('name','data','page')->where('page', 'HOME')->get();
    foreach($res as $key => $r){
      if (strpos($r->name, 'IMAGE') !== false) {
        $res[$key]->data = url('/').$r->data;
      }
    }
    return response()->json([
      'status' => 'SUCCESS',
      'type' => 'HOME_IMAGE',
      'message' => 'Home images got!',
      'data' => $res
    ]);
   }

   public function getType() {
    $res = DB::table('images')->select('name','data','page')->where('page', 'TYPE')->get();
    foreach($res as $key => $r){
      if (strpos($r->name, 'IMAGE') !== false) {
        $res[$key]->data = url('/').$r->data;
      }
    }
    return response()->json([
      'status' => 'SUCCESS',
      'type' => 'TYPE_IMAGE',
      'message' => 'Type images got!',
      'data' => $res
    ]);
   }

    //

    
}
