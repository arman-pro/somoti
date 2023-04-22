<?php

if(!function_exists('dateFormat')) {
    /**
     * date format helper function
     * @return string
     */
    function dataFormat() {
        return config('setting.dateFormat');
    }
}


