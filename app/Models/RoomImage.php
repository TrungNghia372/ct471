<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'room_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'image_id';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTable() {
        return 'roomimage';
    }

    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
