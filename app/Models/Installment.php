<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Installment extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'installmentable_type', 'installmentable_id', 'date', 'amount', 'payable_date', 'payable_amount', 'received_by', 'is_paid'
    ];

    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Installment has been {$eventName}";
    }

}
