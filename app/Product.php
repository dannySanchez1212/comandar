<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'id',
        'name',
        'description',
    ];


   protected $table = 'products';

    protected $guarded = [];

    public $timestamps = false;


    /**
     * Vacia la tabla perteneciente a la entidad
     */
    static function vaciarTabla()
    {
        static::query()->delete();
    }

}
