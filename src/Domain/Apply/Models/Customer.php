<?php

namespace App\Models;

use Domain\Shared\Models\BaseModel;

class Customer extends BaseModel
{
	protected $fillable = [
        'name',
    ];
}
