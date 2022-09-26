<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ClientUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'balance',
        'mobile_number',
        'password'
    ];

    public function getRouteKeyName(): string
    {
        return 'mobile_number';
    }
}
