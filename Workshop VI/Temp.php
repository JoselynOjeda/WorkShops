<?php

$month_temp = "78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 81, 76, 73,
68, 72, 73, 75, 65, 74, 63, 67, 65, 64, 68, 73, 75, 79, 73";

$temp_array = array_map('trim', explode(',', $month_temp));

$tot_temp = array_sum($temp_array);

$temp_array_length = count($temp_array);

$avg_high_temp = $tot_temp / $temp_array_length;

echo "\nAverage Temperature is : " . round($avg_high_temp, 1) . "\n";


$temp_array = array_unique($temp_array);

sort($temp_array);


echo "List of five lowest temperatures: ";
echo implode(", ", array_slice($temp_array, 0, 5)) . "\n";

echo "List of five highest temperatures: ";
echo implode(", ", array_slice($temp_array, -5)) . "\n";

?>