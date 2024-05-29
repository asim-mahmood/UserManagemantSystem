<?php

namespace App\Models;

use App\Models\Heads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accounts extends Model
{
    use HasFactory;
    protected $table = "accounts";
    protected $fillable = [
        'id', 'title', 'head_id', 'name', 'is_active'
    ];

    public function head(): BelongsTo
    {
        return $this->belongsTo(Heads::class, 'head_id');
    }

    public function tansactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'account_id');
    }
}
