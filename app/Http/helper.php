<?php
namespace App\Http;



use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (!function_exists('direction')){
    function direction(){
        return LaravelLocalization::getCurrentLocaleDirection();
    }
}
