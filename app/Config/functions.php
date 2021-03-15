<?php

function create_slug($str, $delimiter = '-')
{
    $low = mb_strtolower($str);
    $trim = trim($low, ' /\-=+?!@#$%^&*_`');
    $replace = str_replace([',', '/', '.', '՞', ':', '-', '—', '`', '~'], [' ', '-', '', '', '-', ' ', ''], $trim);
    $preg = preg_replace("/[,()\\\=\/+?!@#$%^&*_'\"]/", "", $replace);
    $preg = preg_replace('/\s\s+/', ' ', $preg);
    $preg = preg_replace('/-{2,}/', '-', $preg);
    $preg = preg_replace('~-+~', '-', $preg);
    $words = explode(' ', $preg);
    $words = array_map('trim', $words);
    $words = array_filter($words);
    $preg = implode($delimiter, $words);
    return $preg;
}
