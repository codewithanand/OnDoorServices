<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\BookedAppointment;
use App\Models\Service;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Village;


class Appointment extends Model
{
    use HasFactory;

    public function booked_appointments(){
        return $this->hasMany(BookedAppointment::class, 'appointment_id', 'id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function state(){
        return $this->belongsTo(State::class, 'state_code', 'state_code');
    }

    public function district(){
        return $this->belongsTo(District::class, 'district_code', 'district_code');
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_code', 'city_code');
    }

    public function village(){
        return $this->belongsTo(Village::class, 'village_code', 'village_code');
    }
}
