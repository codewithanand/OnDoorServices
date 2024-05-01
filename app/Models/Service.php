<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ServicePartner;
use App\Models\ServiceRequest;


class Service extends Model
{
    use HasFactory;

    public function service_partner(){
        return $this->belongsTo(ServicePartner::class, 'service_partner_id', 'id');
    }

    public function service_requests(){
        return $this->hasMany(ServiceRequest::class, 'service_id', 'id');
    }
}
