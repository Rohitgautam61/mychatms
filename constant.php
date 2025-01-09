<?php
# Constants
define('CSS_PATH', 'assets/css/');
define('JS_PATH', 'assets/js/');
define('LIBS_PATH', 'assets/libs/');
define('IMAGES_PATH', 'assets/images/');
define('FONTS_PATH', 'assets/fonts/');
define('UPLOADS_PATH', 'uploads/');
define('CONTROLLER_PATH', 'controllers/');
define('MODEL_PATH', 'models/');
define('VIEW_PATH', 'views/');
define('INCLUDES_PATH', 'includes/');
define('CONFIG_PATH', 'config/');
define('CORE_PATH', 'core/');
define('HELPER_PATH', 'helpers/');
define('ASSETS_PATH', 'assets/');

define('FINAL_SHEET_DATA','SUM(`1`) +SUM(`b1`)/10+SUM(`a0`)/10 AS `1`,SUM(`2`)+SUM(`b2`)/10+SUM(`a0`)/10 AS `2`,SUM(`3`)+SUM(`b3`)/10+SUM(`a0`)/10 AS `3`,SUM(`4`)+SUM(`b4`)/10+SUM(`a0`)/10 AS `4`,SUM(`5`)+SUM(`b5`)/10+SUM(`a0`)/10 AS `5`,SUM(`6`)+SUM(`b6`)/10+SUM(`a0`)/10 AS `6`,SUM(`7`)+SUM(`b7`)/10+SUM(`a0`)/10 AS `7`,SUM(`8`)+SUM(`b8`)/10+SUM(`a0`)/10 AS `8`,SUM(`9`)+SUM(`b9`)/10+SUM(`a0`)/10 AS `9`,SUM(`10`)+SUM(`b0`)/10+SUM(`a1`)/10 AS `10`,SUM(`11`)+SUM(`b1`)/10+SUM(`a1`)/10 AS `11`,SUM(`12`)+SUM(`b2`)/10+SUM(`a1`)/10 AS `12`,SUM(`13`)+SUM(`b3`)/10+SUM(`a1`)/10 AS `13`,SUM(`14`)+SUM(`b4`)/10+SUM(`a1`)/10 AS `14`,SUM(`15`)+SUM(`b5`)/10+SUM(`a1`)/10 AS `15`,SUM(`16`)+SUM(`b6`)/10+SUM(`a1`)/10 AS `16`,SUM(`17`)+SUM(`b7`)/10+SUM(`a1`)/10 AS `17`,SUM(`18`)+SUM(`b8`)/10+SUM(`a1`)/10 AS `18`,SUM(`19`)+SUM(`b9`)/10+SUM(`a1`)/10 AS `19`,SUM(`20`)+SUM(`b0`)/10+SUM(`a2`)/10 AS `20`,SUM(`21`)+SUM(`b1`)/10+SUM(`a2`)/10 AS `21`,SUM(`22`)+SUM(`b2`)/10+SUM(`a2`)/10 AS `22`,SUM(`23`)+SUM(`b3`)/10+SUM(`a2`)/10 AS `23`,SUM(`24`)+SUM(`b4`)/10+SUM(`a2`)/10 AS `24`,SUM(`25`)+SUM(`b5`)/10+SUM(`a2`)/10 AS `25`,SUM(`26`)+SUM(`b6`)/10+SUM(`a2`)/10 AS `26`,SUM(`27`)+SUM(`b7`)/10+SUM(`a2`)/10 AS `27`,SUM(`28`)+SUM(`b8`)/10+SUM(`a2`)/10 AS `28`,SUM(`29`)+SUM(`b9`)/10+SUM(`a2`)/10 AS `29`,SUM(`30`)+SUM(`b0`)/10+SUM(`a3`)/10 AS `30`,SUM(`31`)+SUM(`b1`)/10+SUM(`a3`)/10 AS `31`,SUM(`32`)+SUM(`b2`)/10+SUM(`a3`)/10 AS `32`,SUM(`33`)+SUM(`b3`)/10+SUM(`a3`)/10 AS `33`,SUM(`34`)+SUM(`b4`)/10+SUM(`a3`)/10 AS `34`,SUM(`35`)+SUM(`b5`)/10+SUM(`a3`)/10 AS `35`,SUM(`36`)+SUM(`b6`)/10+SUM(`a3`)/10 AS `36`,SUM(`37`)+SUM(`b7`)/10+SUM(`a3`)/10 AS `37`,SUM(`38`)+SUM(`b8`)/10+SUM(`a3`)/10 AS `38`,SUM(`39`)+SUM(`b9`)/10+SUM(`a3`)/10 AS `39`,SUM(`40`)+SUM(`b0`)/10+SUM(`a4`)/10 AS `40`,SUM(`41`)+SUM(`b1`)/10+SUM(`a4`)/10 AS `41`,SUM(`42`)+SUM(`b2`)/10+SUM(`a4`)/10 AS `42`,SUM(`43`)+SUM(`b3`)/10+SUM(`a4`)/10 AS `43`,SUM(`44`)+SUM(`b4`)/10+SUM(`a4`)/10 AS `44`,SUM(`45`)+SUM(`b5`)/10+SUM(`a4`)/10 AS `45`,SUM(`46`)+SUM(`b6`)/10+SUM(`a4`)/10 AS `46`,SUM(`47`)+SUM(`b7`)/10+SUM(`a4`)/10 AS `47`,SUM(`48`)+SUM(`b8`)/10+SUM(`a4`)/10 AS `48`,SUM(`49`)+SUM(`b9`)/10+SUM(`a4`)/10 AS `49`,SUM(`50`)+SUM(`b0`)/10+SUM(`a5`)/10 AS `50`,SUM(`51`)+SUM(`b1`)/10+SUM(`a5`)/10 AS `51`,SUM(`52`)+SUM(`b2`)/10+SUM(`a5`)/10 AS `52`,SUM(`53`)+SUM(`b3`)/10+SUM(`a5`)/10 AS `53`,SUM(`54`)+SUM(`b4`)/10+SUM(`a5`)/10 AS `54`,SUM(`55`)+SUM(`b5`)/10+SUM(`a5`)/10 AS `55`,SUM(`56`)+SUM(`b6`)/10+SUM(`a5`)/10 AS `56`,SUM(`57`)+SUM(`b7`)/10+SUM(`a5`)/10 AS `57`,SUM(`58`)+SUM(`b8`)/10+SUM(`a5`)/10 AS `58`,SUM(`59`)+SUM(`b9`)/10+SUM(`a5`)/10 AS `59`,SUM(`60`)+SUM(`b0`)/10+SUM(`a6`)/10 AS `60`,SUM(`61`)+SUM(`b1`)/10+SUM(`a6`)/10 AS `61`,SUM(`62`)+SUM(`b2`)/10+SUM(`a6`)/10 AS `62`,SUM(`63`)+SUM(`b3`)/10+SUM(`a6`)/10 AS `63`,SUM(`64`)+SUM(`b4`)/10+SUM(`a6`)/10 AS `64`,SUM(`65`)+SUM(`b5`)/10+SUM(`a6`)/10 AS `65`,SUM(`66`)+SUM(`b6`)/10+SUM(`a6`)/10 AS `66`,SUM(`67`)+SUM(`b7`)/10+SUM(`a6`)/10 AS `67`,SUM(`68`)+SUM(`b8`)/10+SUM(`a6`)/10 AS `68`,SUM(`69`)+SUM(`b9`)/10+SUM(`a6`)/10 AS `69`,SUM(`70`)+SUM(`b0`)/10+SUM(`a7`)/10 AS `70`,SUM(`71`)+SUM(`b1`)/10+SUM(`a7`)/10 AS `71`,SUM(`72`)+SUM(`b2`)/10+SUM(`a7`)/10 AS `72`,SUM(`73`)+SUM(`b3`)/10+SUM(`a7`)/10 AS `73`,SUM(`74`)+SUM(`b4`)/10+SUM(`a7`)/10 AS `74`,SUM(`75`)+SUM(`b5`)/10+SUM(`a7`)/10 AS `75`,SUM(`76`)+SUM(`b6`)/10+SUM(`a7`)/10 AS `76`,SUM(`77`)+SUM(`b7`)/10+SUM(`a7`)/10 AS `77`,SUM(`78`)+SUM(`b8`)/10+SUM(`a7`)/10 AS `78`,SUM(`79`)+SUM(`b9`)/10+SUM(`a7`)/10 AS `79`,SUM(`80`)+SUM(`b0`)/10+SUM(`a8`)/10 AS `80`,SUM(`81`)+SUM(`b1`)/10+SUM(`a8`)/10 AS `81`,SUM(`82`)+SUM(`b2`)/10+SUM(`a8`)/10 AS `82`,SUM(`83`)+SUM(`b3`)/10+SUM(`a8`)/10 AS `83`,SUM(`84`)+SUM(`b4`)/10+SUM(`a8`)/10 AS `84`,SUM(`85`)+SUM(`b5`)/10+SUM(`a8`)/10 AS `85`,SUM(`86`)+SUM(`b6`)/10+SUM(`a8`)/10 AS `86`,SUM(`87`)+SUM(`b7`)/10+SUM(`a8`)/10 AS `87`,SUM(`88`)+SUM(`b8`)/10+SUM(`a8`)/10 AS `88`,SUM(`89`)+SUM(`b9`)/10+SUM(`a8`)/10 AS `89`,SUM(`90`)+SUM(`b0`)/10+SUM(`a9`)/10 AS `90`,SUM(`91`)+SUM(`b1`)/10+SUM(`a9`)/10 AS `91`,SUM(`92`)+SUM(`b2`)/10+SUM(`a9`)/10 AS `92`,SUM(`93`)+SUM(`b3`)/10+SUM(`a9`)/10 AS `93`,SUM(`94`)+SUM(`b4`)/10+SUM(`a9`)/10 AS `94`,SUM(`95`)+SUM(`b5`)/10+SUM(`a9`)/10 AS `95`,SUM(`96`)+SUM(`b6`)/10+SUM(`a9`)/10 AS `96`,SUM(`97`)+SUM(`b7`)/10+SUM(`a9`)/10 AS `97`,SUM(`98`)+SUM(`b8`)/10+SUM(`a9`)/10 AS `98`,SUM(`99`)+SUM(`b9`)/10+SUM(`a9`)/10 AS `99`,SUM(`100`)+SUM(`b0`)/10+SUM(`a0`)/10 AS `100`');
define('NORMAL_SHEET_DATA','SUM(`1`) as `1`,SUM(`2`) as `2`,SUM(`3`) as `3`,SUM(`4`) as `4`,SUM(`5`) as `5`,SUM(`6`) as `6`,SUM(`7`) as `7`,SUM(`8`) as `8`,SUM(`9`) as `9`,SUM(`10`) as `10`,SUM(`11`) as `11`,SUM(`12`) as `12`,SUM(`13`) as `13`,SUM(`14`) as `14`,SUM(`15`) as `15`,SUM(`16`) as `16`,SUM(`17`) as `17`,SUM(`18`) as `18`,SUM(`19`) as `19`,SUM(`20`) as `20`,SUM(`21`) as `21`,SUM(`22`) as `22`,SUM(`23`) as `23`,SUM(`24`) as `24`,SUM(`25`) as `25`,SUM(`26`) as `26`,SUM(`27`) as `27`,SUM(`28`) as `28`,SUM(`29`) as `29`,SUM(`30`) as `30`,SUM(`31`) as `31`,SUM(`32`) as `32`,SUM(`33`) as `33`,SUM(`34`) as `34`,SUM(`35`) as `35`,SUM(`36`) as `36`,SUM(`37`) as `37`,SUM(`38`) as `38`,SUM(`39`) as `39`,SUM(`40`) as `40`,SUM(`41`) as `41`,SUM(`42`) as `42`,SUM(`43`) as `43`,SUM(`44`) as `44`,SUM(`45`) as `45`,SUM(`46`) as `46`,SUM(`47`) as `47`,SUM(`48`) as `48`,SUM(`49`) as `49`,SUM(`50`) as `50`,SUM(`51`) as `51`,SUM(`52`) as `52`,SUM(`53`) as `53`,SUM(`54`) as `54`,SUM(`55`) as `55`,SUM(`56`) as `56`,SUM(`57`) as `57`,SUM(`58`) as `58`,SUM(`59`) as `59`,SUM(`60`) as `60`,SUM(`61`) as `61`,SUM(`62`) as `62`,SUM(`63`) as `63`,SUM(`64`) as `64`,SUM(`65`) as `65`,SUM(`66`) as `66`,SUM(`67`) as `67`,SUM(`68`) as `68`,SUM(`69`) as `69`,SUM(`70`) as `70`,SUM(`71`) as `71`,SUM(`72`) as `72`,SUM(`73`) as `73`,SUM(`74`) as `74`,SUM(`75`) as `75`,SUM(`76`) as `76`,SUM(`77`) as `77`,SUM(`78`) as `78`,SUM(`79`) as `79`,SUM(`80`) as `80`,SUM(`81`) as `81`,SUM(`82`) as `82`,SUM(`83`) as `83`,SUM(`84`) as `84`,SUM(`85`) as `85`,SUM(`86`) as `86`,SUM(`87`) as `87`,SUM(`88`) as `88`,SUM(`89`) as `89`,SUM(`90`) as `90`,SUM(`91`) as `91`,SUM(`92`) as `92`,SUM(`93`) as `93`,SUM(`94`) as `94`,SUM(`95`) as `95`,SUM(`96`) as `96`,SUM(`97`) as `97`,SUM(`98`) as `98`,SUM(`99`) as `99`,SUM(`100`) as `100`,SUM(`a0`) as `a0`,SUM(`a1`) as `a1`,SUM(`a2`) as `a2`,SUM(`a3`) as `a3`,SUM(`a4`) as `a4`,SUM(`a5`) as `a5`,SUM(`a6`) as `a6`,SUM(`a7`) as `a7`,SUM(`a8`) as `a8`,SUM(`a9`) as `a9`,SUM(`b0`) as `b0`,SUM(`b1`) as `b1`,SUM(`b2`) as `b2`,SUM(`b3`) as `b3`,SUM(`b4`) as `b4`,SUM(`b5`) as `b5`,SUM(`b6`) as `b6`,SUM(`b7`) as `b7`,SUM(`b8`) as `b8`, SUM(`b9`) as `b9`');
define('GET_COLUMN_SUM','SUM(`1`)+SUM(`2`)+SUM(`3`)+SUM(`4`)+SUM(`5`)+SUM(`6`)+SUM(`7`)+SUM(`8`)+SUM(`9`)+SUM(`10`) AS `1-10`,SUM(`11`)+SUM(`12`)+SUM(`13`)+SUM(`14`)+SUM(`15`)+SUM(`16`)+SUM(`17`)+SUM(`18`)+SUM(`19`)+SUM(`20`) AS `11-20`,SUM(`21`)+SUM(`22`)+SUM(`23`)+SUM(`24`)+SUM(`25`)+SUM(`26`)+SUM(`27`)+SUM(`28`)+SUM(`29`)+SUM(`30`) AS `21-30`,SUM(`31`)+SUM(`32`)+SUM(`33`)+SUM(`34`)+SUM(`35`)+SUM(`36`)+SUM(`37`)+SUM(`38`)+SUM(`39`)+SUM(`40`) AS `31-40`,SUM(`41`)+SUM(`42`)+SUM(`43`)+SUM(`44`)+SUM(`45`)+SUM(`46`)+SUM(`47`)+SUM(`48`)+SUM(`49`)+SUM(`50`) AS `41-50`,SUM(`51`)+SUM(`52`)+SUM(`53`)+SUM(`54`)+SUM(`55`)+SUM(`56`)+SUM(`57`)+SUM(`58`)+SUM(`59`)+SUM(`60`) AS `51-60`,SUM(`61`)+SUM(`62`)+SUM(`63`)+SUM(`64`)+SUM(`65`)+SUM(`66`)+SUM(`67`)+SUM(`68`)+SUM(`69`)+SUM(`70`) AS `61-70`,SUM(`71`)+SUM(`72`)+SUM(`73`)+SUM(`74`)+SUM(`75`)+SUM(`76`)+SUM(`77`)+SUM(`78`)+SUM(`79`)+SUM(`80`) AS `71-80`,SUM(`81`)+SUM(`82`)+SUM(`83`)+SUM(`84`)+SUM(`85`)+SUM(`86`)+SUM(`87`)+SUM(`88`)+SUM(`89`)+SUM(`90`) AS `81-90`,SUM(`91`)+SUM(`92`)+SUM(`93`)+SUM(`94`)+SUM(`95`)+SUM(`96`)+SUM(`97`)+SUM(`98`)+SUM(`99`)+SUM(`100`) AS `91-100`,SUM(`a0`)+SUM(`a1`)+SUM(`a2`)+SUM(`a3`)+SUM(`a4`)+SUM(`a5`)+SUM(`a6`)+SUM(`a7`)+SUM(`a8`)+SUM(`a9`) AS `a0-a9`,SUM(`b0`)+SUM(`b1`)+SUM(`b2`)+SUM(`b3`)+SUM(`b4`)+SUM(`b5`)+SUM(`b6`)+SUM(`b7`)+SUM(`b8`)+SUM(`b9`) AS `b0-b9`,SUM(`1`)+SUM(`2`)+SUM(`3`)+SUM(`4`)+SUM(`5`)+SUM(`6`)+SUM(`7`)+SUM(`8`)+SUM(`9`)+SUM(`10`)+SUM(`11`)+SUM(`12`)+SUM(`13`)+SUM(`14`)+SUM(`15`)+SUM(`16`)+SUM(`17`)+SUM(`18`)+SUM(`19`)+SUM(`20`)+SUM(`21`)+SUM(`22`)+SUM(`23`)+SUM(`24`)+SUM(`25`)+SUM(`26`)+SUM(`27`)+SUM(`28`)+SUM(`29`)+SUM(`30`)+SUM(`31`)+SUM(`32`)+SUM(`33`)+SUM(`34`)+SUM(`35`)+SUM(`36`)+SUM(`37`)+SUM(`38`)+SUM(`39`)+SUM(`40`)+SUM(`41`)+SUM(`42`)+SUM(`43`)+SUM(`44`)+SUM(`45`)+SUM(`46`)+SUM(`47`)+SUM(`48`)+SUM(`49`)+SUM(`50`)+SUM(`51`)+SUM(`52`)+SUM(`53`)+SUM(`54`)+SUM(`55`)+SUM(`56`)+SUM(`57`)+SUM(`58`)+SUM(`59`)+SUM(`60`)+SUM(`61`)+SUM(`62`)+SUM(`63`)+SUM(`64`)+SUM(`65`)+SUM(`66`)+SUM(`67`)+SUM(`68`)+SUM(`69`)+SUM(`70`)+SUM(`71`)+SUM(`72`)+SUM(`73`)+SUM(`74`)+SUM(`75`)+SUM(`76`)+SUM(`77`)+SUM(`78`)+SUM(`79`)+SUM(`80`)+SUM(`81`)+SUM(`82`)+SUM(`83`)+SUM(`84`)+SUM(`85`)+SUM(`86`)+SUM(`87`)+SUM(`88`)+SUM(`89`)+SUM(`90`)+SUM(`91`)+SUM(`92`)+SUM(`93`)+SUM(`94`)+SUM(`95`)+SUM(`96`)+SUM(`97`)+SUM(`98`)+SUM(`99`)+SUM(`100`)+SUM(`a0`)+SUM(`a1`)+SUM(`a2`)+SUM(`a3`)+SUM(`a4`)+SUM(`a5`)+SUM(`a6`)+SUM(`a7`)+SUM(`a8`)+SUM(`a9`)+SUM(`b0`)+SUM(`b1`)+SUM(`b2`)+SUM(`b3`)+SUM(`b4`)+SUM(`b5`)+SUM(`b6`)+SUM(`b7`)+SUM(`b8`)+SUM(`b9`) AS `total_bet`');
define('SHEET1','01,21,41,61,81,A0,02,22,42,62,82,A1,03,23,43,63,83,A2,04,24,44,64,84,A3,05,25,45,65,85,A4,06,26,46,66,86,A5,07,27,47,67,87,A6,08,28,48,68,88,A7,09,29,49,69,89,A8,10,30,50,70,90,A9,11,31,51,71,91,B0,12,32,52,72,92,B1,13,33,53,73,93,B2,14,34,54,74,94,B3,15,35,55,75,95,B4,16,36,56,76,96,B5,17,37,57,77,97,B6,18,38,58,78,98,B7,19,39,59,79,99,B8,20,40,60,80,100,B9');
define('SHEET2','01,03,05,07,09,A0,11,13,15,17,19,A1,21,23,25,27,29,A2,31,33,35,37,39,A3,41,43,45,47,49,A4,51,53,55,57,59,A5,61,63,65,67,69,A6,71,73,75,77,79,A7,81,83,85,87,89,A8,91,93,95,97,99,A9,02,04,06,08,10,B0,12,14,16,18,20,B1,22,24,26,28,30,B2,32,34,36,38,40,B3,42,44,46,48,50,B4,52,54,56,58,60,B5,62,64,66,68,70,B6,72,74,76,78,80,B7,82,84,86,88,90,B8,92,94,96,98,100,B9');

