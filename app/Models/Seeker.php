<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BookedAppointment;

class Seeker extends Model
{
    use HasFactory;

    public function booked_appointments(){
        return $this->hasMany(BookedAppointment::class, 'seeker_id', 'id');
    }
}
