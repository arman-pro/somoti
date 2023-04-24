<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Area extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name', 'code', 'branch_id', 'is_active',
    ];

    protected static $logAttributes = ['name', 'code', 'branch_id', 'is_active'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Area has been {$eventName}";
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
