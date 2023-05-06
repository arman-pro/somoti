<?php
/**
 * Global helper file
 */

use Illuminate\Http\Request as HttpRequest;

if(!function_exists('fileUpdaload')) {
    /**
     * store uploaded file from the client
     * @param  \Illuminate\Http\Request  $request
     * @param string $fileName uploaded file name
     * @param string $path uplode directory path
     * @return string uploaded file new name
     */
    function fileUpload(HttpRequest $request, $fileName, $path) {
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
