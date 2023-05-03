<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class FdrType extends Model
{
    use HasFactory, LogsActivity;

    // set table name
    protected $table = 'fdrtypes';

    // set fillable field
    protected $fillable = [
        'name', 'code', 'duration', 'interest_rate', 'is_active',
    ];

    // set log attributes
    protected static $logAttributes = [
        'name', 'code', 'duration', 'interest_rate', 'is_active',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "FDR Type has been {$eventName}";
    }
}
