<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
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

    public function getProduct(Request $req, $product_id) {
      // SELECT h.house_name, p.product_id, p.product_name, pi.image_url FROM product_image pi 
      
      $res = DB::select('
      SELECT h.house_id, h.house_name, h.house_province, p.product_id, p.product_name, p.product_detail, p.product_color, ti.image_url, t.tag_id, t.tag_name, t.tag_icon, t.tag_color FROM
      (SELECT t1.product_id, t1.tag_id, t2.image_url FROM product_tag t1
      LEFT JOIN product_image t2 ON t1.product_id = t2.product_id
      UNION
      SELECT t1.product_id, t1.tag_id, t2.image_url FROM product_tag t1
      RIGHT JOIN product_image t2 ON t1.product_id = t2.product_id) ti
      RIGHT JOIN product p ON p.product_id = ti.product_id
      JOIN house h ON h.house_id = p.house_id
      LEFT JOIN tag t ON t.tag_id = ti.tag_id
      WHERE p.product_id = :product_id
      ',['product_id' => $product_id]);
      
      $res = json_decode(json_encode($res), true);
      $newRes = [];
      foreach($res as $r) {
        $tag = [
          'tag_name'=>$r['tag_name'],
          'tag_icon'=>$r['tag_icon'],
          'tag_color'=>$r['tag_color']
        ];
        if(isset($newRes['image_url'])){
          array_push($newRes['image_url'], url('/').$r['image_url']);
          $newRes['tag_name'][$r['tag_id']] = $tag;
          $newRes['tag_name'][$r['tag_id']]['tag_icon'] = url('/').$newRes['tag_name'][$r['tag_id']]['tag_icon'];
          $newRes['image_url'] = array_unique($newRes['image_url']);
        }
        else{
          $newRes= $r;
          $newRes['image_url'] = [url('/').$r['image_url']];
          $newRes['tag_name'] = [$r['tag_id'] => $tag];
          $newRes['tag_name'][$r['tag_id']]['tag_icon'] = url('/').$newRes['tag_name'][$r['tag_id']]['tag_icon'];
          unset($newRes['tag_id']);
          unset($newRes['tag_color']);
          unset($newRes['tag_icon']);
        }
      }
      return response()->json([
        'status' => 'SUCCESS',
        'type' => 'PRODUCT',
        'message' => 'Product ' . $product_id . ' got!',
        'data' => $newRes
      ]);
     
    }

    public function getProducts(Request $req, $type) {
      $type = $type === 'cotton' ? "'COTTON'" : "'SILK'";
      $res = DB::select('
      SELECT h.house_id, h.house_name, h.house_province, p.product_id, p.product_name, p.product_limited, ti.image_url FROM
      product_image ti
      RIGHT JOIN product p ON p.product_id = ti.product_id
      JOIN house h ON h.house_id = p.house_id WHERE p.product_type = ' . $type);
    
      $res = json_decode(json_encode($res), true);
      $newRes = [];
      foreach($res as $r) {
        if(isset($newRes[$r['house_id']][$r['product_id']])){
          array_push($newRes[$r['house_id']][$r['product_id']]['image_url'], url('/').$r['image_url']);
          $newRes[$r['house_id']][$r['product_id']]['image_url'] = array_unique($newRes[$r['house_id']][$r['product_id']]['image_url']);
        }
        else{
          $newRes[$r['house_id']][$r['product_id']] = $r;
          $newRes[$r['house_id']][$r['product_id']]['image_url'] = [url('/').$r['image_url']];
        }
      }
      return response()->json([
        'status' => 'SUCCESS',
        'type' => 'PRODUCTS',
        'message' => 'Products got!',
        'data' => $newRes
      ]);
    }

    public function getHouse(Request $req, $house_id) {
      $res = DB::select('
      SELECT h.*, p.product_id, p.product_name, p.product_limited, ti.image_url FROM
      product_image ti
      RIGHT JOIN product p ON p.product_id = ti.product_id
      JOIN house h ON h.house_id = p.house_id
      WHERE h.house_id = :house_id
      ',['house_id' => $house_id]);
    
      $res = json_decode(json_encode($res), true);
      $newRes = $res[0];
      unset($newRes['product_id']);
      unset($newRes['product_name']);
      unset($newRes['product_limited']);
      unset($newRes['image_url']);
      foreach($res as $r) {
        if(isset($newRes['products'][$r['product_id']])){
          array_push($newRes['products'][$r['product_id']]['image_url'], url('/').$r['image_url']);
          // $newRes['products']['house_image'] = url('/').$r['house_image'];
          $newRes['products'][$r['product_id']]['image_url'] = array_unique($newRes['products'][$r['product_id']]['image_url']);
        }
        else{
          $newRes['products'][$r['product_id']] = $r;
          $newRes['products'][$r['product_id']]['image_url'] = [url('/').$r['image_url']];
          // $newRes['products']['house_image'] = url('/').$r['house_image'];
          unset($newRes['products'][$r['product_id']]['house_address_url']);
          unset($newRes['products'][$r['product_id']]['house_id']);
          unset($newRes['products'][$r['product_id']]['house_detail']);
          unset($newRes['products'][$r['product_id']]['house_province']);
          unset($newRes['products'][$r['product_id']]['house_image']);
          unset($newRes['products'][$r['product_id']]['house_name']);
          unset($newRes['products'][$r['product_id']]['house_phone']);
          unset($newRes['products'][$r['product_id']]['house_phone_home']);
        }
      }
      return response()->json([
        'status' => 'SUCCESS',
        'type' => 'HOUSE',
        'message' => 'House '. $house_id .' got!',
        'data' => $newRes
      ]);
    }

    public function getAllHouse(Request $req) {
      $res = DB::select('
      SELECT * FROM house
      ');
    
      return response()->json([
        'status' => 'SUCCESS',
        'type' => 'HOUSE',
        'message' => 'Houses got!',
        'data' => $res
      ]);
    }

    //

    
}
