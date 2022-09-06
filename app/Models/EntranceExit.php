<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntranceExit extends Model
{
    use HasFactory;

    protected $table ='entrance_exit';

    protected $fillable = [
        'id',
        'entrance',
        'exit',
        'vehicle_id'
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

}
