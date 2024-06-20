<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entry extends Model
{
    use HasFactory;

	protected $guarded = [];

	protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'company_id',
		'recruit_id'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

	public function recruit(): BelongsTo
    {
        return $this->belongsTo(Recruit::class);
    }
}
