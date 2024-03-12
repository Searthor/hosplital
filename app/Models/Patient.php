<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        'id',
        'code',
        'f_name',
        'l_name',
        'gender',
        'birthday',
        'phone',
        'job',
        'status',
        'nationnality',
        'ethnicity',
        'unit',
        'house_number',
        'village',
        'city',
        'province',
        'created_at',
    ];
}
