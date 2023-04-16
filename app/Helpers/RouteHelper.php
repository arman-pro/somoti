<?php

/**
 * route redirect back helper
 */
if(!function_exists("redirectBack")) {
    /**
     * return back url
     */
    function redirectBack() {
        return redirect()->back();
    }
}

/**
 * redirect to route
 */
if(!function_exists('redirectToRoute')) {
    /**
     * redirect to route
     * @param string $route route name
     * @return
     */
    function redirectToRoute($route) {
        return redirect()->route($route);
    }
}