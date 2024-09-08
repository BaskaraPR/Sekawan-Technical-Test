<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detailRequestModel extends Model
{
    use HasFactory;

    protected $table = 'detail_request';

    protected $fillable = [
        'id_request',
        'fuel_usage',
        'used_at',
        'returned_at'
    ];

    public function request()
    {
        return $this->belongsTo(requestModel::class, 'id_request');
    }
}
