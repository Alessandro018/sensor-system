<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicao extends Model
{
    protected $table = "medicao";

    protected $fillable = [
        'sensor_id',
        'valor',
        'data_horario'
    ];

    public function sensor()
    {
        return $this->hasOne('App\Sensor', 'id', 'sensor_id');
    }
}
