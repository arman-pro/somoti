<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Account extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name', 'code', 'note', 'is_active',
    ];

    protected static $logAttributes = ['name', 'code', 'note', 'is_active'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Account has been {$eventName}";
    }
}
