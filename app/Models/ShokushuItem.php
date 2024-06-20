<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShokushuItem extends Model
{
	use HasFactory;
	protected $guarded = [];

	public function recruits() : BelongsToMany
	{
		return $this->belongsToMany(Recruit::class, 'recruits_shokushu_items');
	}
}
