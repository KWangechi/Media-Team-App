<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'supervisor_id',
    'workstation',
    'duty_assigned',
    'type_of_service',
    'equipment_id',
    'supervisor_signature',
    'setup_time',
    'date_assigned',
];

//relatioships
public function users(){
    return $this->belongsToMany(User::class);
}

public function equipment(){
    return $this->hasMany(Equipment::class);
}


}
