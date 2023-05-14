<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorrectGuess extends Model
{
    use HasFactory;

    protected $fillable = [
        'hours',
        'minutes',
        'seconds',
        'user_id',
    ];
}
