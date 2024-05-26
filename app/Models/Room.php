<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_name',
        'capacity',
        'convenient',
        'status',
        'room_type_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'room_id';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTable() {
        return 'room';
    }

    public function roomType() {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
