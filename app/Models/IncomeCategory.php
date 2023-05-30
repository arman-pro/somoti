<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class IncomeCategory extends Model
{
    use HasFactory, LogsActivity;

    protected $table = "incomecategories";

    protected $fillable = [
        'name', 'code', 'is_active', 'note',
    ];


    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Income Category has been {$eventName}";
    }
}
