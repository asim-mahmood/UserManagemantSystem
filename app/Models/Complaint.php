<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'user_id','complaint_by','employee_id','mobile', 'problem', 'date', 'description','is_deleted', 'is_active','feedback'
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
