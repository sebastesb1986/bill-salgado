<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";
    protected $fillable = ['name', 'lastname', 'document', 'phone', 'email', 'address',

                           'city', 'store', 'article', 'quantity', 'price', 'tax', 'total'];

}
