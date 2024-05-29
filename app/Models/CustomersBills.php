<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersBills extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'customer_id', 'package_id', 'billing_date', 'month', 'amount', 'paid', 'pending', 'billed_by', 'is_deleted'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
