<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'sn',
        'user_id',
        'name',
        'card_no',
        'password',
        'privilege',
        'group',
        'timezone',
        'raw_payload',
    ];
}
