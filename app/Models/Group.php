<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name', 'code', 'area_id', 'is_active',
    ];

    protected static $logAttributes = ['name', 'code', 'area_id', 'is_active'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Group has been {$eventName}";
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

}
