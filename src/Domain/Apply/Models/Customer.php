<?php

namespace App\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends BaseModel
{
    use HasFactory;

	protected $fillable = [
        'name',
    ];
}
