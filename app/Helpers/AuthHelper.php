<?php

if (!function_exists('currentAuthUser')) {
    function currentAuthUser(string $guard)
    {
        return auth()->guard($guard)->user();
    }
}

if (!function_exists('currentUser')) {
    function currentUser()
    {
        return auth()->guard('web')->user();
    }
}

if (!function_exists('currentAdminUser')) {
    function currentAdminUser()
    {
        return auth()->guard('admin_user')->user();
    }
}
