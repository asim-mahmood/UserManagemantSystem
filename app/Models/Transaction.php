<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = "transactions";

    protected $fillable = [
        'id', 'account_id', 'amount', 'narration', 'is_active'
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Accounts::class, 'account_id');
    }
}
