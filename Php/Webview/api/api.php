<?php
 #$file="https://phishstats.info/phish_score.csv";
 $file="./phish_score.csv";
 $csv= file_get_contents($file);
 $array = array_map("str_getcsv", explode("\n", $csv));
 $json = json_encode($array);
 header('Content-Type: application/json; charset=utf-8');
 echo json_encode($json);