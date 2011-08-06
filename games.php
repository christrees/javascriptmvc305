<?php
include_once 'common.php';
//--OK we should have a $gamebankout array
//--User just sent us an update
    if (isset($gamebankout[$idGameBrd_post])) {
     $gamebankout[$idGameBrd_post]["idGameBrd"] = $idGameBrd_post;
     $gamebankout[$idGameBrd_post]["message"] = "beenread";
     $gamebankout[$idGameBrd_post]["TeamNameA"] = $TeamNameA_post;
     $gamebankout[$idGameBrd_post]["TeamNameB"] = $TeamNameB_post;
     $gamebankout[$idGameBrd_post]["id"] = $id;
    } else {
     $gamebankout[$idGameBrd_post] = $theGame["gamesbankinit"];
     $gamebankout[$idGameBrd_post]["idGameBrd"] = $idGameBrd_post;
     $gamebankout[$idGameBrd_post]["message"] = "brannew";
     $gamebankout[$idGameBrd_post]["TeamNameA"] = $TeamNameA_post;
     $gamebankout[$idGameBrd_post]["TeamNameB"] = $TeamNameB_post;
     $gamebankout[$idGameBrd_post]["id"] = $idGameBrd_post;
    }
    //-- Store the new games list
    $fp = fopen($gamesbankbasename, 'w+') or die("I could not open $gamesbankbasename.");
    fwrite($fp, serialize($gamebankout));
    fclose($fp);
    //--Give the updated data back
    echo json_encode($gamebankout[$idGameBrd_post]);
?>
