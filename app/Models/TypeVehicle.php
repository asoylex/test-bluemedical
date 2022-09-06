<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVehicle extends Model
{
    use HasFactory;

    protected $table = 'type_vehicle';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
