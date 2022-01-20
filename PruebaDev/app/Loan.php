<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loan_data';
    protected $fillable = [
        'customer_id', 'monto', 'plazo', 'pago_mensual', 'tasa_interes'
    ];
}
