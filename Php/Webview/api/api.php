<?php
#$file="https://phishstats.info/phish_score.csv";
function getcsv(string $string): array
{
    return str_getcsv($string, ",", "\"", "");
}

$len = isset($_GET["len"]) ? intval($_GET["len"]) + 10 : 0;
$file = "./phish_score.csv";
$csv = file_get_contents($file);
$tmp = explode("\n", $csv, $len);
array_pop($tmp);
$array = array_map("getcsv", $tmp);
$json = json_encode($array);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($json);