// Create a new DateTime object with the current time in UTC
$date = new DateTime('now', new DateTimeZone('UTC'));

// Format the $date object to the desired format (e.g., Y-m-d H:i:s)
$date = $date->format('Y-m-d');

// Clone the $date object to create a new DateTime object for IST

$datetime = new DateTime('now',new DateTimeZone('Asia/Kolkata')); // Set timezone to IST

// Format the $datetime object to the desired format
$time = $datetime->format('Y-m-d H:i:s');
$datetime = $time;

function roundUpIfAbovePoint01($value) {
    // Check if the decimal part is greater than 0.01
    if ($value - floor($value) > 0.01) {
        return ceil($value); // Round up to the next whole number
    } else {
        return floor($value); // Keep the integer part as is
    }
}

function roundUpToNearest5($value) {
    return ceil($value / 5) * 5;
}

function rounding_the_values($array, $value) {
    if($value == ""){
        return $array;
    }else if($value == 1){
        foreach ($array as $key => $val) {
            $array[$key] = roundUpIfAbovePoint01($val);
        }
        return $array;
    }else if($value == 5){
        foreach ($array as $key => $val) {
            $array[$key] = roundUpToNearest5($val);
        }
        return $array;
    }
}

function trimDecimal($value) {
    $value = preg_replace('/\.00$/', '', $value);
    if($value == 0){
        return '';
    }else{
        return $value;
    }
}

