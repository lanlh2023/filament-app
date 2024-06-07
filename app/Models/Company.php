<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

	protected $guarded = [];

	public function recruits() : HasMany
	{
		 return $this->hasMany(Recruit::class);
	}

	public function prefecture() : BelongsTo
	{
		 return $this->belongsTo(Company::class);
	}
}
