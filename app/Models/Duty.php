<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = [
    'week',
    'member_name',
    'supervisor_name',
    'workstation',
    'duty_assigned',
    'type_of_service',
    'supervisor_signature',
    'setup_time',
    'date_assigned',
];


public function equipment(){
    return $this->hasMany(Equipment::class);
}


}
