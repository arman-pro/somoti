<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class LoanType extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'loantypes';

    protected $fillable = [
        "name", "code", "day_repay", "interest_rate", "is_active"
    ];

    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Loan Type has been {$eventName}";
    }


}
