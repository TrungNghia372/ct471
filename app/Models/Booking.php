<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_date',
        'total_amount',
        'request',
        'customer_id',
        'employee_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'booking_id';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTable() {
        return 'booking';
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function bookingDetail() {
        return $this->hasMany(BookingDetail::class, 'booking_id');
    }
}
