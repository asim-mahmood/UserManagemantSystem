<?php

namespace App\Models;

use App\Models\Package;
use App\Models\CustomersBills;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $table = "customers";

    protected $fillable = [
        'id', 'company_type', 'package_type', 'package_id', 'user_id', 'user_name', 'father_name', 'cnic',  'mobile_number', 'mobile_number2',
        'email', 'address', 'device_modal', 'purchasing', 'billing_date', 'device_property', 'company_name', 'paid_status', 'bill_status',
        'installation_charges', 'device_charges', 'security', 'total_bill', 'status', 'is_deleted', 'is_active'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function bills()
    {
        return $this->hasMany(CustomersBills::class, 'customer_id', 'user_id'); // Assuming 'user_id' in 'Customer' model relates to 'customer_id' in 'CustomersBills' model
    }
}
