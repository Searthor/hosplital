<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory;
    use HasApiTokens, Notifiable;
    protected $guard = "customer";
    protected $fillable = [
        'date',
        'service_units_id',
        'village_id',
        'district_id',
        'province_id',
        'hus_wife_names_id',
        'level_study_id',
        'name',
        'lastname',
        'address',
        'phone',
        'tel',
        'email',
        'gender',
        'birthday',
        'jobs_id',
        'position',
        'date_start_job',
        'address_job',
        'address_job_tel',
        'education_address',
        'status',
        'nationality',
        'number_house',
        'unit_house',
        'doc_person',
        'number_doc_person',
        'doc_person_name',
        'doc_person_date',
        'doc_person_expira_date',
        'issuecd_by',
        'facebook',
        'file_image',
        'file_doc',
        'dated',
        'del',
    ];
    protected $hidden = [
        'password',
    ];
    public function service_unit()
    {
        return $this->belongsTo('App\Models\ServiceUnit', 'service_units_id', 'id');
    }
    public function get_village()
    {
        return $this->belongsTo('App\Models\Village', 'vill_id', 'id');
    }
    public function get_district()
    {
        return $this->belongsTo('App\Models\District', 'dis_id', 'id');
    }
    public function get_province()
    {
        return $this->belongsTo('App\Models\Province', 'pro_id', 'id');
    }

}
