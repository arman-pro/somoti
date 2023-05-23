<?php

namespace App\Models;

use App\Casts\CustomDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Withdraw extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "withdraws";

    protected $casts = [
        'date' => CustomDateCast::class,
    ];

    protected $fillable = [
        'withdraw_type', 'date', 'member_id', 'amount', 'comment',
    ];

    protected static $logAttributes = ['*'];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Withdraw has been {$eventName}";
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