function format_decimal($value, $decimals = 2) {
    // Convert the value to a float and format it
    $formatted = number_format((float)$value, $decimals, '.', '');

    // Check if the formatted value ends with .00N
    if (strpos($formatted, '.' . str_repeat('0', $decimals)) !== false) {
        // Remove the .00 part and return the integer part
        return (int)$formatted;
    }

    // Return the formatted value if it has decimal parts
    return $formatted;
}

function main_clon_array(){
    $final_array = array();
    // Add keys from 0 to 100 with value 0
    for ($i = 1; $i <= 100; $i++) {
        $final_array[$i] = 0;
    }

    // Add keys from a0 to a9 with value 0
    for ($i = 0; $i <= 9; $i++) {
        $final_array['a' . $i] = 0;
    }

    // Add keys from b0 to b9 with value 0
    for ($i = 0; $i <= 9; $i++) {
        $final_array['b' . $i] = 0;
    }

    return $final_array;
}

function sheet($row){
    if(is_array($row)){
        $row['1'] = isset($row['01']) && $row['01'] > 0 ? $row['01'] : $row['1'];
        $row['2'] = isset($row['02']) && $row['02'] > 0 ? $row['02'] : $row['2'];
        $row['3'] = isset($row['03']) && $row['03'] > 0 ? $row['03'] : $row['3'];
        $row['4'] = isset($row['04']) && $row['04'] > 0 ? $row['04'] : $row['4'];
        $row['5'] = isset($row['05']) && $row['05'] > 0 ? $row['05'] : $row['5'];
        $row['6'] = isset($row['06']) && $row['06'] > 0 ? $row['06'] : $row['6'];
        $row['7'] = isset($row['07']) && $row['07'] > 0 ? $row['07'] : $row['7'];
        $row['8'] = isset($row['08']) && $row['08'] > 0 ? $row['08'] : $row['8'];
        $row['9'] = isset($row['09']) && $row['09'] > 0 ? $row['09'] : $row['9'];
        return 
        '<tr>
            <td>01</td>
            <td>'.trimDecimal($row['1']).'</td>
            <td>21</td>
            <td>'.trimDecimal($row['21']).'</td>
            <td>41</td>
            <td>'.trimDecimal($row['41']).'</td>
            <td>61</td>
            <td>'.trimDecimal($row['61']).'</td>
            <td>81</td>
            <td>'.trimDecimal($row['81']).'</td>
            <td>A0</td>
            <td>'.trimDecimal($row['a0']).'</td>
        </tr>
        <tr>
            <td>02</td>
            <td>'.trimDecimal($row['2']).'</td>
            <td>22</td>
            <td>'.trimDecimal($row['22']).'</td>
            <td>42</td>
            <td>'.trimDecimal($row['42']).'</td>
            <td>62</td>
            <td>'.trimDecimal($row['62']).'</td>
            <td>82</td>
            <td>'.trimDecimal($row['82']).'</td>
            <td>A1</td>
            <td>'.trimDecimal($row['a1']).'</td>
        </tr>
        <tr>
            <td>03</td>
            <td>'.trimDecimal($row['3']).'</td>
            <td>23</td>
            <td>'.trimDecimal($row['23']).'</td>
            <td>43</td>
            <td>'.trimDecimal($row['43']).'</td>
            <td>63</td>
            <td>'.trimDecimal($row['63']).'</td>
            <td>83</td>
            <td>'.trimDecimal($row['83']).'</td>
            <td>A2</td>
            <td>'.trimDecimal($row['a2']).'</td>
        </tr>
        <tr>
            <td>04</td>
            <td>'.trimDecimal($row['4']).'</td>
            <td>24</td>
            <td>'.trimDecimal($row['24']).'</td>
            <td>44</td>
            <td>'.trimDecimal($row['44']).'</td>
            <td>64</td>
            <td>'.trimDecimal($row['64']).'</td>
            <td>84</td>
            <td>'.trimDecimal($row['84']).'</td>
            <td>A3</td>
            <td>'.trimDecimal($row['a3']).'</td>
        </tr>
        <tr>
            <td>05</td>
            <td>'.trimDecimal($row['5']).'</td>
            <td>25</td>
            <td>'.trimDecimal($row['25']).'</td>
            <td>45</td>
            <td>'.trimDecimal($row['45']).'</td>
            <td>65</td>
            <td>'.trimDecimal($row['65']).'</td>
            <td>85</td>
            <td>'.trimDecimal($row['85']).'</td>
            <td>A4</td>
            <td>'.trimDecimal($row['a4']).'</td>
        </tr>
        <tr>
            <td>06</td>
            <td>'.trimDecimal($row['6']).'</td>
            <td>26</td>
            <td>'.trimDecimal($row['26']).'</td>
            <td>46</td>
            <td>'.trimDecimal($row['46']).'</td>
            <td>66</td>
            <td>'.trimDecimal($row['66']).'</td>
            <td>86</td>
            <td>'.trimDecimal($row['86']).'</td>
            <td>A5</td>
            <td>'.trimDecimal($row['a5']).'</td>
        </tr>
        <tr>
            <td>07</td>
            <td>'.trimDecimal($row['7']).'</td>
            <td>27</td>
            <td>'.trimDecimal($row['27']).'</td>
            <td>47</td>
            <td>'.trimDecimal($row['47']).'</td>
            <td>67</td>
            <td>'.trimDecimal($row['67']).'</td>
            <td>87</td>
            <td>'.trimDecimal($row['87']).'</td>
            <td>A6</td>
            <td>'.trimDecimal($row['a6']).'</td>
        </tr>
        <tr>
            <td>08</td>
            <td>'.trimDecimal($row['8']).'</td>
            <td>28</td>
            <td>'.trimDecimal($row['28']).'</td>
            <td>48</td>
            <td>'.trimDecimal($row['48']).'</td>
            <td>68</td>
            <td>'.trimDecimal($row['68']).'</td>
            <td>88</td>
            <td>'.trimDecimal($row['88']).'</td>
            <td>A7</td>
            <td>'.trimDecimal($row['a7']).'</td>
        </tr>
        <tr>
            <td>09</td>
            <td>'.trimDecimal($row['9']).'</td>
            <td>29</td>
            <td>'.trimDecimal($row['29']).'</td>
            <td>49</td>
            <td>'.trimDecimal($row['49']).'</td>
            <td>69</td>
            <td>'.trimDecimal($row['69']).'</td>
            <td>89</td>
            <td>'.trimDecimal($row['89']).'</td>
            <td>A8</td>
            <td>'.trimDecimal($row['a8']).'</td>
        </tr>
        <tr>
            <td>10</td>
            <td>'.trimDecimal($row['10']).'</td>
            <td>30</td>
            <td>'.trimDecimal($row['30']).'</td>
            <td>50</td>
            <td>'.trimDecimal($row['50']).'</td>
            <td>70</td>
            <td>'.trimDecimal($row['70']).'</td>
            <td>90</td>
            <td>'.trimDecimal($row['90']).'</td>
            <td>A9</td>
            <td>'.trimDecimal($row['a9']).'</td>
        </tr>
        <tr>
            <td>11</td>
            <td>'.trimDecimal($row['11']).'</td>
            <td>31</td>
            <td>'.trimDecimal($row['31']).'</td>
            <td>51</td>
            <td>'.trimDecimal($row['51']).'</td>
            <td>71</td>
            <td>'.trimDecimal($row['71']).'</td>
            <td>91</td>
            <td>'.trimDecimal($row['91']).'</td>
            <td>B0</td>
            <td>'.trimDecimal($row['b0']).'</td>
        </tr>
        <tr>
            <td>12</td>
            <td>'.trimDecimal($row['12']).'</td>
            <td>32</td>
            <td>'.trimDecimal($row['32']).'</td>
            <td>52</td>
            <td>'.trimDecimal($row['52']).'</td>
            <td>72</td>
            <td>'.trimDecimal($row['72']).'</td>
            <td>92</td>
            <td>'.trimDecimal($row['92']).'</td>
            <td>B1</td>
            <td>'.trimDecimal($row['b1']).'</td>
        </tr>
        <tr>
            <td>13</td>
            <td>'.trimDecimal($row['13']).'</td>
            <td>33</td>
            <td>'.trimDecimal($row['33']).'</td>
            <td>53</td>
            <td>'.trimDecimal($row['53']).'</td>
            <td>73</td>
            <td>'.trimDecimal($row['73']).'</td>
            <td>93</td>
            <td>'.trimDecimal($row['93']).'</td>
            <td>B2</td>
            <td>'.trimDecimal($row['b2']).'</td>
        </tr>
        <tr>
            <td>14</td>
            <td>'.trimDecimal($row['14']).'</td>
            <td>34</td>
            <td>'.trimDecimal($row['34']).'</td>
            <td>54</td>
            <td>'.trimDecimal($row['54']).'</td>
            <td>74</td>
            <td>'.trimDecimal($row['74']).'</td>
            <td>94</td>
            <td>'.trimDecimal($row['94']).'</td>
            <td>B3</td>
            <td>'.trimDecimal($row['b3']).'</td>
        </tr>
        <tr>
            <td>15</td>
            <td>'.trimDecimal($row['15']).'</td>
            <td>35</td>
            <td>'.trimDecimal($row['35']).'</td>
            <td>55</td>
            <td>'.trimDecimal($row['55']).'</td>
            <td>75</td>
            <td>'.trimDecimal($row['75']).'</td>
            <td>95</td>
            <td>'.trimDecimal($row['95']).'</td>
            <td>B4</td>
            <td>'.trimDecimal($row['b4']).'</td>
        </tr>
        <tr>
            <td>16</td>
            <td>'.trimDecimal($row['16']).'</td>
            <td>36</td>
            <td>'.trimDecimal($row['36']).'</td>
            <td>56</td>
            <td>'.trimDecimal($row['56']).'</td>
            <td>76</td>
            <td>'.trimDecimal($row['76']).'</td>
            <td>96</td>
            <td>'.trimDecimal($row['96']).'</td>
            <td>B5</td>
            <td>'.trimDecimal($row['b5']).'</td>
        </tr>
        <tr>
            <td>17</td>
            <td>'.trimDecimal($row['17']).'</td>
            <td>37</td>
            <td>'.trimDecimal($row['37']).'</td>
            <td>57</td>
            <td>'.trimDecimal($row['57']).'</td>
            <td>77</td>
            <td>'.trimDecimal($row['77']).'</td>
            <td>97</td>
            <td>'.trimDecimal($row['97']).'</td>
            <td>B6</td>
            <td>'.trimDecimal($row['b6']).'</td>
        </tr>
        <tr>
            <td>18</td>
            <td>'.trimDecimal($row['18']).'</td>
            <td>38</td>
            <td>'.trimDecimal($row['38']).'</td>
            <td>58</td>
            <td>'.trimDecimal($row['58']).'</td>
            <td>78</td>
            <td>'.trimDecimal($row['78']).'</td>
            <td>98</td>
            <td>'.trimDecimal($row['98']).'</td>
            <td>B7</td>
            <td>'.trimDecimal($row['b7']).'</td>
        </tr>
        <tr>
            <td>19</td>
            <td>'.trimDecimal($row['19']).'</td>
            <td>39</td>
            <td>'.trimDecimal($row['39']).'</td>
            <td>59</td>
            <td>'.trimDecimal($row['59']).'</td>
            <td>79</td>
            <td>'.trimDecimal($row['79']).'</td>
            <td>99</td>
            <td>'.trimDecimal($row['99']).'</td>
            <td>B8</td>
            <td>'.trimDecimal($row['b8']).'</td>
        </tr>
        <tr>
            <td>20</td>
            <td>'.trimDecimal($row['20']).'</td>
            <td>40</td>
            <td>'.trimDecimal($row['40']).'</td>
            <td>60</td>
            <td>'.trimDecimal($row['60']).'</td>
            <td>80</td>
            <td>'.trimDecimal($row['80']).'</td>
            <td>100</td>
            <td>'.trimDecimal($row['100']).'</td>
            <td>B9</td>
            <td>'.trimDecimal($row['b9']).'</td>
        </tr>'; 
    }else{
        return '<tr>
        <td>01</td>
        <td>0</td>
        <td>21</td>
        <td>0</td>
        <td>41</td>
        <td>0</td>
        <td>61</td>
        <td>0</td>
        <td>81</td>
        <td>0</td>
        <td>A0</td>
        <td>0</td>
    </tr>
    <tr>
        <td>02</td>
        <td>0</td>
        <td>22</td>
        <td>0</td>
        <td>42</td>
        <td>0</td>
        <td>62</td>
        <td>0</td>
        <td>82</td>
        <td>0</td>
        <td>A1</td>
        <td>0</td>
    </tr>
    <tr>
        <td>03</td>
        <td>0</td>
        <td>23</td>
        <td>0</td>
        <td>43</td>
        <td>0</td>
        <td>63</td>
        <td>0</td>
        <td>83</td>
        <td>0</td>
        <td>A2</td>
        <td>0</td>
    </tr>
    <tr>
        <td>04</td>
        <td>0</td>
        <td>24</td>
        <td>0</td>
        <td>44</td>
        <td>0</td>
        <td>64</td>
        <td>0</td>
        <td>84</td>
        <td>0</td>
        <td>A3</td>
        <td>0</td>
    </tr>
    <tr>
        <td>05</td>
        <td>0</td>
        <td>25</td>
        <td>0</td>
        <td>45</td>
        <td>0</td>
        <td>65</td>
        <td>0</td>
        <td>85</td>
        <td>0</td>
        <td>A4</td>
        <td>0</td>
    </tr>
    <tr>
        <td>06</td>
        <td>0</td>
        <td>26</td>
        <td>0</td>
        <td>46</td>
        <td>0</td>
        <td>66</td>
        <td>0</td>
        <td>86</td>
        <td>0</td>
        <td>A5</td>
        <td>0</td>
    </tr>
    <tr>
        <td>07</td>
        <td>0</td>
        <td>27</td>
        <td>0</td>
        <td>47</td>
        <td>0</td>
        <td>67</td>
        <td>0</td>
        <td>87</td>
        <td>0</td>
        <td>A6</td>
        <td>0</td>
    </tr>
    <tr>
        <td>08</td>
        <td>0</td>
        <td>28</td>
        <td>0</td>
        <td>48</td>
        <td>0</td>
        <td>68</td>
        <td>0</td>
        <td>88</td>
        <td>0</td>
        <td>A7</td>
        <td>0</td>
    </tr>
    <tr>
        <td>09</td>
        <td>0</td>
        <td>29</td>
        <td>0</td>
        <td>49</td>
        <td>0</td>
        <td>69</td>
        <td>0</td>
        <td>89</td>
        <td>0</td>
        <td>A8</td>
        <td>0</td>
    </tr>
    <tr>
        <td>10</td>
        <td>0</td>
        <td>30</td>
        <td>0</td>
        <td>50</td>
        <td>0</td>
        <td>70</td>
        <td>0</td>
        <td>90</td>
        <td>0</td>
        <td>A9</td>
        <td>0</td>
    </tr>
    <tr>
        <td>11</td>
        <td>0</td>
        <td>31</td>
        <td>0</td>
        <td>51</td>
        <td>0</td>
        <td>71</td>
        <td>0</td>
        <td>91</td>
        <td>0</td>
        <td>B0</td>
        <td>0</td>
    </tr>
    <tr>
        <td>12</td>
        <td>0</td>
        <td>32</td>
        <td>0</td>
        <td>52</td>
        <td>0</td>
        <td>72</td>
        <td>0</td>
        <td>92</td>
        <td>0</td>
        <td>B1</td>
        <td>0</td>
    </tr>
    <tr>
        <td>13</td>
        <td>0</td>
        <td>33</td>
        <td>0</td>
        <td>53</td>
        <td>0</td>
        <td>73</td>
        <td>0</td>
        <td>93</td>
        <td>0</td>
        <td>B2</td>
        <td>0</td>
    </tr>
    <tr>
        <td>14</td>
        <td>0</td>
        <td>34</td>
        <td>0</td>
        <td>54</td>
        <td>0</td>
        <td>74</td>
        <td>0</td>
        <td>94</td>
        <td>0</td>
        <td>B3</td>
        <td>0</td>
    </tr>
    <tr>
        <td>15</td>
        <td>0</td>
        <td>35</td>
        <td>0</td>
        <td>55</td>
        <td>0</td>
        <td>75</td>
        <td>0</td>
        <td>95</td>
        <td>0</td>
        <td>B4</td>
        <td>0</td>
    </tr>
    <tr>
        <td>16</td>
        <td>0</td>
        <td>36</td>
        <td>0</td>
        <td>56</td>
        <td>0</td>
        <td>76</td>
        <td>0</td>
        <td>96</td>
        <td>0</td>
        <td>B5</td>
        <td>0</td>
    </tr>
    <tr>
        <td>17</td>
        <td>0</td>
        <td>37</td>
        <td>0</td>
        <td>57</td>
        <td>0</td>
        <td>77</td>
        <td>0</td>
        <td>97</td>
        <td>0</td>
        <td>B6</td>
        <td>0</td>
    </tr>
    <tr>
        <td>18</td>
        <td>0</td>
        <td>38</td>
        <td>0</td>
        <td>58</td>
        <td>0</td>
        <td>78</td>
        <td>0</td>
        <td>98</td>
        <td>0</td>
        <td>B7</td>
        <td>0</td>
    </tr>
    <tr>
        <td>19</td>
        <td>0</td>
        <td>39</td>
        <td>0</td>
        <td>59</td>
        <td>0</td>
        <td>79</td>
        <td>0</td>
        <td>99</td>
        <td>0</td>
        <td>B8</td>
        <td>0</td>
    </tr>
    <tr>
        <td>20</td>
        <td>0</td>
        <td>40</td>
        <td>0</td>
        <td>60</td>
        <td>0</td>
        <td>80</td>
        <td>0</td>
        <td>100</td>
        <td>0</td>
        <td>B9</td>
        <td>0</td>
    </tr>';   
    }
}

