<?php
	//1,关键词高亮 
	function highlight($sString, $aWords) {
    if (!is_array ($aWords) || empty ($aWords) || !is_string ($sString)) {
        return false;
    }
 
    $sWords = implode ('|', $aWords);
    return preg_replace ('@\b('.$sWords.')\b@si', '<strong style="background-color:yellow">$1</strong>', $sString);
}


	//2,获取你的Feedburner的用户
	function get_average_readers($feed_id,$interval = 7){
    $today = date('Y-m-d', strtotime("now"));
    $ago = date('Y-m-d', strtotime("-".$interval." days"));
    $feed_url="https://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=".$feed_id."&dates=".$ago.",".$today;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $feed_url);
    $data = curl_exec($ch);
    curl_close($ch);
    $xml = new SimpleXMLElement($data);
    $fb = $xml->feed->entry['circulation'];
 
    $nb = 0;
    foreach($xml->feed->children() as $circ){
        $nb += $circ['circulation'];
    }
 
    return round($nb/$interval);
}

//3,自动生成密码
function generatePassword($length=9, $strength=0) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength >= 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength >= 2) {
        $vowels .= "AEUY";
    }
    if ($strength >= 4) {
        $consonants .= '23456789';
    }
    if ($strength >= 8 ) {
        $vowels .= '@#$%';
    }
 
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}
//4,压缩多个CSS文件
header('Content-type: text/css');
ob_start("compress");
function compress($buffer) {
  /* remove comments */
  $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
  /* remove tabs, spaces, newlines, etc. */
  $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
  return $buffer;
}
 
/* your css files */
include('master.css');
include('typography.css');
include('grid.css');
include('print.css');
include('handheld.css');
 
ob_end_flush();

//5,获取短网址 
function getTinyUrl($url) {
    return file_get_contents("http://tinyurl.com/api-create.php?url=".$url);
}

//6,function age($date){
    $year_diff = '';
    $time = strtotime($date);
    if(FALSE === $time){
        return '';
    }
 
    $date = date('Y-m-d', $time);
    list($year,$month,$day) = explode("-",$date);
    $year_diff = date("Y") – $year;
    $month_diff = date("m") – $month;
    $day_diff = date("d") – $day;
    if ($day_diff < 0 || $month_diff < 0) $year_diff–;
 
    return $year_diff;
}

//7,计算执行时间 
//Create a variable for start time
$time_start = microtime(true);
 
// Place your PHP/HTML/JavaScript/CSS/Etc. Here
 
//Create a variable for end time
$time_end = microtime(true);
//Subtract the two times to get seconds
$time = $time_end - $time_start;
 
echo 'Script took '.$time.' seconds to execute';

//8,PHP的维护模式 
function maintenance($mode = FALSE){
    if($mode){
        if(basename($_SERVER['SCRIPT_FILENAME']) != 'maintenance.php'){
            header("Location: http://example.com/maintenance.php");
            exit;
        }
    }else{
        if(basename($_SERVER['SCRIPT_FILENAME']) == 'maintenance.php'){
            header("Location: http://example.com/");
            exit;
        }
    }
}

//9,阻止CSS样式被缓存  
<link href="/stylesheet.css?<?php echo time(); ?>" rel="stylesheet" type="text/css" /&glt;

//10为数字增加 st\nd\rd 等
function make_ranked($rank) {
    $last = substr( $rank, -1 );
    $seclast = substr( $rank, -2, -1 );
    if( $last > 3 || $last == 0 ) $ext = 'th';
    else if( $last == 3 ) $ext = 'rd';
    else if( $last == 2 ) $ext = 'nd';
    else $ext = 'st'; 
 
    if( $last == 1 && $seclast == 1) $ext = 'th';
    if( $last == 2 && $seclast == 1) $ext = 'th';
    if( $last == 3 && $seclast == 1) $ext = 'th'; 
 
    return $rank.$ext;
}
