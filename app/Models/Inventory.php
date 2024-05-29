<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = "inventory";

    protected $fillable = [
        'id','date', 'product', 'company', 'unit_price',  'quantity', 'total_price', 'status', 'description', 'is_deleted'
    ];
}
