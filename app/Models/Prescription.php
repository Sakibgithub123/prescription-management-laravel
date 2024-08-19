<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'dr_id',
        'patient_name',
        'patient_gender',
        'patient_age',
        'visit_fee',
        'reg_no',
        'date',
        'complaints',
        'tests',
        'investigations',
        'diagnoses',
        'medicine',
        'howmanytimes',
        'afterbefore',
        'nextdate',
    ];
}
