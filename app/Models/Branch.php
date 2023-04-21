<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Branch extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name', 'code', 'is_active',
    ];

    protected static $logAttributes = ['name', 'code', 'is_active'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Branch has been {$eventName}";
    }

}
