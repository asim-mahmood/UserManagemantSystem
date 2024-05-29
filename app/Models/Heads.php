<?php

namespace App\Models;

use App\Models\Accounts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Heads extends Model
{
    use HasFactory;
    protected $table = "heads";

    protected $fillable = [
        'id', 'name', 'is_active'
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(Accounts::class, 'head_id');
    }
}
