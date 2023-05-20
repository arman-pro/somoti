<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dps;
use App\Models\Fdr;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Saving;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['memberCount'] = Member::count();
        $data['savingCount'] = Saving::count();
        $data['dpsCount'] = Dps::count();
        $data['fdfCount'] = Fdr::count();
        $data['loanCount'] = Loan::count();
        $data['loanAmount'] = Loan::sum('amount');
        $data['savingsAmount'] = Saving::sum('amount');
        $data['dpsAmount'] = Dps::sum('total_amount');
        $data['fdrAmount'] = Fdr::sum('fdr_amount');
        $data['latestMembers'] = Member::latest()->take(10)->get();
        return view('index', $data);
    }
}
