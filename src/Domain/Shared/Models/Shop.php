<?php

namespace Domain\Shared\Models;

use Database\Factories\Shared\ShopFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Shop extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

	protected static function newFactory()
    {
        return app(ShopFactory::class);
    }
}
