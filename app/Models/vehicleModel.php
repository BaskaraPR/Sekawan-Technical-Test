<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicleModel extends Model
{
    use HasFactory;
    protected $table = "vehicle";
    protected $fillable = ["name","licensePlate","description","ownership","type","status"];
}

