<?php

# check and not empty function
function empty_check($string)
{
    if (isset($string) && !empty($string)) {
        return true;
    } else {
        return false;
    }
}

// function to log the data.
function log_data($data)
{
    $log_file = 'log.txt';
    $data = date('Y-m-d H:i:s') . ' - ' . $data . PHP_EOL;
    file_put_contents($log_file, $data, FILE_APPEND);
}
