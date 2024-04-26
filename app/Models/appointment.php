<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'id',
        'treatment_id',
        'd_id',
        'patient_id',
        'date',
        'time',
        'des',
    ];
    public function get_patient()
    {
        return $this->belongsTo('App\Models\Patient','patient_id','id');
    }
    public function get_doctor()
    {
        return $this->belongsTo('App\Models\User','d_id','id');
    }
    public function get_creator()
    {
        return $this->belongsTo('App\Models\User','creator_id','id');
    }
}
