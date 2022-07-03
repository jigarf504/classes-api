<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $fillable = [
        'course_code',
        'name',
        'full_payment',
        'installment_payment',
        'course_template',
        'is_active'
    ];

    public $rules = [
        'name' => 'required|unique:courses|max:125',
        'course_code' => 'required|max:5',
        'full_payment' => 'required|numeric',
        'installment_payment' => 'required|numeric',
        'course_template' => 'required'
    ];
}
