<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $table = "packages";

    protected $fillable = [
        'id', 'name', 'speed', 'cost',  'price', 'status', 'is_active'
    ];

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customers', 'package_id', 'id');
    }
}
