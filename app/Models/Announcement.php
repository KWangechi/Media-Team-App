<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    public $table = 'announcements';

    protected $fillable = ['title', 'content', 'event_date', 'event_time', 'event_location'];

}
