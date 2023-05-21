<?php
namespace App\Traits;

trait PermissionTrait {
    // CRUD permissions
     // here difine user permissions
    // all permission table list
    /**
     * N:T: Demo permission -> "user" module permissio will be like this
     * "user-index", "user-create", "user-update", "user-destroy"
     * @return array
     */
    public function permission_list() {

        return [
            'member', 'savings', 'dpsType', 'dps', 'fdrType', 'fdr', 'loanType', 'loan', 'user', 
            'role', 'language', 'branch', 'area', 'group', 'sharePurchase', 'shareSale',
        ];
    }

    // other permission
    // here difine user other permissions
    // other permission
    /**
     * N:T: other permission must be 4 permission in an array
     * if no permission keep it empty stirng
     * ther permission will be like this "report-student"
     * @return array
     */
    public function other_permission_list() {

        return [
            'collection' => [
                'Loan Collection' => 'loan-collection',
                'Group Wise Collection' => 'group-wise-collection',
                'Savings Collection' => 'savings-collection',
                'DPS Collection' => 'dps-collection',
                'FDR Collection' => 'fdr-collection',
            ],
            'withdraw' => [
                'Savings Withdraw' => 'savings-withdraw',
                'DPS Withdraw' => 'dps-withdraw',
                'FDR Withdraw' => 'fdr-withdraw',
                'FDR Profit Withdraw' => 'fdr-profit-withdraw',
            ],
            'report' => [
                'User Report' => 'user-report',
            ],
            'miscellaneous' => [
                'General Settings' => 'general_setting',
                'Backup Database' => 'database_backup',
                'Activity Log' => 'activity_log',
            ],
        ];
    }
}