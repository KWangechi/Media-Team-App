<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable=['user_id', 'reason', 'start_date', 'end_date', 'status'];

    public $timestamps = false;

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
