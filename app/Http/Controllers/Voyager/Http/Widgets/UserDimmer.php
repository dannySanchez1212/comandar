<?php

namespace App\Http\Controllers\Voyager\http\Widgets;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

use TCG\Voyager\Widgets\BaseDimmer;
use Arrilot\Widgets\AbstractWidget;

class UserDimmer extends BaseDimmer
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
        $count = Voyager::model('User')->count();
        $string = trans_choice('Usuarios', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-group',
            'title'  => "{$count} {$string}",
            'text'   => __('Todos los Clientes del Sistema', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('Ver Clientes'),
                'link' => route('voyager.users.index'),
            ],
            'image' => asset('images/Supermercado/wigets5.jpg'),
        ]));
    }

    /**
     * 'https://picsum.photos/1920/1080?random',
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
       // return Auth::user()->can('browse', Voyager::model('User'));
       return Auth::user()->hasRole('admin');
    }
}
