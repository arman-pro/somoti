<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ShareSale extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'shares';

    protected $fillable = [
        'vouchar_no', 'share_type', 'date', 'amount', 'member_id', 'comment',
    ];

    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Share Sale Type has been {$eventName}";
    }

    /**
     * get member relation
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
