<?php

if (!function_exists('format_money')) {
    function format_money($number, $dec_point = ".", $thousands_sep = ",")
    {
        $data = preg_replace("/\\" . $dec_point . "00$/", "", number_format($number, 2, $dec_point, $thousands_sep));
        return $data;
    }
}

if (!function_exists('formatVND')) {
    function formatVND($number)
    {
        echo  format_money($number, ",", ".") . ' ₫';
    }
}

if (!function_exists('formatVNDString')) {
    function formatVNDString($number)
    {
        return format_money($number, ",", ".") . ' ₫';
    }
}

if (!function_exists('formatCNY')) {
    function formatCNY($number)
    {
        echo '¥ ' . format_money($number, ".", ",");
    }
}

if (!function_exists('formatVNDNoSymbol')) {
    function formatVNDNoSymbol($number)
    {
        return format_money($number, ",", ".");
    }
}

if (!function_exists('formatCNYNoSymbol')) {
    function formatCNYNoSymbol($number)
    {
        return format_money($number, ".", ",");
    }
}

if (!function_exists('formatvidate')) {
    function formatvidate($time)
    {
        return date('d-m-Y H:i:s', strtotime($time));
    }
}

if (!function_exists('formateudate')) {
    function formateudate($time)
    {
        return date('Y-m-d H:i:s', strtotime($time));
    }
}

if (!function_exists('formatorderid')) {
    function formatorderid($time, $id)
    {
        return date('Y-m-d', strtotime($time)) . '-QDH' . $id;
    }
}