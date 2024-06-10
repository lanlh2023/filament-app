<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Recruit extends Model implements HasMedia
{
	use HasFactory;
	use InteractsWithMedia;

	protected $guarded = [];

	public function company(): BelongsTo
	{
		return $this->belongsTo(Company::class);
	}

	public function prefecture(): BelongsTo
	{
		return $this->belongsTo(Prefecture::class);
	}

	// public function registerMediaConversions(Media $media = null): void
	// {
	// 	$this
	// 		->addMediaConversion('preview')
	// 		->fit(Fit::Contain, 300, 300)
	// 		->nonQueued();
	// }
}
