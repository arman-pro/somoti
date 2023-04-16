<?php
namespace App\Traits;

trait UserTrait {
    public function user() {
        return auth()->user();
    }
}