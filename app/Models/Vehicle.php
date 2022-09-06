<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicle';

    protected $fillable = [
        'id',
        'license_plate',
        'type_vehicle_id',
        'status'
    ];

    public function entranceExit()
    {
     return  $this->hasMany(EntranceExit::class);
    }

 
    public function typeVehicle()
    {
        return $this->hasOne(TypeVehicle::class);
    }

    public function montTime()
    {
        return $this->belongsTo(MonthTime::class);
    }
}
