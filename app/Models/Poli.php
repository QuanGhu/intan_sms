<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = 'poli';
    protected $fillable = [
        'poli_code', 'name', 'doctor_name'
    ];

    public function patient()
    {
        return $this->hasMany('App\Models\Patient','poli_id');
    }
}
