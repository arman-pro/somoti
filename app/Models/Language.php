<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Language extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['title', 'slug'];

    protected static $logAttributes = ['title', 'slug'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Language has been {$eventName}";
    }
}
