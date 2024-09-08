<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driverModel extends Model
{
    use HasFactory; 
    protected $table = "driver";
    protected $fillable = ["name","status"];
}
