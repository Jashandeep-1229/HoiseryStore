<?php

if (!function_exists('formatIndianNumber')) {
    function formatIndianNumber($num) {
        $exploded = explode('.', number_format($num, 2, '.', ''));
        $integerPart = $exploded[0];
        $decimalPart = isset($exploded[1]) ? '.' . $exploded[1] : '';

        $lastThree = substr($integerPart, -3);
        $restUnits = substr($integerPart, 0, -3);

        if (strlen($restUnits) > 0) {
            $restUnits = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $restUnits);
            return $restUnits . ',' . $lastThree . $decimalPart;
        } else {
            return $lastThree . $decimalPart;
        }
    }
}
