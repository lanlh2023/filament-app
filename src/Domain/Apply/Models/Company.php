<?php

namespace Domain\Apply\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends BaseModel
{
    use HasFactory;

	protected $guarded = [];

	protected $fillable = [
        'name',
        'address',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
