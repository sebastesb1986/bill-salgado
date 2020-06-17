<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use SoftDeletes;

    protected $table = "bills";
    protected $dates = ['deleted_at'];
    protected $fillable = ['name', 'lastname', 'document', 'phone', 'email', 'address',

                           'city', 'store', 'article', 'quantity', 'price', 'tax', 'total'];

}
