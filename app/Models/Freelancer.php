<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\FreelancerReview;
use App\Models\FreelancerService;


class Freelancer extends Model
{
    use HasFactory;

    public function reviews(){
        return $this->belongsTo(FreelancerReview::class, 'id', 'freelancer_id');
    }

    public function freelancer_services(){
        $this->belongsTo(FreelancerService::class, 'freelancer_id', 'id');
    }
}
