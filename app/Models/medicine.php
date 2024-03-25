<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicine extends Model
{
    use HasFactory;
    protected $table = 'medicines';
    protected $fillable = ['id','med_name','med_type_id','des'];

    public function get_type_name()
    {
        return $this->belongsTo('App\Models\medicine_type', 'med_type_id', 'id');
    }
}
