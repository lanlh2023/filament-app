<?php

namespace Domain\Apply\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prefecture extends BaseModel
{
    protected $fillable = [
        'area_name',
        'name',
        'cnt',
    ];

    public function recruits(): HasMany
    {
        return $this->hasMany(Recruit::class);
    }
}
