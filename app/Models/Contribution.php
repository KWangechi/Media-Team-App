<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount_contributed', 'date_contributed', 'comment', 'progress'];

    /**
     * Realtionship between Contributions and users
     */
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
