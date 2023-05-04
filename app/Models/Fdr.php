<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Fdr extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        "date", "member_id", "fdrtype_id", "account", "start_date",
        "expire_date", "fdr_amount", "return_interest", "refer_member",
        "refer_user", "is_matured", "comment",
    ];

    protected static $logAttributes = [
        "date", "member_id", "fdrtype_id", "account", "start_date",
        "expire_date", "fdr_amount", "return_interest", "refer_member",
        "refer_user", "is_matured", "comment",
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "FDR has been {$eventName}";
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function fdrType()
    {
        return $this->belongsTo(FdrType::class, 'fdrtype_id');
    }

    public function referMember()
    {
        return $this->belongsTo(Member::class, 'refer_member');
    }

    public function referUser()
    {
        return $this->belongsTo(User::class, 'refer_user');
    }
}
