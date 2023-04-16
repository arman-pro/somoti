<?php
namespace App\Traits;

trait AdminTrait {
    // if a user is admin then return true
    public function admin() {
       if(auth()->user()->level == 'Admin') {
            return true;
       }else {
            return false;
       }
    }
}