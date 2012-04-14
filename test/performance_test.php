<?php

include_once dirname(dirname(__FILE__)) . "/src/IpLocationSeekerBinary.php";
include_once dirname(dirname(__FILE__)) . "/src/IpLocationSeekerBinaryExtension.php";
include_once dirname(dirname(__FILE__)) . "/src/IpLocationSeekerSqlite.php";

$int_max = 2147483647;
$sqlite_filepath = "/Users/york/htdocs/video_kankan/protected/data/qqwry.sqlite.3";
$qqwry_filepath = "/Users/york/htdocs/video_kankan/protected/data/qqwry.dat";


// PHP + 二进制
$seeker = new IpLocationSeekerBinary($qqwry_filepath);
$start_time = microtime(true);
for($i=10000; $i>=0; $i--){
	$ip = long2ip(rand(0, $int_max));
	$seeker->seek($ip);
}
printf("[binary]\ttimes:10000\t%.2fs used\t\n", microtime(true) - $start_time);

// Ext + 二进制
$seeker = new IpLocationSeekerBinaryExtension($qqwry_filepath);
$start_time = microtime(true);
for($i=100000; $i>=0; $i--){
	$ip = long2ip(rand(0, $int_max));
	$seeker->seek($ip);
}
printf("[binary-e]\ttimes:100000\t%.2fs used\t\n", microtime(true) - $start_time);

// PHP + sqlite
$seeker = new IpLocationSeekerSqlite($sqlite_filepath);
$start_time = microtime(true);
for($i=100000; $i>=0; $i--){
	$ip = long2ip(rand(0, $int_max));
	$seeker->seek($ip);
}
printf("[sqlite]\ttimes:100000\t%.2fs used\t\n", microtime(true) - $start_time);





