<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutyMemberDetails extends Model
{
    use HasFactory;

    // public $table = 'duty_member_details';

    protected $fillable = [
        'duty_id',
        'member_name',
        'supervisor_name',
        'workstation',
        'duty_assigned',
        'event_type'

    ];

    // relationships

    public function duties() {
        return $this->belongsToMany(Duty:: class);
    }

}
