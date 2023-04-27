<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Dps extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        "date", "member_id", "dpstype_id", "account","amount_per_installment", "number_of_installment", "start_date", "expire_date",
        "fine_missing_dps", "profit", "total_amount", "is_matured", "comment",
    ];

    protected static $logAttributes = [
        "date", "member_id", "dpstype_id", "account","amount_per_installment", "number_of_installment", "start_date", "expire_date",
        "fine_missing_dps", "profit", "total_amount", "is_matured", "comment",
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "DPS has been {$eventName}";
    }
}
