<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionAvailable extends Model
{
    use HasFactory;
    protected $fillable = [
        'role_id',
        'function_id',
    ];
    public function function()
    {
        return $this->belongsTo('App\Models\FunctionModel', 'function_id', 'id');
    }
}
