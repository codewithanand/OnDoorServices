<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ServicePartner;

class Service extends Model
{
    use HasFactory;

    public function service_partner(){
        return $this->belongsTo(ServicePartner::class, 'id', 'service_partner_id');
    }
}
