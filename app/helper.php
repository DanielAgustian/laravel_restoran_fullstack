<?php

function daysTranslator($int){
    $number = (int) $int;
    $arr = ['Monday', "Tuesday", "Wednesday", "Friday", "Saturday", "Sunday"];
    return $arr[$number];
}

function hoursOpenTranslator($string){
    $arr = explode(' ', $string);
    $arrHour = explode(':', $arr[1]); 

    return $arrHour[0].":".$arrHour[1];
}

function set_active_bar($uri, $output = 'text-primary font-super-bold')
{
 if(is_array($uri) ) {
   foreach ($uri as $u) {
     if (Route::is($u)) {
       return $output;
     }
   }
 } else {
   if (Route::is($uri)){
     return $output;
   }
 }
}

function set_active_button($uri, $output = 'btn-primary')
{
 if(is_array($uri) ) {
   foreach ($uri as $u) {
     if (Route::is($u)) {
       return $output;
     }
   }
 } else {
   if (Route::is($uri)){
     return $output;
   }
 }
}