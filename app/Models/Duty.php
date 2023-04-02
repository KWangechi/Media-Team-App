<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = [
    'week',
    'supervisor_signature',
    'setup_time',
    'date_assigned',
];

// realtionships
public function equipment(){
    return $this->hasMany(Equipment::class);
}

public function members() {
    return $this->hasMany(DutyMemberDetails::class);
}



}
