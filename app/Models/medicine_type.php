<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicine_type extends Model
{
    use HasFactory;
    protected $table = 'medicine_types';
    protected $fillable = ['id','type_name','des'];

}
