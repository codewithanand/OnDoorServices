<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Seeker;
use App\Models\Appointment;


class BookedAppointment extends Model
{
    use HasFactory;

    public function seeker(){
        return $this->belongsTo(Seeker::class, 'seeker_id', 'id');
    }

    public function appointment(){
        return $this->belongsTo(Appointment::class, 'appointment_id', 'id');
    }
}
