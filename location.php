<?php
function rad($d)
{
    return $d * 3.1415926535898 / 180.0;
}
//参数是两个经度和纬度
function GetDistance($x1,$y1,$x2,$y2){
   $EARTH_RADIUS = 6378.137; 
   $radLat1 = rad($y1);
   $radLat2 = rad($y2);
   $a = $radLat1 - $radLat2;
   $b = rad($x1) - rad($x2);
   $s = 2 * asin(sqrt(pow(sin($a/2),2) +
    cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));
   $s = $s *$EARTH_RADIUS;
   $s = round($s * 10000) / 10000;
   return $s;
}
// 使用
$r = round(GetDistance(123.25,41.48 ,121.57550,31.25765),2);
$distince = $r < 0.01 ? '0.01' : (String) $r;
echo $distince.'km'; //单位是千米
