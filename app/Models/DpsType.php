<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DpsType extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "dpstypes";

    protected $fillable = [
        'name', 'code', 'duration', 'interest_rate', 'is_active',
    ];

    protected static $logAttributes = [
        'name', 'code', 'duration', 'interest_rate', 'is_active',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "DPS Type has been {$eventName}";
    }

}
