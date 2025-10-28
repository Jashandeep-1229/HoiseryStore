<?php

if (!function_exists('formatIndianNumber')) {
    function formatIndianNumber($num) {
        $isNegative = $num < 0; // check if negative
        $num = abs($num); // work with positive value

        $exploded = explode('.', number_format($num, 2, '.', ''));
        $integerPart = $exploded[0];
        $decimalPart = isset($exploded[1]) ? '.' . $exploded[1] : '';

        $lastThree = substr($integerPart, -3);
        $restUnits = substr($integerPart, 0, -3);

        if (strlen($restUnits) > 0) {
            $restUnits = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $restUnits);
            $formatted = $restUnits . ',' . $lastThree . $decimalPart;
        } else {
            $formatted = $lastThree . $decimalPart;
        }

        // re-attach negative sign if needed
        return $isNegative ? '-' . $formatted : $formatted;
    }
}

if (!function_exists('formatIndianNumberWithoutDecimal')) {
    function formatIndianNumberWithoutDecimal($num) {
        $isNegative = $num < 0; // check if negative
        $num = abs($num); // make positive for formatting

        $integerPart = (string)intval($num);
        $lastThree = substr($integerPart, -3);
        $restUnits = substr($integerPart, 0, -3);

        if (strlen($restUnits) > 0) {
            $restUnits = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $restUnits);
            $formatted = $restUnits . ',' . $lastThree;
        } else {
            $formatted = $lastThree;
        }

        // re-attach negative sign
        return $isNegative ? '-' . $formatted : $formatted;
    }
}
