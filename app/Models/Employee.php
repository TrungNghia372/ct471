<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'gender',
        'email',
        'phone',
        'hire_date',
        'date_of_birth',
        'address',
        'salary',
        'national_id',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'employee_id';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTable()
    {
        return 'employee';
    }
    public function booking() {
        return $this->hasMany(Booking::class, 'employee_id');
    }
}
