<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Member extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'join_date', 'member_no', 'account', 'name', 'mobile', 'group_id', 'extra_info'
    ];

    protected static $logAttributes = ['*'];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Member has been {$eventName}";
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    protected $casts = [
        'join_date' => 'datetime:Y-m-d',
    ];
}
