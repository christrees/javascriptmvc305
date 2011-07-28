<?php
session_start();
//header('Content-type: application/json');
//--REFERENCE
//http://www.ibm.com/developerworks/library/os-php-readfiles/
//
//-- Check cookie
isset($_COOKIE["idPlayer"])   ? ($idPlayer  = $_COOKIE["idPlayer"])   : ($idPlayer  = "CRAP_GETPLAYER") ;
isset($_COOKIE["idGameBrd"])  ? ($idGameBrd = $_COOKIE["idGameBrd"])  : ($idGameBrd = "CRAP_GETNBOARD") ;
//-- Deal with List with no cookie
if ($idPlayer == "CRAP_GETPLAYER") {
    $mySession = session_id();
    $idPlayer = substr_replace($mySession, '', 3, -1);
    setcookie("idPlayer", $idPlayer);
    //-- just set a player right now
   // $idPlayer = "1234";
  //  $_COOKIE['idPlayer'] = $idPlayer;
}
//-- Get the right board for the user
$theGame = parse_ini_file("gameboard.ini", true);
$filename = $theGame["boardbank"]["filename"];
$gameTokenTotal = $theGame["gamegridinit"]["gametotaltokens"];
$gamedefaulttokenowner = $theGame["gamegridinit"]["gamedefaulttokenowner"];

//$theGame = array("foo" => "bar", 12 => true);
//print_r($theGame);
//echo $theGame["gamegridinit"]["gametotaltokens"];
//echo $theGame["foo"];
//--ALWAYS use GameBrd 1 for now
$idGameBrd = 1;
if ($idGameBrd == "CRAP_GETNBOARD") {
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
} else {
    //--Pull the board out of storage
    if (file_exists($filename)) {
           $gamebrdout = unserialize(file_get_contents($filename));
    }
}
//--OK we should have a $gamebrdout array
//--We need to set the user display field
for ($i = 1; $i <= $gameTokenTotal; $i++) {
    if ($gamebrdout[$i]["idOwner"] == $gamedefaulttokenowner) {
     $gamebrdout[$i]["idPlayer"] = $idPlayer;
    }
}
//--
echo '[';
for ($i = 1; $i <= $gameTokenTotal; $i++) {
    echo json_encode($gamebrdout[$i]);
     if ( $i < $gameTokenTotal ) {echo ',';} //-- comma between all but last
}
echo ']';

//echo $_GET['callback']. '('.json_encode(array('dataset'=>$dataset)) .')';
//echo $_GET['callback']. '('. $dataset .')';
//echo $dataset;
//echo "Hello Chris.. this MESS YOU UP?";
?>
