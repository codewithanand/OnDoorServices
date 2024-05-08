<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BookedAppointment;
use App\Models\Service;


class Appointment extends Model
{
    use HasFactory;

    public function booked_appointments(){
        return $this->hasMany(BookedAppointment::class, 'appointment_id', 'id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
