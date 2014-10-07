<?php
date_default_timezone_set('UTC');
 
function format_bytes($size)
{ 
    $arr = array(' B', ' KB', ' MB', ' GB', ' TB'); 
    for ($f = 0; $size >= 1024 && $f < 4; $f++)
    {
        $size /= 1024; 
    }
    return round($size, 2).$arr[$f]; 
}
echo format_bytes('123456789');
?>
