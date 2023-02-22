<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    use HasFactory;

    protected $fillable = [
    'week',
    'duty_personel_details',
    'supervisor_signature',
    'setup_time',
    'date_assigned',
];

protected $casts = [
    'duty_personel_details' => 'array'
];


public function equipment(){
    return $this->hasMany(Equipment::class);
}


}
