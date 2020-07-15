<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Melihovv\ShoppingCart\Facades\ShoppingCart as Cart;
use DB;


class CarritoController extends Controller
{
    public function index(){
        dd(Cart::content());
    }
    public function agregar(Request $request){   
      
      return  Cart::add($request->get('c_codigo'),$request->get('c_descri'),0,$request->get('cantidad'),['peso' => $request->get('peso')]);
    }

    public function agregar2(Request $request){   
      
       Cart::instance('compras')->add(5,'platano',0,2,['peso' => '500gr']);
        dd(Cart::instance('compras')->content());
      
    }
} 
