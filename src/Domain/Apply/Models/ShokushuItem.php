<?php

namespace Domain\Apply\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShokushuItem extends BaseModel
{
    protected $guarded = [];

    public function recruits(): BelongsToMany
    {
        return $this->belongsToMany(Recruit::class, 'recruits_shokushu_items');
    }
}
