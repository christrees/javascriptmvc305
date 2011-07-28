<?php
//-- Get the right board for the user
$theGame = parse_ini_file("gameboard.ini", true);
$filename = $theGame["boardbank"]["filename"];
$gameTokenTotal = $theGame["gamegridinit"]["gametotaltokens"];
$gamedefaulttokenowner = $theGame["gamegridinit"]["gamedefaulttokenowner"];
    //-- Magic token gen for new board
    $idGameBrd = 1;
    //--Reference: http://php.net/manual/en/language.oop5.serialization.php
    for ($i = 1; $i <= $gameTokenTotal; $i++) {
        //-- Generate the grid object
         $gamebrdout[$i] = $theGame["tokendefault"];
         $gamebrdout[$i]["idGameBrd"] = 1;
         $gamebrdout[$i]["idGamePos"] = $i;
         $gamebrdout[$i]["id"] = $i;
    }
    //print_r($gamebrdout);
    /* The old way
    $gametotaltokens = 25;
    $dataset = '[';
    for ($i = 1; $i <= $gametotaltokens; $i++) { //-- Gen a new board
        $dataset .= '{"state": "play", "idCreator": "Christ", "idOwner": "game", ';
        $dataset .= '"idPlayer": "'.$idPlayer.'", ';
        $dataset .= '"idGameBrd": "'.$idGameBrd.'", ';
        $dataset .= '"idGamePos": "'.$i.'", ';
        $dataset .= '"id": '.$i.'}';
        if ( $i < $gametotaltokens ) {$dataset .= ',';} //-- comma between all but last
    }
    $dataset .= ']';
     *
     */
    //-- Store the new board
    $fp = fopen($filename, 'w+') or die("I could not open $filename.");
    fwrite($fp, serialize($gamebrdout));
    fclose($fp);
    //
    echo '<a href="/spools/spools.html">Spools Me<a>';
?>
