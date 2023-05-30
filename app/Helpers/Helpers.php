<?php
/**
 * Global helper file
 */


if(!function_exists('fileUpdaload')) {
    /**
     * store uploaded file from the client
     * @param mix $request
     * @param string $fileName uploaded file name
     * @param string $path uplode directory path
     * @return string uploaded file new name
     */
    function fileUpload($request, $fileName, $path) {
        $newName = substr(rand(), 0, 8) . "_" . date("d_m_y") . "." . $request->$fileName->getClientOriginalExtension();
        $request->$fileName->storeAs($path, $newName);
        return $newName;
    }
}

if(!function_exists('generateUniqueMemberNo')) {
    /**
     * generate a unique member no
     * @return string unique number
     */
    function generateUniqueMemberNo(){
        $lastMember = \App\Models\Member::select('member_no')->where('member_no', 'LIKE', 'MN' . '%')->latest()->first();
        if($lastMember) {
            $member_no = str_replace("MN-", '', $lastMember->member_no);
            if($member_no < 9) {
                return "MN-00" . ($member_no + 1);
            }
            if($member_no < 99) {
                return "MN-0" . ($member_no + 1);
            }
            return "MN-" . ($member_no + 1);
        }
        return "MN-001";
    }
}

if(!function_exists('generateUniqueAccount')) {
    /**
     * generate a unique member no
     * @return string unique number
     */
    function generateUniqueAccount(){
        $lastMember = \App\Models\Member::select('account')->where('account', 'LIKE', 'AC' . '%')->latest()->first();
        if($lastMember) {
            $member_no = str_replace("AC-", '', $lastMember->account);
            if($member_no < 9) {
                return "AC-00" . ($member_no + 1);
            }
            if($member_no < 99) {
                return "AC-0" . ($member_no + 1);
            }
            return "AC-" . ($member_no + 1);
        }
        return "AC-001";
    }
}

if(!function_exists('saveDateFormat')) {
    /**
     * return date for save to db
     * @param DateTime
     * @return Date Y-m-d
     */
    function saveDateFormat($date) {
        if(!$date) {
            return null;
        }
        return date('Y-m-d', strtotime(str_replace('/', '-', $date)));
    }
}

if(!function_exists('modelAlais')) {
    /**
     * get model alais
     * @return string
     */
    function modelAlais($modelName) {
        $modelAlais = getModelAlaisList();
        return $modelAlais[$modelName] ?? $modelName;
    }
}

if(!function_exists('SavingVchGenerate')) {
    /**
     * generate a unique voucher no
     * @return string unique voucher
     */
    function SavingVchGenerate($prefix='SV'){
        $lastSavings = \App\Models\Saving::select('voucher_no')->where('voucher_no', 'LIKE', $prefix . '%')->latest()->first();
        if($lastSavings) {
            $member_no = str_replace("$prefix-", '', $lastSavings->voucher_no);
            if($member_no < 9) {
                return "$prefix-00" . ($member_no + 1);
            }
            if($member_no < 99) {
                return "$prefix-0" . ($member_no + 1);
            }
            return "$prefix-" . ($member_no + 1);
        }
        return "$prefix-001";
    }
}


if(!function_exists('generateInstallmentNo')) {
    /**
     * generate a unique installment no
     * @return string unique installment no
     */
    function generateInstallmentNo($prefix='IN'){
        $lastSavings = \App\Models\Installment::select('installment_no')->where('installment_no', 'LIKE', $prefix . '%')->orderBy('id', 'desc')->first();
        if($lastSavings) {
            $installment_no = str_replace("$prefix-", '', $lastSavings->installment_no);
            if($installment_no < 9) {
                return "$prefix-00" . ($installment_no + 1);
            }
            if($installment_no < 99) {
                return "$prefix-0" . ($installment_no + 1);
            }
            return "$prefix-" . ($installment_no + 1);
        }
        return "$prefix-001";
    }
}

if(!function_exists('generateDpsId')) {
    /**
     * generate a unique dps id
     * @return string unique dps id
     */
    function generateDpsId($prefix='DPS'){
        $lastDps = \App\Models\Dps::select('dps_id')->where('dps_id', 'LIKE', $prefix . '%')->orderBy('id', 'desc')->first();
        if($lastDps) {
            $dps_id = str_replace("$prefix-", '', $lastDps->dps_id);
            if($dps_id < 9) {
                return "$prefix-00" . ($dps_id + 1);
            }
            if($dps_id < 99) {
                return "$prefix-0" . ($dps_id + 1);
            }
            return "$prefix-" . ($dps_id + 1);
        }
        return "$prefix-001";
    }
}


if(!function_exists('generateSharePurchaseVoucharNo')) {
    /**
     * generate a unique share purchase vouchar no
     * @param string $prefix default 'SP'
     * @return string unique mixed
     */
    function generateSharePurchaseVoucharNo($prefix='SP'){
        $lastSharePurchase = \App\Models\SharePurchase::select('vouchar_no')->where('vouchar_no', 'LIKE', $prefix . '%')->orderBy('id', 'desc')->first();
        if($lastSharePurchase) {
            $lastVoucharNo = str_replace("$prefix-", '', $lastSharePurchase->vouchar_no);
            if($lastVoucharNo < 9) {
                return "$prefix-00" . ($lastVoucharNo + 1);
            }
            if($lastVoucharNo < 99) {
                return "$prefix-0" . ($lastVoucharNo + 1);
            }
            return "$prefix-" . ($lastVoucharNo + 1);
        }
        return "$prefix-001";
    }
}

if(!function_exists('generateIncomeVoucharNo')) {
    /**
     * generate a unique income vouchar no
     * @param string $prefix default 'IN'
     * @return string unique mixed
     */
    function generateIncomeVoucharNo($prefix='IN'){
        $lastIncome = \App\Models\Income::select('voucher_no')->where('voucher_no', 'LIKE', $prefix . '%')->orderBy('id', 'desc')->first();
        if($lastIncome) {
            $lastVoucharNo = str_replace("$prefix-", '', $lastIncome->voucher_no);
            if($lastVoucharNo < 9) {
                return "$prefix-00" . ($lastVoucharNo + 1);
            }
            if($lastVoucharNo < 99) {
                return "$prefix-0" . ($lastVoucharNo + 1);
            }
            return "$prefix-" . ($lastVoucharNo + 1);
        }
        return "$prefix-001";
    }
}
