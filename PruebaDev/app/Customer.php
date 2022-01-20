<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer_data';
    protected $fillable = [
        'nombre', 'apellido_paterno', 'apellido_materno', 'rfc', 'fecha_nacimiento', 'ingresos', 'egresos', 'no_dependientes', 'estado_civil', 'genero', 'ultimo_grado_estudios', 'status_id'
    ];
}
