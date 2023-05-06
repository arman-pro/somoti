<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Saving extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'date', 'voucher_no', 'amount', 'member_id', 'comment',
    ];

    protected static $logAttributes = ['*'];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Savings has been {$eventName}";
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
