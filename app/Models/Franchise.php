<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    use HasFactory;
    protected $table = "franchises";

    protected $fillable = [
        'id', 'name', 'owner_name', 'location', 'details', 'is_active', 'is_deleted'
    ];
}
