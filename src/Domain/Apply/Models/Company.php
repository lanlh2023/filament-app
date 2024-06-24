<?php

namespace Domain\Apply\Models;

use Domain\Shared\Models\BaseModel;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends BaseModel
{
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
