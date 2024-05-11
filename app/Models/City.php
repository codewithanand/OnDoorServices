<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Appointment;

class City extends Model
{
    use HasFactory;

    public function appointments(){
        return $this->hasMany(Appointment::class, 'city_code', 'city_code');
    }
}
