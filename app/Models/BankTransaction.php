<?php

namespace App\Models;

use App\Casts\CustomDateCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BankTransaction extends Model
{
    use HasFactory, LogsActivity;

    protected $casts = [
        'date' => CustomDateCast::class,
    ];

    protected $fillable = [
        'date', 'amount', 'transaction_type', 'bankaccount_id', 'note',
    ];

    protected static $logAttributes = ['*'];
    public function getDescriptionForEvent(string $eventName): string
    {
        return "Withdraw has been {$eventName}";
    }

    public function bank()
    {
        return $this->belongsTo(BankAccount::class, 'bankaccount_id');
    }

}
