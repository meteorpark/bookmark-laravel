<?php

if (!function_exists('timezone')) {

    /**
     * timezone 가져오기
     * @return string
     */
    function timezone(): string
    {
        $ip = file_get_contents("http://ipecho.net/plain");
        $url = 'http://ip-api.com/json/' . $ip;
        $tz = file_get_contents($url);
        $tz = json_decode($tz, true)['timezone'];
        return $tz;
    }
}


