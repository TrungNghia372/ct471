<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_from',
        'date_to',
        'room_id',
        'booking_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'booking_detail_id';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTable() {
        return 'bookingdetail';
    }

    public function room() {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function booking() {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
