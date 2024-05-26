<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_name',
        'description',
        'hourly_price',
        'overnight_price',
        'daily_price',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'room_type_id';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTable()
    {
        return 'roomtype';
    }
}
