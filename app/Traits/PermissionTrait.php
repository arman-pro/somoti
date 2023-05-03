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
            'member', 'dpsType', 'dps', 'fdrType', 'user', 'role', 'language', 'branch', 'area', 'group'
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
            'report' => [
                ['user'],
            ],
            'miscellaneous' => [
                [
                    'General Setting' => 'general_setting',
                    'Backup Database' => 'database_backup',
                    'Activity Log' => 'activity_log'
                ]
            ],
        ];
    }
}