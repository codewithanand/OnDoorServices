<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Appointment;

class District extends Model
{
    use HasFactory;

    public function appointments(){
        return $this->hasMany(Appointment::class, 'district_code', 'district_code');
    }
}
