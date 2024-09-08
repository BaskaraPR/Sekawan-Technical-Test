<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requestModel extends Model
{
    use HasFactory;

    protected $table = 'request';
    
    protected $fillable = [
        'id_user',
        'id_driver',
        'id_vehicle',
    ];

    protected $attributes = [
        'admin_approval' => 'pending',  // Default value
        'approver_approval' => 'pending',  // Default value
        'status' => 'pending',  // Default value
    ];

    public function details()
    {
        return $this->hasMany(detailRequestModel::class, 'id_request');
    }

    public function user() {
        return $this->belongsTo(userModel::class, 'id');
    }
    
    public function driver() {
        return $this->belongsTo(driverModel::class, 'id');
    }
    
    public function vehicle() {
        return $this->belongsTo(vehicleModel::class, 'id');
    }
}

