<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Freelancer;

class FreelancerService extends Model
{
    use HasFactory;

    public function freelancers(){
        return $this->hasMany(Freelancer::class, 'id', 'freelancer_id');
    }

    public function services(){
        return $this->hasMany(Service::class, 'id', 'service_id');
    }
}
