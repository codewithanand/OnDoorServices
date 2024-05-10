<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Freelancer;

class FreelancerReview extends Model
{
    use HasFactory;

    public function freelancer(){
        return $this->hasMany(Freelancer::class, 'freelancer_id', 'id');
    }
}
