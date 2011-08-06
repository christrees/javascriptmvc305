<?php
include_once 'common.php';
//--OK we should have a $gamebankout array
//--Send the games model to the user
$end = sizeof($gamebankout);
$i = 1;
echo '[';
foreach ($gamebankout as $value) {
    echo json_encode($value);
    if ( $i < $end) echo ',';
    $i++;
}
echo ']';
?>