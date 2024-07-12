<?php

namespace Domain\Apply\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Recruit extends BaseModel implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'company_id',
        'prefecture_id',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function entries(): HasMany
    {
        return $this->hasMany(Entry::class);
    }

    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function shokushuItems(): BelongsToMany
    {
        return $this->belongsToMany(ShokushuItem::class, 'recruits_shokushu_items');
    }
}
