<?php

namespace App\Http\Controllers\Voyager\http\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use App\Pedido;
use Arrilot\Widgets\AbstractWidget;
use TCG\Voyager\Widgets\BaseDimmer;

class Pedidos extends BaseDimmer
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
        $countNew = Pedido::count(); 

     

        $string = trans_choice('Pedidos',$countNew);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-basket',
            'title'  => "{$countNew} {$string}",
            'text'   => __('Todos los Pedidos agregardos', ['count' => $countNew, 'string' => Str::lower($string)]),
            'button' => [
                'text' => 'Ver Pedidos',
                'link' => route('voyager.pedidos.index'),
            ],
            'image' =>  asset('images/Supermercado/wigets6.png'),
        ]));
    }

    public function shouldBeDisplayed()
    {
        //return Auth::user()->can('browse', app(Product::class));
      //  return Auth::user()->hasRole('admin');
     // return Auth::user();

      return Auth::user()->hasRole('admin');
    }

}