<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Income extends Model
{
    use HasFactory, LogsActivity;
    
    protected $fillable = [
        'date', 'amount', 'voucher_no', 'incomecategory_id', 'note',
    ];

    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Income has been {$eventName}";
    }

    public function incomeCategory()
    {
        return $this->belongsTo(IncomeCategory::class, 'incomecategory_id');
    }
}
