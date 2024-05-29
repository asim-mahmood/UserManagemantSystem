<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = "employees";

    protected $fillable = [
        'id', 'name', 'father_name', 'cnic', 'email', 'mobile_number',  'mobile_number2', 'address', 'reference', 'post',  'salary', 'joining_date', 'status', 'is_active'
    ];

    protected $hidden = [
        'password',
        'readable_password'
    ];
}
