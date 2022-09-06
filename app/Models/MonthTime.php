<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthTime extends Model
{
    use HasFactory;
    
    protected $table = 'month_time';

    protected $fillable = [
        'id',
        'vehicle_id',
        'total_min'
    ];

    public function vehicle()
    {
     return  $this->hasMany(Vehicle::class);
    }
}