function final_sheet($row){
    $row['1'] = isset($row['01']) && $row['01'] > 0 ? $row['01'] : $row['1'];
    $row['2'] = isset($row['02']) && $row['02'] > 0 ? $row['02'] : $row['2'];
    $row['3'] = isset($row['03']) && $row['03'] > 0 ? $row['03'] : $row['3'];
    $row['4'] = isset($row['04']) && $row['04'] > 0 ? $row['04'] : $row['4'];
    $row['5'] = isset($row['05']) && $row['05'] > 0 ? $row['05'] : $row['5'];
    $row['6'] = isset($row['06']) && $row['06'] > 0 ? $row['06'] : $row['6'];
    $row['7'] = isset($row['07']) && $row['07'] > 0 ? $row['07'] : $row['7'];
    $row['8'] = isset($row['08']) && $row['08'] > 0 ? $row['08'] : $row['8'];
    $row['9'] = isset($row['09']) && $row['09'] > 0 ? $row['09'] : $row['9'];
    if(is_array($row)){
        return 
        '<tr>
            <td>01</td>
            <td>'.trimDecimal(format_decimal($row['1'])).'</td>
            <td>21</td>
            <td>'.trimDecimal(format_decimal($row['21'])).'</td>
            <td>41</td>
            <td>'.trimDecimal(format_decimal($row['41'])).'</td>
            <td>61</td>
            <td>'.trimDecimal(format_decimal($row['61'])).'</td>
            <td>81</td>
            <td>'.trimDecimal(format_decimal($row['81'])).'</td>
            
            
        </tr>
        <tr>
            <td>02</td>
            <td>'.trimDecimal(format_decimal($row['2'])).'</td>
            <td>22</td>
            <td>'.trimDecimal(format_decimal($row['22'])).'</td>
            <td>42</td>
            <td>'.trimDecimal(format_decimal($row['42'])).'</td>
            <td>62</td>
            <td>'.trimDecimal(format_decimal($row['62'])).'</td>
            <td>82</td>
            <td>'.trimDecimal(format_decimal($row['82'])).'</td>
            
            
        </tr>
        <tr>
            <td>03</td>
            <td>'.trimDecimal(format_decimal($row['3'])).'</td>
            <td>23</td>
            <td>'.trimDecimal(format_decimal($row['23'])).'</td>
            <td>43</td>
            <td>'.trimDecimal(format_decimal($row['43'])).'</td>
            <td>63</td>
            <td>'.trimDecimal(format_decimal($row['63'])).'</td>
            <td>83</td>
            <td>'.trimDecimal(format_decimal($row['83'])).'</td>
            
            
        </tr>
        <tr>
            <td>04</td>
            <td>'.trimDecimal(format_decimal($row['4'])).'</td>
            <td>24</td>
            <td>'.trimDecimal(format_decimal($row['24'])).'</td>
            <td>44</td>
            <td>'.trimDecimal(format_decimal($row['44'])).'</td>
            <td>64</td>
            <td>'.trimDecimal(format_decimal($row['64'])).'</td>
            <td>84</td>
            <td>'.trimDecimal(format_decimal($row['84'])).'</td>
            
            
        </tr>
        <tr>
            <td>05</td>
            <td>'.trimDecimal(format_decimal($row['5'])).'</td>
            <td>25</td>
            <td>'.trimDecimal(format_decimal($row['25'])).'</td>
            <td>45</td>
            <td>'.trimDecimal(format_decimal($row['45'])).'</td>
            <td>65</td>
            <td>'.trimDecimal(format_decimal($row['65'])).'</td>
            <td>85</td>
            <td>'.trimDecimal(format_decimal($row['85'])).'</td>
            
            
        </tr>
        <tr>
            <td>06</td>
            <td>'.trimDecimal(format_decimal($row['6'])).'</td>
            <td>26</td>
            <td>'.trimDecimal(format_decimal($row['26'])).'</td>
            <td>46</td>
            <td>'.trimDecimal(format_decimal($row['46'])).'</td>
            <td>66</td>
            <td>'.trimDecimal(format_decimal($row['66'])).'</td>
            <td>86</td>
            <td>'.trimDecimal(format_decimal($row['86'])).'</td>
            
            
        </tr>
        <tr>
            <td>07</td>
            <td>'.trimDecimal(format_decimal($row['7'])).'</td>
            <td>27</td>
            <td>'.trimDecimal(format_decimal($row['27'])).'</td>
            <td>47</td>
            <td>'.trimDecimal(format_decimal($row['47'])).'</td>
            <td>67</td>
            <td>'.trimDecimal(format_decimal($row['67'])).'</td>
            <td>87</td>
            <td>'.trimDecimal(format_decimal($row['87'])).'</td>
            
            
        </tr>
        <tr>
            <td>08</td>
            <td>'.trimDecimal(format_decimal($row['8'])).'</td>
            <td>28</td>
            <td>'.trimDecimal(format_decimal($row['28'])).'</td>
            <td>48</td>
            <td>'.trimDecimal(format_decimal($row['48'])).'</td>
            <td>68</td>
            <td>'.trimDecimal(format_decimal($row['68'])).'</td>
            <td>88</td>
            <td>'.trimDecimal(format_decimal($row['88'])).'</td>
            
            
        </tr>
        <tr>
            <td>09</td>
            <td>'.trimDecimal(format_decimal($row['9'])).'</td>
            <td>29</td>
            <td>'.trimDecimal(format_decimal($row['29'])).'</td>
            <td>49</td>
            <td>'.trimDecimal(format_decimal($row['49'])).'</td>
            <td>69</td>
            <td>'.trimDecimal(format_decimal($row['69'])).'</td>
            <td>89</td>
            <td>'.trimDecimal(format_decimal($row['89'])).'</td>
            
            
        </tr>
        <tr>
            <td>10</td>
            <td>'.trimDecimal(format_decimal($row['10'])).'</td>
            <td>30</td>
            <td>'.trimDecimal(format_decimal($row['30'])).'</td>
            <td>50</td>
            <td>'.trimDecimal(format_decimal($row['50'])).'</td>
            <td>70</td>
            <td>'.trimDecimal(format_decimal($row['70'])).'</td>
            <td>90</td>
            <td>'.trimDecimal(format_decimal($row['90'])).'</td>
            
            
        </tr>
        <tr>
            <td>11</td>
            <td>'.trimDecimal(format_decimal($row['11'])).'</td>
            <td>31</td>
            <td>'.trimDecimal(format_decimal($row['31'])).'</td>
            <td>51</td>
            <td>'.trimDecimal(format_decimal($row['51'])).'</td>
            <td>71</td>
            <td>'.trimDecimal(format_decimal($row['71'])).'</td>
            <td>91</td>
            <td>'.trimDecimal(format_decimal($row['91'])).'</td>
            
            
        </tr>
        <tr>
            <td>12</td>
            <td>'.trimDecimal(format_decimal($row['12'])).'</td>
            <td>32</td>
            <td>'.trimDecimal(format_decimal($row['32'])).'</td>
            <td>52</td>
            <td>'.trimDecimal(format_decimal($row['52'])).'</td>
            <td>72</td>
            <td>'.trimDecimal(format_decimal($row['72'])).'</td>
            <td>92</td>
            <td>'.trimDecimal(format_decimal($row['92'])).'</td>
            
            
        </tr>
        <tr>
            <td>13</td>
            <td>'.trimDecimal(format_decimal($row['13'])).'</td>
            <td>33</td>
            <td>'.trimDecimal(format_decimal($row['33'])).'</td>
            <td>53</td>
            <td>'.trimDecimal(format_decimal($row['53'])).'</td>
            <td>73</td>
            <td>'.trimDecimal(format_decimal($row['73'])).'</td>
            <td>93</td>
            <td>'.trimDecimal(format_decimal($row['93'])).'</td>
            
            
        </tr>
        <tr>
            <td>14</td>
            <td>'.trimDecimal(format_decimal($row['14'])).'</td>
            <td>34</td>
            <td>'.trimDecimal(format_decimal($row['34'])).'</td>
            <td>54</td>
            <td>'.trimDecimal(format_decimal($row['54'])).'</td>
            <td>74</td>
            <td>'.trimDecimal(format_decimal($row['74'])).'</td>
            <td>94</td>
            <td>'.trimDecimal(format_decimal($row['94'])).'</td>
            
            
        </tr>
        <tr>
            <td>15</td>
            <td>'.trimDecimal(format_decimal($row['15'])).'</td>
            <td>35</td>
            <td>'.trimDecimal(format_decimal($row['35'])).'</td>
            <td>55</td>
            <td>'.trimDecimal(format_decimal($row['55'])).'</td>
            <td>75</td>
            <td>'.trimDecimal(format_decimal($row['75'])).'</td>
            <td>95</td>
            <td>'.trimDecimal(format_decimal($row['95'])).'</td>
            
            
        </tr>
        <tr>
            <td>16</td>
            <td>'.trimDecimal(format_decimal($row['16'])).'</td>
            <td>36</td>
            <td>'.trimDecimal(format_decimal($row['36'])).'</td>
            <td>56</td>
            <td>'.trimDecimal(format_decimal($row['56'])).'</td>
            <td>76</td>
            <td>'.trimDecimal(format_decimal($row['76'])).'</td>
            <td>96</td>
            <td>'.trimDecimal(format_decimal($row['96'])).'</td>
            
            
        </tr>
        <tr>
            <td>17</td>
            <td>'.trimDecimal(format_decimal($row['17'])).'</td>
            <td>37</td>
            <td>'.trimDecimal(format_decimal($row['37'])).'</td>
            <td>57</td>
            <td>'.trimDecimal(format_decimal($row['57'])).'</td>
            <td>77</td>
            <td>'.trimDecimal(format_decimal($row['77'])).'</td>
            <td>97</td>
            <td>'.trimDecimal(format_decimal($row['97'])).'</td>
            
            
        </tr>
        <tr>
            <td>18</td>
            <td>'.trimDecimal(format_decimal($row['18'])).'</td>
            <td>38</td>
            <td>'.trimDecimal(format_decimal($row['38'])).'</td>
            <td>58</td>
            <td>'.trimDecimal(format_decimal($row['58'])).'</td>
            <td>78</td>
            <td>'.trimDecimal(format_decimal($row['78'])).'</td>
            <td>98</td>
            <td>'.trimDecimal(format_decimal($row['98'])).'</td>
            
            
        </tr>
        <tr>
            <td>19</td>
            <td>'.trimDecimal(format_decimal($row['19'])).'</td>
            <td>39</td>
            <td>'.trimDecimal(format_decimal($row['39'])).'</td>
            <td>59</td>
            <td>'.trimDecimal(format_decimal($row['59'])).'</td>
            <td>79</td>
            <td>'.trimDecimal(format_decimal($row['79'])).'</td>
            <td>99</td>
            <td>'.trimDecimal(format_decimal($row['99'])).'</td>
            
            
        </tr>
        <tr>
            <td>20</td>
            <td>'.trimDecimal(format_decimal($row['20'])).'</td>
            <td>40</td>
            <td>'.trimDecimal(format_decimal($row['40'])).'</td>
            <td>60</td>
            <td>'.trimDecimal(format_decimal($row['60'])).'</td>
            <td>80</td>
            <td>'.trimDecimal(format_decimal($row['80'])).'</td>
            <td>100</td>
            <td>'.trimDecimal(format_decimal($row['100'])).'</td>
            
            
        </tr>'; 
    }else{
        return '<tr>
        <td>01</td>
        <td>0</td>
        <td>21</td>
        <td>0</td>
        <td>41</td>
        <td>0</td>
        <td>61</td>
        <td>0</td>
        <td>81</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>02</td>
        <td>0</td>
        <td>22</td>
        <td>0</td>
        <td>42</td>
        <td>0</td>
        <td>62</td>
        <td>0</td>
        <td>82</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>03</td>
        <td>0</td>
        <td>23</td>
        <td>0</td>
        <td>43</td>
        <td>0</td>
        <td>63</td>
        <td>0</td>
        <td>83</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>04</td>
        <td>0</td>
        <td>24</td>
        <td>0</td>
        <td>44</td>
        <td>0</td>
        <td>64</td>
        <td>0</td>
        <td>84</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>05</td>
        <td>0</td>
        <td>25</td>
        <td>0</td>
        <td>45</td>
        <td>0</td>
        <td>65</td>
        <td>0</td>
        <td>85</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>06</td>
        <td>0</td>
        <td>26</td>
        <td>0</td>
        <td>46</td>
        <td>0</td>
        <td>66</td>
        <td>0</td>
        <td>86</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>07</td>
        <td>0</td>
        <td>27</td>
        <td>0</td>
        <td>47</td>
        <td>0</td>
        <td>67</td>
        <td>0</td>
        <td>87</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>08</td>
        <td>0</td>
        <td>28</td>
        <td>0</td>
        <td>48</td>
        <td>0</td>
        <td>68</td>
        <td>0</td>
        <td>88</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>09</td>
        <td>0</td>
        <td>29</td>
        <td>0</td>
        <td>49</td>
        <td>0</td>
        <td>69</td>
        <td>0</td>
        <td>89</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>10</td>
        <td>0</td>
        <td>30</td>
        <td>0</td>
        <td>50</td>
        <td>0</td>
        <td>70</td>
        <td>0</td>
        <td>90</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>11</td>
        <td>0</td>
        <td>31</td>
        <td>0</td>
        <td>51</td>
        <td>0</td>
        <td>71</td>
        <td>0</td>
        <td>91</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>12</td>
        <td>0</td>
        <td>32</td>
        <td>0</td>
        <td>52</td>
        <td>0</td>
        <td>72</td>
        <td>0</td>
        <td>92</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>13</td>
        <td>0</td>
        <td>33</td>
        <td>0</td>
        <td>53</td>
        <td>0</td>
        <td>73</td>
        <td>0</td>
        <td>93</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>14</td>
        <td>0</td>
        <td>34</td>
        <td>0</td>
        <td>54</td>
        <td>0</td>
        <td>74</td>
        <td>0</td>
        <td>94</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>15</td>
        <td>0</td>
        <td>35</td>
        <td>0</td>
        <td>55</td>
        <td>0</td>
        <td>75</td>
        <td>0</td>
        <td>95</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>16</td>
        <td>0</td>
        <td>36</td>
        <td>0</td>
        <td>56</td>
        <td>0</td>
        <td>76</td>
        <td>0</td>
        <td>96</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>17</td>
        <td>0</td>
        <td>37</td>
        <td>0</td>
        <td>57</td>
        <td>0</td>
        <td>77</td>
        <td>0</td>
        <td>97</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>18</td>
        <td>0</td>
        <td>38</td>
        <td>0</td>
        <td>58</td>
        <td>0</td>
        <td>78</td>
        <td>0</td>
        <td>98</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>19</td>
        <td>0</td>
        <td>39</td>
        <td>0</td>
        <td>59</td>
        <td>0</td>
        <td>79</td>
        <td>0</td>
        <td>99</td>
        <td>0</td>
        
        
    </tr>
    <tr>
        <td>20</td>
        <td>0</td>
        <td>40</td>
        <td>0</td>
        <td>60</td>
        <td>0</td>
        <td>80</td>
        <td>0</td>
        <td>100</td>
        <td>0</td>
        
        
    </tr>';   
    }
}

