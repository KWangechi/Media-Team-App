<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SundayReport extends Model
{
    use HasFactory;

    public $table = 'sunday_reports';

    protected $fillable = ['user_id', 'report_date', 'comments'];

    //relationship
    public function users() {
        return $this->belongsTo(User::class, 'user_id');

    }
}
