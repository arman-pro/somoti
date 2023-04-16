<?php
namespace App\Traits;

trait SuperAdminTrait {
    public function super_admin() {
        if(auth()->user()->level == 'Super Admin') {
            return true;
       }else {
            return false;
       }
    }
}