function party_sheet($row){
    $row['1'] += isset($row['01']) && $row['01'] > 0 ? $row['01'] : 0;
    $row['2'] += isset($row['02']) && $row['02'] > 0 ? $row['02'] : 0;
    $row['3'] += isset($row['03']) && $row['03'] > 0 ? $row['03'] : 0;
    $row['4'] += isset($row['04']) && $row['04'] > 0 ? $row['04'] : 0;
    $row['5'] += isset($row['05']) && $row['05'] > 0 ? $row['05'] : 0;
    $row['6'] += isset($row['06']) && $row['06'] > 0 ? $row['06'] : 0;
    $row['7'] += isset($row['07']) && $row['07'] > 0 ? $row['07'] : 0;
    $row['8'] += isset($row['08']) && $row['08'] > 0 ? $row['08'] : 0;
    $row['9'] += isset($row['09']) && $row['09'] > 0 ? $row['09'] : 0;
    if(is_array($row)){
        return 
        '<tr>
            <td>01</td>
            <td>'.trimDecimal($row['1']).'</td>
            <td>21</td>
            <td>'.trimDecimal($row['21']).'</td>
            <td>41</td>
            <td>'.trimDecimal($row['41']).'</td>
            <td>61</td>
            <td>'.trimDecimal($row['61']).'</td>
            <td>81</td>
            <td>'.trimDecimal($row['81']).'</td>
            <td>A0</td>
            <td>'.trimDecimal($row['a0']).'</td>
        </tr>
        <tr>
            <td>02</td>
            <td>'.trimDecimal($row['2']).'</td>
            <td>22</td>
            <td>'.trimDecimal($row['22']).'</td>
            <td>42</td>
            <td>'.trimDecimal($row['42']).'</td>
            <td>62</td>
            <td>'.trimDecimal($row['62']).'</td>
            <td>82</td>
            <td>'.trimDecimal($row['82']).'</td>
            <td>A1</td>
            <td>'.trimDecimal($row['a1']).'</td>
        </tr>
        <tr>
            <td>03</td>
            <td>'.trimDecimal($row['3']).'</td>
            <td>23</td>
            <td>'.trimDecimal($row['23']).'</td>
            <td>43</td>
            <td>'.trimDecimal($row['43']).'</td>
            <td>63</td>
            <td>'.trimDecimal($row['63']).'</td>
            <td>83</td>
            <td>'.trimDecimal($row['83']).'</td>
            <td>A2</td>
            <td>'.trimDecimal($row['a2']).'</td>
        </tr>
        <tr>
            <td>04</td>
            <td>'.trimDecimal($row['4']).'</td>
            <td>24</td>
            <td>'.trimDecimal($row['24']).'</td>
            <td>44</td>
            <td>'.trimDecimal($row['44']).'</td>
            <td>64</td>
            <td>'.trimDecimal($row['64']).'</td>
            <td>84</td>
            <td>'.trimDecimal($row['84']).'</td>
            <td>A3</td>
            <td>'.trimDecimal($row['a3']).'</td>
        </tr>
        <tr>
            <td>05</td>
            <td>'.trimDecimal($row['5']).'</td>
            <td>25</td>
            <td>'.trimDecimal($row['25']).'</td>
            <td>45</td>
            <td>'.trimDecimal($row['45']).'</td>
            <td>65</td>
            <td>'.trimDecimal($row['65']).'</td>
            <td>85</td>
            <td>'.trimDecimal($row['85']).'</td>
            <td>A4</td>
            <td>'.trimDecimal($row['a4']).'</td>
        </tr>
        <tr>
            <td>06</td>
            <td>'.trimDecimal($row['6']).'</td>
            <td>26</td>
            <td>'.trimDecimal($row['26']).'</td>
            <td>46</td>
            <td>'.trimDecimal($row['46']).'</td>
            <td>66</td>
            <td>'.trimDecimal($row['66']).'</td>
            <td>86</td>
            <td>'.trimDecimal($row['86']).'</td>
            <td>A5</td>
            <td>'.trimDecimal($row['a5']).'</td>
        </tr>
        <tr>
            <td>07</td>
            <td>'.trimDecimal($row['7']).'</td>
            <td>27</td>
            <td>'.trimDecimal($row['27']).'</td>
            <td>47</td>
            <td>'.trimDecimal($row['47']).'</td>
            <td>67</td>
            <td>'.trimDecimal($row['67']).'</td>
            <td>87</td>
            <td>'.trimDecimal($row['87']).'</td>
            <td>A6</td>
            <td>'.trimDecimal($row['a6']).'</td>
        </tr>
        <tr>
            <td>08</td>
            <td>'.trimDecimal($row['8']).'</td>
            <td>28</td>
            <td>'.trimDecimal($row['28']).'</td>
            <td>48</td>
            <td>'.trimDecimal($row['48']).'</td>
            <td>68</td>
            <td>'.trimDecimal($row['68']).'</td>
            <td>88</td>
            <td>'.trimDecimal($row['88']).'</td>
            <td>A7</td>
            <td>'.trimDecimal($row['a7']).'</td>
        </tr>
        <tr>
            <td>09</td>
            <td>'.trimDecimal($row['9']).'</td>
            <td>29</td>
            <td>'.trimDecimal($row['29']).'</td>
            <td>49</td>
            <td>'.trimDecimal($row['49']).'</td>
            <td>69</td>
            <td>'.trimDecimal($row['69']).'</td>
            <td>89</td>
            <td>'.trimDecimal($row['89']).'</td>
            <td>A8</td>
            <td>'.trimDecimal($row['a8']).'</td>
        </tr>
        <tr>
            <td>10</td>
            <td>'.trimDecimal($row['10']).'</td>
            <td>30</td>
            <td>'.trimDecimal($row['30']).'</td>
            <td>50</td>
            <td>'.trimDecimal($row['50']).'</td>
            <td>70</td>
            <td>'.trimDecimal($row['70']).'</td>
            <td>90</td>
            <td>'.trimDecimal($row['90']).'</td>
            <td>A9</td>
            <td>'.trimDecimal($row['a9']).'</td>
        </tr>
        <tr>
            <td>11</td>
            <td>'.trimDecimal($row['11']).'</td>
            <td>31</td>
            <td>'.trimDecimal($row['31']).'</td>
            <td>51</td>
            <td>'.trimDecimal($row['51']).'</td>
            <td>71</td>
            <td>'.trimDecimal($row['71']).'</td>
            <td>91</td>
            <td>'.trimDecimal($row['91']).'</td>
            <td>B0</td>
            <td>'.trimDecimal($row['b0']).'</td>
        </tr>
        <tr>
            <td>12</td>
            <td>'.trimDecimal($row['12']).'</td>
            <td>32</td>
            <td>'.trimDecimal($row['32']).'</td>
            <td>52</td>
            <td>'.trimDecimal($row['52']).'</td>
            <td>72</td>
            <td>'.trimDecimal($row['72']).'</td>
            <td>92</td>
            <td>'.trimDecimal($row['92']).'</td>
            <td>B1</td>
            <td>'.trimDecimal($row['b1']).'</td>
        </tr>
        <tr>
            <td>13</td>
            <td>'.trimDecimal($row['13']).'</td>
            <td>33</td>
            <td>'.trimDecimal($row['33']).'</td>
            <td>53</td>
            <td>'.trimDecimal($row['53']).'</td>
            <td>73</td>
            <td>'.trimDecimal($row['73']).'</td>
            <td>93</td>
            <td>'.trimDecimal($row['93']).'</td>
            <td>B2</td>
            <td>'.trimDecimal($row['b2']).'</td>
        </tr>
        <tr>
            <td>14</td>
            <td>'.trimDecimal($row['14']).'</td>
            <td>34</td>
            <td>'.trimDecimal($row['34']).'</td>
            <td>54</td>
            <td>'.trimDecimal($row['54']).'</td>
            <td>74</td>
            <td>'.trimDecimal($row['74']).'</td>
            <td>94</td>
            <td>'.trimDecimal($row['94']).'</td>
            <td>B3</td>
            <td>'.trimDecimal($row['b3']).'</td>
        </tr>
        <tr>
            <td>15</td>
            <td>'.trimDecimal($row['15']).'</td>
            <td>35</td>
            <td>'.trimDecimal($row['35']).'</td>
            <td>55</td>
            <td>'.trimDecimal($row['55']).'</td>
            <td>75</td>
            <td>'.trimDecimal($row['75']).'</td>
            <td>95</td>
            <td>'.trimDecimal($row['95']).'</td>
            <td>B4</td>
            <td>'.trimDecimal($row['b4']).'</td>
        </tr>
        <tr>
            <td>16</td>
            <td>'.trimDecimal($row['16']).'</td>
            <td>36</td>
            <td>'.trimDecimal($row['36']).'</td>
            <td>56</td>
            <td>'.trimDecimal($row['56']).'</td>
            <td>76</td>
            <td>'.trimDecimal($row['76']).'</td>
            <td>96</td>
            <td>'.trimDecimal($row['96']).'</td>
            <td>B5</td>
            <td>'.trimDecimal($row['b5']).'</td>
        </tr>
        <tr>
            <td>17</td>
            <td>'.trimDecimal($row['17']).'</td>
            <td>37</td>
            <td>'.trimDecimal($row['37']).'</td>
            <td>57</td>
            <td>'.trimDecimal($row['57']).'</td>
            <td>77</td>
            <td>'.trimDecimal($row['77']).'</td>
            <td>97</td>
            <td>'.trimDecimal($row['97']).'</td>
            <td>B6</td>
            <td>'.trimDecimal($row['b6']).'</td>
        </tr>
        <tr>
            <td>18</td>
            <td>'.trimDecimal($row['18']).'</td>
            <td>38</td>
            <td>'.trimDecimal($row['38']).'</td>
            <td>58</td>
            <td>'.trimDecimal($row['58']).'</td>
            <td>78</td>
            <td>'.trimDecimal($row['78']).'</td>
            <td>98</td>
            <td>'.trimDecimal($row['98']).'</td>
            <td>B7</td>
            <td>'.trimDecimal($row['b7']).'</td>
        </tr>
        <tr>
            <td>19</td>
            <td>'.trimDecimal($row['19']).'</td>
            <td>39</td>
            <td>'.trimDecimal($row['39']).'</td>
            <td>59</td>
            <td>'.trimDecimal($row['59']).'</td>
            <td>79</td>
            <td>'.trimDecimal($row['79']).'</td>
            <td>99</td>
            <td>'.trimDecimal($row['99']).'</td>
            <td>B8</td>
            <td>'.trimDecimal($row['b8']).'</td>
        </tr>
        <tr>
            <td>20</td>
            <td>'.trimDecimal($row['20']).'</td>
            <td>40</td>
            <td>'.trimDecimal($row['40']).'</td>
            <td>60</td>
            <td>'.trimDecimal($row['60']).'</td>
            <td>80</td>
            <td>'.trimDecimal($row['80']).'</td>
            <td>100</td>
            <td>'.trimDecimal($row['100']).'</td>
            <td>B9</td>
            <td>'.trimDecimal($row['b9']).'</td>
        </tr>';
    }
}

