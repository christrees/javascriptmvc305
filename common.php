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
}
//-- if your using tokens you should be passing me this stuff on POST
	$id         = (isset($_POST['id']))   ? ($_POST['id']  ) : ('IDfuckd');
	$idCreator  = (isset($_POST['idCreator'])) ? ($_POST['idCreator']) : ('UIDfuckd');
	$idGameBrd_post  = (isset($_POST['idGameBrd']))  ? ($_POST['idGameBrd'] ) : ('GameBrdFd');
        $idGamePos  = (isset($_POST['idGamePos'])) ? ($_POST['idGamePos']) : ('DeBugFd');
	$idOwner    = (isset($_POST['idOwner']))  ? ($_POST['idOwner'] ) : ('DeBugFd');
        $idPlayer_post   = (isset($_POST['idPlayer'])) ? ($_POST['idPlayer']) : ('DeBugFd');
	$state      = (isset($_POST['state']))  ? ($_POST['state'] ) : ('DeBugFd');
//-- Get the right board for the user
$theGame = parse_ini_file("gameboard.ini", true);
$gameTokenTotal = $theGame["gamegridinit"]["gametotaltokens"];
$gamedefaulttokenowner = $theGame["gamegridinit"]["gamedefaulttokenowner"];
//--Pull the board out of storage
//-- Get the right board for the user
$filename = $idGameBrd . $theGame["boardbank"]["filename"];

if ($idGameBrd == "CRAP_GETNBOARD") { //-- THIS is our crap board no brd cookie
    //-- Walk the files for a new board
    $idGameBrd = 1;
    while (file_exists($idGameBrd . $filename)) { //- Find a new board id
        $idGameBrd++;
    }
    $filename = $idGameBrd . $filename;
    for ($i = 1; $i <= $gameTokenTotal; $i++) {
        //-- Generate the grid object
         $gamebrdout[$i] = $theGame["tokendefault"];
         $gamebrdout[$i]["idGameBrd"] = $idGameBrd;
         $gamebrdout[$i]["idGamePos"] = $i;
         $gamebrdout[$i]["id"] = $i;
    }
    //-- Set the board on with the cookie
    setcookie("idGameBrd", $idGameBrd);
    //-- Store the new board
    $fp = fopen($filename, 'w+') or die("I could not open $filename.");
    //--Reference: http://php.net/manual/en/language.oop5.serialization.php
    fwrite($fp, serialize($gamebrdout));
    fclose($fp);
    //
} else { //-- We have a board id so go fetch it
    //--Pull the board out of storage
    if (file_exists($filename)) {
           $gamebrdout = unserialize(file_get_contents($filename));
    }
}
//--We should have a board at this poing
?>
