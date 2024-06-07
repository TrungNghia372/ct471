<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'date_of_birth',
        'gender',
        'phone',
        'national_id',
        'email',
        'address',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'customer_id';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTable()
    {
        return 'customer';
    }

    public function booking() {
        return $this->hasMany(Booking::class, 'customer_id');
    }
}
