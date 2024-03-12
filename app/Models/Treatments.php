<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatments extends Model
{
    use HasFactory;
    protected $table = 'treatments';
    protected $fillable = [
        'id',
        'code',
        'd_id',
        'patient_id',
        'symptom',
        'heartbeat',
        'pressure',
        'temperature',
        'breast',
        'weight',
        'height',
        'vak­_saeng',
        'bongmati',
        'treatment',
        'next_forward',
        'date',
    ];
    public function get_patient()
    {
        return $this->belongsTo('App\Models\Patient','patient_id','id');
    }
    public function get_creator()
    {
        return $this->belongsTo('App\Models\User','d_id','id');
    }


}
