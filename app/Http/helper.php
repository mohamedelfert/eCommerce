<?php

if (!function_exists('adminUrl')){
    function adminUrl($url = null){
        return url('admin/'.$url);
    }
}

if (!function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}
