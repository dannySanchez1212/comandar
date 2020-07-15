<?php

namespace App\Http\Controllers\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\productsStates;
use RealRashid\SweetAlert\Facades\Alert;

class productsStatesController extends Controller
{
   public function index()
    {
        // Check permission
       // $this->authorize('browse', model('Company'));

       $productsStates=productsStates::all();
       //dd($productsStates);
        return Voyager::view('productsStates.index', compact('productsStates'));
    }

    public function addItem(Request $request) {


        $produc=productsStates::Create([
               'name' => $value['name'],
               'description' => $value['description']
            ]);
        $produc->save();


       $productsStates=productsStates::all();
      // dd($productsStates);
        return Voyager::view('productsStates.index', compact('productsStates'));
    }


     public function addItem2(Request $request) {


    }
     public function update(Request $request)
    {

         $id=$_POST['id'];
         $produc_name=$_POST[' name'];
         $produc_description=$_POST['description'];


        $produc = productsStates::find($id);
        $produc->fill([
            'name'  => $produc_name,
            'description'  => $produc_description

        ]);
        $produc->save();


       $productsStates=productsStates::all();
      // dd($countrys);
        return Voyager::view('productsStates.index', compact('productsStates'));

    }

    public function destroy(Request $request)
    {
        //Alert::warning('Warning', 'destroyyyy')->autoClose(1800);

       $productsStates=productsStates::all();
        if($request->ajax()){
                $id=$request->post('id');
              // $id=$request->get('id');
                      //   Alert::warning('Warning', 'primer   iffffffffffffff')->autoClose(1800);
                       if($id=='null'){
                         return  view('productsStates.index', compact('productsStates'));

                                       }else{

                                           //   Alert::success('Success', 'elseeeeeeeeeeeeeeeeeeee')->autoClose(1800);
                                             $_token=$request->get('_token');
                                              $productsState=productsStates::find($id);
                                              if($productsState != null){
                                              $productsState->delete();
                                              return  view('productsStates.index', compact('productsStates'));
                                               }else{
                                                //return Alert::success('Success','Error')->autoClose(1800);
                                               return 0;
                                            }

                                       }
                            }
    }

      public function destroy2(Request $request)
    {
       // Alert::warning('Warning', 'destroyyyy')->autoClose(1800);

       $productsStates=productsStates::all();
                $id=1;
              // $id=$request->get('id');
                      //   Alert::warning('Warning', 'primer   iffffffffffffff')->autoClose(1800);
                       if($id=='null'){

                                              return view('productsStates.index', compact('productsStates'));

                                       }else{
                                                $_token=$request->get('_token');
                                              $productsState=productsStates::find($id);
                                              if($productsState != null){
                                              $productsState->delete();
                                              return view('productsStates.index', compact('productsStates'));
                                               }else{
                                               // return Alert::success('Success','Error')->autoClose(1800);
                                              return 0;
                                            }

                                       }

    }
}
