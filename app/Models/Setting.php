<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'facebook', 'phone', 'email', 'timezone', 'address', 'is_maitanence_mood', 'currency', 'active_sms'
    ];
}
