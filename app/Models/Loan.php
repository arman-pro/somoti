<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Loan extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'date', 'mobile', 'amount', 'interest', 'total_amount_payable', 'installment_amount', 'installment_number',
        'insurence_amount', 'loan_fee', 'loan_start_date', 'loan_end_date', 'loantype_id', 'member_id', 'refer_user_id',
        'refer_member_id', 'extra_info',
    ];

    protected static $logAttributes = ['*'];

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Loan Type has been {$eventName}";
    }

    /**
     * member
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * loan type
     */
    public function loanType()
    {
        return $this->belongsTo(LoanType::class, 'loantype_id');
    }

    /**
     * refer user
     */
    public function refUser()
    {
        return $this->belongsTo(User::class, 'refer_user_id');
    }

    /**
     * refer member
     */
    public function refMember()
    {
        return $this->belongsTo(Member::class, 'refer_member_id');
    }
}
