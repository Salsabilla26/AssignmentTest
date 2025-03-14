<?php

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        return session()->get('user_session') ? true : false;
    }
}