function empty_check($string){
    if(isset($string) && !empty($string)){
        return true;
    }else{
        return false;
    }
}

function get_party_bet_sum($party_id, $user_id = 0, $date, $game_id, $con) {
    // Prepare the SQL query with placeholders
    $query = "SELECT SUM(bet_total) AS total_bet FROM `coupon_row_data` WHERE p_id = ? AND g_id = ? AND date = ?";

    // Initialize response array
    $response = array();

    // Prepare the statement
    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind the parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "iis", $party_id, $game_id, $date);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $total_bet);

        // Fetch the results
        if (mysqli_stmt_fetch($stmt)) {
            // Check if the total bet is not null
            if (!is_null($total_bet)) {
                $response['total'] = $total_bet;
            } else {
                $response['total'] = 0;
            }
        } else {
            $response['error'] = "No records found.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $response['error'] = "Failed to prepare the SQL query.";
    }

    // Return the JSON encoded response
    return json_encode($response);
}

function fetch_party_details($party_id, $con) {
    // Prepare the SQL query
    $query = "SELECT p_limit, p_pati, p_name FROM parties WHERE p_id = ?";

    // Prepare the statement
    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind the parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "i", $party_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result variables
        mysqli_stmt_bind_result($stmt, $p_limit, $p_pati, $p_name);

        // Fetch the results
        if (mysqli_stmt_fetch($stmt)) {
            $response = array('pati' => $p_pati, 'limit' => $p_limit, 'party_name' => $p_name);
        } else {
            $response = array('error' => "No party details found.");
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $response = array('error' => "Failed to prepare the SQL query.");
    }

    // Return the response
    return $response;
}

