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

if(!function_exists('filterDateFormat')) {
    /**
     * filtered date format
     */
    function filterDateFormat() {
        return str_replace(["DD", "MM", "YYYY"], ["d", "m", "Y"], config('setting.dateFormat'));
    }
}

if(!function_exists('printDateFormat')) {
    /**
     * return date format for print
     * @param DateTime
     * @return Date
     */
    function printDateFormat($date) {
        if(!$date) {
            return "N/A";
        }
        $format = str_replace(["DD", "MM", "YYYY"], ["d", "m", "Y"], config('setting.dateFormat'));
        return date($format, strtotime(str_replace('/', '-', $date)));
    }
}

