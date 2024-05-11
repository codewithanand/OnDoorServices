<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\FreelancerReview;
use App\Models\FreelancerService;


class Freelancer extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function reviews(){
        return $this->belongsTo(FreelancerReview::class, 'id', 'freelancer_id');
    }

    public function freelancer_services(){
        $this->belongsTo(FreelancerService::class, 'freelancer_id', 'id');
    }
}
