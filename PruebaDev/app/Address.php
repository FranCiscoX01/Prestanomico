<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address_data';
    protected $fillable = [
        'customer_id', 'calle', 'no_exterior', 'no_interior', 'colonia', 'municipio', 'estado', 'cp', 'status_id'
    ];
}
