<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';
    protected $fillable = [
        'phone_number', 'name','queue_no','queue_code','register_time','poli_id',
        'patient_id','book_date'
    ];

    public function poli()
    {
        return $this->belongsTo('App\Models\Poli','poli_id');
    }
}
