<?php

namespace App\Http\Controllers\Voyager\http\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\Product;
use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Widgets\BaseDimmer;
use Illuminate\Support\Facades\DB;

class Products extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $countNew = DB::connection('sqlPremium')
        ->table('MA_PRODUCTOS')
        ->where('n_activo',1)
        ->where('n_precio1','>',0)
        ->where('c_departamento','cht')
        ->orwhere('c_departamento','CAR')
        ->count(); 

        $string = trans_choice('Productos',$countNew);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-bread',
            'title'  => "{$countNew} {$string}",
            'text'   => __('Todos los productos agregardos', ['count' => $countNew, 'string' => Str::lower($string)]),
            'button' => [
                'text' => 'Ver Productos',
                'link' => route('productsNew.index'),
            ],
            'image' =>  asset('images/Supermercado/wigets2.jpg'),
        ]));
    }

    public function shouldBeDisplayed()
    {
        //return Auth::user()->can('browse', app(Product::class));
        return Auth::user()->hasRole('admin');
      // return Auth::user();
    }

}