function created_party_sheet_data($array) {
    $final_array = array();

    // Loop through each item in the array
    foreach ($array as $key => $value) {
        foreach ($value as $type => $data) {
            if ($type == 'bet_number' && $value['sheet'] == 'no') {
                // Split the bet_number string by commas
                $numbers = explode(',', $data);
                foreach ($numbers as $number) {
                    // Check if the number is already in the final_array, if yes, add the amount, otherwise initialize it
                    if (array_key_exists($number, $final_array)) {
                        $final_array[$number] += $value['amount'];
                    } else {
                        $final_array[$number] = $value['amount'];
                    }
                }
            }else if($type == 'sheet_data' && $value['sheet'] == 'yes'){
                $sheet_data = $data;
                foreach ($sheet_data as $key => $value) {
                    if($key == '01' || $key == '02' || $key == '03' || $key == '04' || $key == '05' || $key == '06' || $key == '07' || $key == '08' || $key == '09'){
                        $key = ltrim($key, '0');
                    }
                    if (array_key_exists($key, $final_array)) {
                        $final_array[$key] += $value;
                    } else {
                        $final_array[$key] += $value;
                    }
                }
            }
        }
    }

    // Get the main_clon_array and merge it with final_array
    $clon_array = main_clon_array();

    // Merge arrays, adding values for duplicate keys
    foreach ($clon_array as $key => $value) {
        if (array_key_exists($key, $final_array)) {
            // Add value if key already exists
            $final_array[$key] += $value;
        } else {
            // Add new key-value pair
            $final_array[$key] = $value;
        }
    }

    return $final_array; // Return the aggregated result
}

function sum_array_by_key_ranges($array) {
    $sums = array(
        '01-10' => 0,
        '11-20' => 0,
        '21-30' => 0,
        '31-40' => 0,
        '41-50' => 0,
        '51-60' => 0,
        '61-70' => 0,
        '71-80' => 0,
        '81-90' => 0,
        '91-100' => 0,
        'a0-a9' => 0,
        'b0-b9' => 0,
        'total_bet' => 0
    );

    // Iterate over the array to sum values based on key ranges
    foreach ($array as $key => $value) {
        // Check if the key is numeric and fall into one of the numeric ranges
        if (is_numeric($key)) {
            if ($key >= 1 && $key <= 10) {
                $sums['01-10'] += $value;
            } elseif ($key >= 11 && $key <= 20) {
                $sums['11-20'] += $value;
            } elseif ($key >= 21 && $key <= 30) {
                $sums['21-30'] += $value;
            } elseif ($key >= 31 && $key <= 40) {
                $sums['31-40'] += $value;
            } elseif ($key >= 41 && $key <= 50) {
                $sums['41-50'] += $value;
            } elseif ($key >= 51 && $key <= 60) {
                $sums['51-60'] += $value;
            } elseif ($key >= 61 && $key <= 70) {
                $sums['61-70'] += $value;
            } elseif ($key >= 71 && $key <= 80) {
                $sums['71-80'] += $value;
            } elseif ($key >= 81 && $key <= 90) {
                $sums['81-90'] += $value;
            } elseif ($key >= 91 && $key <= 100) {
                $sums['91-100'] += $value;
            }
        } 
        // Check if the key is part of the 'a' or 'b' ranges
        elseif (preg_match('/^a\d$/', $key)) { // 'a0' to 'a9'
            $sums['a0-a9'] += $value;
        } elseif (preg_match('/^b\d$/', $key)) { // 'b0' to 'b9'
            $sums['b0-b9'] += $value;
        }
        $sums['total_bet'] += $value;
    }

    // create a loop for formate the array values on same key with function trimDecimal(format_decimal($value))
    foreach ($sums as $key => $value) {
        $sums[$key] = trimDecimal(format_decimal($value));
    }
    return $sums;
}

function formatBetString($bet) {
    // Check if the length of the string is greater than 21
    if (strlen($bet) > 21) {
        // Take the first 8 characters and the last 8 characters, and concatenate with "....."
        $formattedBet = substr($bet, 0, 8) . "....." . substr($bet, -8);
    } else {
        // If the string is 21 characters or less, return it as is
        $formattedBet = $bet;
    }
    
    return $formattedBet;
}

function counting($betStringResponse, $amount) {
    $counting = array();

    // Add numbers from 1 to 100
    for ($i = 1; $i <= 100; $i++) {
        $counting[$i] = 0;
    }

    // Add letters A0 to A9
    for ($i = 0; $i <= 9; $i++) {
        $counting['a' . $i] = 0;
    }

    // Add letters B0 to B9
    for ($i = 0; $i <= 9; $i++) {
        $counting['b' . $i] = 0;
    }

    // Update $counting array based on $betStringResponse
    foreach ($betStringResponse as $value) {
        if (array_key_exists($value, $counting)) {
            $counting[$value] += $amount;
        }
    }

    return $counting;
}

function sheet_counting($data_array) {
    $counting = array();

    // Add numbers from 1 to 100
    for ($i = 1; $i <= 100; $i++) {
        if ($i < 10) {
            $counting['0' . $i] = 0;
        } else {
            $counting[$i] = 0;
        }
    }

    // Add letters A0 to A9
    for ($i = 0; $i <= 9; $i++) {
        $counting['a' . $i] = 0;
    }

    // Add letters B0 to B9
    for ($i = 0; $i <= 9; $i++) {
        $counting['b' . $i] = 0;
    }

    // Update $counting array based on $betStringResponse
    foreach ($data_array as $key => $value) {
        if (array_key_exists($key, $counting)) {
            $counting[$key] += $value;
        }
    }

    return $counting;
}

