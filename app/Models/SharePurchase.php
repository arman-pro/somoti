<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SharePurchase extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'sharepurchases';

    protected $fillable = [
        'vouchar_no', 'date', 'amount', 'member_id', 'comment',
    ];

    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Share Purchase Type has been {$eventName}";
    }

    /**
     * get member relation
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
