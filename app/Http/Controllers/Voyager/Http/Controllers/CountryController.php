<?php

namespace App\Http\Controllers\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Country;
use RealRashid\SweetAlert\Facades\Alert;

class CountryController extends Controller
{
   public function index()
    {
        // Check permission
       // $this->authorize('browse', model('Company'));

       $countrys=Country::all();
       //dd($countrys);
        return Voyager::view('country.index', compact('countrys'));
    }

    public function addItem(Request $request) {


        $country=Country::Create([
               'name' => $value['name'],
               'code' => $value['code'],
               'collaboration' => $value['collaboration']
            ]);
        $country->save();


       $countrys=Country::all();
      // dd($countrys);
        return Voyager::view('country.index', compact('countrys'));
    }


     public function addItem2(Request $request) {


    }
     public function update(Request $request)
    {

         $id=$_POST['id'];
         $country_name=$_POST['country_name'];
         $country_code=$_POST['code'];
         $country_collaboration=$_POST['collaboration'];


        $country = Country::find($id);
        $country->fill([
            'name'  => $country_name,
            'code'  => $country_code,
            'collaboration'  => $country_collaboration,

        ]);
        $country->save();


       $countrys=Country::all();
      // dd($countrys);
        return Voyager::view('country.index', compact('countrys'));

    }

    public function destroy(Request $request)
    {
        //Alert::warning('Warning', 'destroyyyy')->autoClose(1800);

       $countrys=Country::all();
        if($request->ajax()){
                $id=$request->post('id');
              // $id=$request->get('id');
                      //   Alert::warning('Warning', 'primer   iffffffffffffff')->autoClose(1800);
                       if($id=='null'){
                         return Voyager::view('country.index', compact('countrys'));

                                       }else{

                                           //   Alert::success('Success', 'elseeeeeeeeeeeeeeeeeeee')->autoClose(1800);
                                             $_token=$request->get('_token');
                                              $country=Country::find($id);
                                              if($country != null){
                                              $country->delete();
                                              return Voyager::view('country.index', compact('countrys'));
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

       $countrys=Country::all();
                $id=1;
              // $id=$request->get('id');
                      //   Alert::warning('Warning', 'primer   iffffffffffffff')->autoClose(1800);
                       if($id=='null'){

                                              return Voyager::view('country.index', compact('countrys'));

                                       }else{
                                                $_token=$request->get('_token');
                                              $country=Country::find($id);
                                              if($country != null){
                                              $country->delete();
                                              return Voyager::view('country.index', compact('countrys'));
                                               }else{
                                               // return Alert::success('Success','Error')->autoClose(1800);
                                              return 0;
                                            }

                                       }

    }
}