function jantri_total($data_array,$sheet_type,$party_total){
    // Initialize the totals array
    $totals = array(
        "total_01_10" => 0,
        "total_11_20" => 0,
        "total_21_30" => 0,
        "total_31_40" => 0,
        "total_41_50" => 0,
        "total_51_60" => 0,
        "total_61_70" => 0,
        "total_71_80" => 0,
        "total_81_90" => 0,
        "total_91_100" => 0,
        "total_a0_a9" => 0,
        "total_b0_b9" => 0,
        "total_01_91" => 0,
        "total_02_92" => 0,
        "total_03_93" => 0,
        "total_04_94" => 0,
        "total_05_95" => 0,
        "total_06_96" => 0,
        "total_07_97" => 0,
        "total_08_98" => 0,
        "total_09_99" => 0,
        "total_10_100" => 0,
        "jantri_total" => 0,
        "game_total" => 0,
        "total_01_100" => 0
    );
    
    // Define allowed IDs
    $allowedIds = array(
        '01-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70',
        '71-80', '81-90', '91-100', 'a0-a9', 'b0-b9', '01-91', '02-92',
        '03-93', '04-94', '05-95', '06-96', '07-97', '08-98', '09-99', '10-100', 'AB', 'jantri_total', '01-100', 'total_bet', 'game_total'
    );
    
    // Assuming $inputs is an associative array representing the form inputs (e.g., $_POST)
    $inputs = $data_array;  // Replace with your form input data
    $sheetType = isset($sheet_type) ? strtolower($sheet_type) : '';
    
    // Game total
    $totals['game_total'] = isset($party_total) ? (int)$party_total : 0;
    
    // Iterate over the inputs
    foreach ($inputs as $id => $value) {
        $value = (int)$value; // Convert to integer
        if ($value > 0) {
            if (!in_array($id, $allowedIds)) {
                if ($sheetType === 's1') {
                    // For 'S1' type, handle ranges of IDs
                    if (in_array($id, range(1, 10))) $totals['total_01_10'] += $value;
                    if (in_array($id, range(11, 20))) $totals['total_11_20'] += $value;
                    if (in_array($id, range(21, 30))) $totals['total_21_30'] += $value;
                    if (in_array($id, range(31, 40))) $totals['total_31_40'] += $value;
                    if (in_array($id, range(41, 50))) $totals['total_41_50'] += $value;
                    if (in_array($id, range(51, 60))) $totals['total_51_60'] += $value;
                    if (in_array($id, range(61, 70))) $totals['total_61_70'] += $value;
                    if (in_array($id, range(71, 80))) $totals['total_71_80'] += $value;
                    if (in_array($id, range(81, 90))) $totals['total_81_90'] += $value;
                    if (in_array($id, range(91, 100))) $totals['total_91_100'] += $value;
                } else {
                    // Handle ranges for the non-'S1' case
                    switch ($id) {
                        case '01': case '11': case '21': case '31': case '41': case '51': case '61': case '71': case '81': case '91':
                            $totals['total_01_91'] += $value;
                            break;
                        case '02': case '12': case '22': case '32': case '42': case '52': case '62': case '72': case '82': case '92':
                            $totals['total_02_92'] += $value;
                            break;
                        case '03': case '13': case '23': case '33': case '43': case '53': case '63': case '73': case '83': case '93':
                            $totals['total_03_93'] += $value;
                            break;
                        case '04': case '14': case '24': case '34': case '44': case '54': case '64': case '74': case '84': case '94':
                            $totals['total_04_94'] += $value;
                            break;
                        case '05': case '15': case '25': case '35': case '45': case '55': case '65': case '75': case '85': case '95':
                            $totals['total_05_95'] += $value;
                            break;
                        case '06': case '16': case '26': case '36': case '46': case '56': case '66': case '76': case '86': case '96':
                            $totals['total_06_96'] += $value;
                            break;
                        case '07': case '17': case '27': case '37': case '47': case '57': case '67': case '77': case '87': case '97':
                            $totals['total_07_97'] += $value;
                            break;
                        case '08': case '18': case '28': case '38': case '48': case '58': case '68': case '78': case '88': case '98':
                            $totals['total_08_98'] += $value;
                            break;
                        case '09': case '19': case '29': case '39': case '49': case '59': case '69': case '79': case '89': case '99':
                            $totals['total_09_99'] += $value;
                            break;
                        case '10': case '20': case '30': case '40': case '50': case '60': case '70': case '80': case '90': case '100':
                            $totals['total_10_100'] += $value;
                            break;
                    }
                }
            }
        
            // Add to AB total for 'A' and 'B' IDs
            if (preg_match('/^a[0-9]$/', $id)) $totals['total_a0_a9'] += $value;
            if (preg_match('/^b[0-9]$/', $id)) $totals['total_b0_b9'] += $value;
        }
    }
    
    // Calculate overall totals
    $totals['total_01_100'] = $totals['total_01_91'] + $totals['total_02_92'] + $totals['total_03_93'] + $totals['total_04_94'] + 
                              $totals['total_05_95'] + $totals['total_06_96'] + $totals['total_07_97'] + $totals['total_08_98'] + 
                              $totals['total_09_99'] + $totals['total_10_100'] + $totals['total_01_10'] + $totals['total_11_20'] + 
                              $totals['total_21_30'] + $totals['total_31_40'] + $totals['total_41_50'] + $totals['total_51_60'] + 
                              $totals['total_61_70'] + $totals['total_71_80'] + $totals['total_81_90'] + $totals['total_91_100'];
    
    $totals['total_AB'] = $totals['total_a0_a9'] + $totals['total_b0_b9'];
    $totals['jantri_total'] = $totals['total_01_100'] + $totals['total_AB'];
    return $totals;
}

function fetch_last_bet($party_id,$user_id = '', $game_id, $date, $con) {
    // Prepare the SQL query
    $query = "SELECT modified_at FROM coupon_row_data WHERE p_id = ? AND g_id = ? AND date = ? ORDER BY crd_id DESC LIMIT 1";
    
    // Initialize response array
    $response = array();

    // Prepare the statement
    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind the parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "iis", $party_id, $game_id, $date);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result variable
        mysqli_stmt_bind_result($stmt, $modified_at);

        // Fetch the result
        if (mysqli_stmt_fetch($stmt)) {
            $response = $modified_at;
        } else {
            $response = "No records found.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $response = "No records found.";
    }

    // Return the response
    return $response;
}

function copy_sheet($row){
    $clipboardData = "";
    for ($i = 1; $i <= 20; $i++) {
        // Create a line of text for each row with tab-separated values
        $clipboardData .= $i . "\t" . trimDecimal(format_decimal($row[$i])) . "\t" . ($i + 20) . "\t" . trimDecimal(format_decimal($row[$i + 20])) . "\t" . 
                          ($i + 40) . "\t" . trimDecimal(format_decimal($row[$i + 40])) . "\t" . ($i + 60) . "\t" . trimDecimal(format_decimal($row[$i + 60])) . "\t" . 
                          ($i + 80) . "\t" . trimDecimal(format_decimal($row[$i + 80])) . "\n";
    }
    return $clipboardData;
}

function copy_final_sheet($row){
    $clipboardData = "";
    for ($i = 1; $i <= 20; $i++) {
        if($i<11){
            // Create a line of text for each row with tab-separated values
            $clipboardData .= $i . "\t" . trimDecimal(format_decimal($row[$i])) . "\t" . ($i + 20) . "\t" . trimDecimal(format_decimal($row[$i + 20])) . "\t" . 
            ($i + 40) . "\t" . trimDecimal(format_decimal($row[$i + 40])) . "\t" . ($i + 60) . "\t" . trimDecimal(format_decimal($row[$i + 60])) . "\t" . 
            ($i + 80) . "\t" . trimDecimal(format_decimal($row[$i + 80])) . "\t" . ($i + 100) . "\t" . trimDecimal(format_decimal($row[$i + 100])) . "\t".
            ('a'.($i - 1)) . "\t" . trimDecimal(format_decimal($row['a'.($i - 1)])) . "\n";
        }else{
            // Create a line of text for each row with tab-separated values
            $clipboardData .= $i . "\t" . trimDecimal(format_decimal($row[$i])) . "\t" . ($i + 20) . "\t" . trimDecimal(format_decimal($row[$i + 20])) . "\t" . 
            ($i + 40) . "\t" . trimDecimal(format_decimal($row[$i + 40])) . "\t" . ($i + 60) . "\t" . trimDecimal(format_decimal($row[$i + 60])) . "\t" . 
            ($i + 80) . "\t" . trimDecimal(format_decimal($row[$i + 80])) . "\t" . ($i + 100) . "\t" . trimDecimal(format_decimal($row[$i + 100])) . "\t".
            ('b'.($i - 1)) . "\t" . trimDecimal(format_decimal($row['b'.($i - 1)])) . "\n";
        }
        
    }
    return $clipboardData;
}

function get_game_total($game_id, $date, $con) {
    
    // Prepare the SQL query
    $query = "SELECT SUM(`1`)+SUM(`2`)+SUM(`3`)+SUM(`4`)+SUM(`5`)+SUM(`6`)+SUM(`7`)+SUM(`8`)+SUM(`9`)+SUM(`10`)+SUM(`11`)+SUM(`12`)+SUM(`13`)+SUM(`14`)+SUM(`15`)+SUM(`16`)+SUM(`17`)+SUM(`18`)+SUM(`19`)+SUM(`20`)+SUM(`21`)+SUM(`22`)+SUM(`23`)+SUM(`24`)+SUM(`25`)+SUM(`26`)+SUM(`27`)+SUM(`28`)+SUM(`29`)+SUM(`30`)+SUM(`31`)+SUM(`32`)+SUM(`33`)+SUM(`34`)+SUM(`35`)+SUM(`36`)+SUM(`37`)+SUM(`38`)+SUM(`39`)+SUM(`40`)+SUM(`41`)+SUM(`42`)+SUM(`43`)+SUM(`44`)+SUM(`45`)+SUM(`46`)+SUM(`47`)+SUM(`48`)+SUM(`49`)+SUM(`50`)+SUM(`51`)+SUM(`52`)+SUM(`53`)+SUM(`54`)+SUM(`55`)+SUM(`56`)+SUM(`57`)+SUM(`58`)+SUM(`59`)+SUM(`60`)+SUM(`61`)+SUM(`62`)+SUM(`63`)+SUM(`64`)+SUM(`65`)+SUM(`66`)+SUM(`67`)+SUM(`68`)+SUM(`69`)+SUM(`70`)+SUM(`71`)+SUM(`72`)+SUM(`73`)+SUM(`74`)+SUM(`75`)+SUM(`76`)+SUM(`77`)+SUM(`78`)+SUM(`79`)+SUM(`80`)+SUM(`81`)+SUM(`82`)+SUM(`83`)+SUM(`84`)+SUM(`85`)+SUM(`86`)+SUM(`87`)+SUM(`88`)+SUM(`89`)+SUM(`90`)+SUM(`91`)+SUM(`92`)+SUM(`93`)+SUM(`94`)+SUM(`95`)+SUM(`96`)+SUM(`97`)+SUM(`98`)+SUM(`99`)+SUM(`100`)+SUM(`a0`)+SUM(`a1`)+SUM(`a2`)+SUM(`a3`)+SUM(`a4`)+SUM(`a5`)+SUM(`a6`)+SUM(`a7`)+SUM(`a8`)+SUM(`a9`)+SUM(`b0`)+SUM(`b1`)+SUM(`b2`)+SUM(`b3`)+SUM(`b4`)+SUM(`b5`)+SUM(`b6`)+SUM(`b7`)+SUM(`b8`)+SUM(`b9`) AS `total_bet` FROM `coupon_bet_data` WHERE g_id = ? AND date = ?";
    // Initialize response array
    $response = array();

    // Prepare the statement
    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind the parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "is", $game_id, $date);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result variable
        mysqli_stmt_bind_result($stmt, $total_bet);

        // Fetch the result
        if (mysqli_stmt_fetch($stmt)) {
            $response['total'] = trimDecimal(format_decimal($total_bet));
        } else {
            $response['error'] = "No records found.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $response['error'] = "Failed to prepare the SQL query.";
    }

    // Return the response
    return $response;
}

function get_total_parsing($number,$game_id,$date,$con){
    $no = $number;
    // trim the number
    $no = ltrim($number, '0');
    if($no == '1' || $no == '2' || $no == '3' || $no == '4' || $no == '5' || $no == '6' || $no == '7' || $no == '8' || $no == '9'){
        $updated_number = '0'.$no;
    }else if($no == '100'){
        $updated_number = '00';
        $no = 100;
    }else{
        $updated_number = $no;
    }

    // break the number into two parts
    $number_arr = str_split($updated_number);
    $a_number = 'a'.$number_arr[0];
    $b_number = 'b'.$number_arr[1];

    // Prepare the SQL query
    $query = "SELECT SUM(`$no`)+SUM(`$a_number`)/10+SUM(`$b_number`)/10 AS total_bet FROM `coupon_bet_data` WHERE g_id = ? AND date = ?";
    
    // Initialize response array
    $response = array();

    // Prepare the statement
    if ($stmt = mysqli_prepare($con, $query)) {
        // Bind the parameters to the SQL query
        mysqli_stmt_bind_param($stmt, "is", $game_id, $date);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Bind the result variable
        mysqli_stmt_bind_result($stmt, $total_bet);

        // Fetch the result
        if (mysqli_stmt_fetch($stmt)) {
            $response['total'] = trimDecimal(format_decimal($total_bet));
        } else {
            $response['error'] = "No records found.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $response['error'] = "Failed to prepare the SQL query.";
    }

    // Return the response
    return $response;
}

?>
