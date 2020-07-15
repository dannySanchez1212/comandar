<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productsStates extends Model
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


   protected $table = 'product_states';

    protected $guarded = [];

    public $timestamps = false;
}
