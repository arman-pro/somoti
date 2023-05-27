<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BankAccount extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'bankaccounts';

    protected $fillable = [
        'name', 'ac_number', 'balance', 'branch_id', 'note',
    ];

    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Bank Account has been {$eventName}";
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
