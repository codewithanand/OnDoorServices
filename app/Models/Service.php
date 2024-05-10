<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Appointment;
use App\Models\FreelancerService;



class Service extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function appointments(){
        return $this->hasMany(Appointment::class, 'service_id', 'id');
    }

    public function freelancer_services(){
        $this->belongsTo(FreelancerService::class, 'service_id', 'id');
    }
}
