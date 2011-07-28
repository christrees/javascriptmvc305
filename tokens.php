<?php
session_start();
//-- Check cookie
	isset($_COOKIE["idPlayer"])  ? ($idPlayer = $_COOKIE["idPlayer"])  : ($idPlayer = "CRAP_NOSOUP4U") ;
//-- Deal with List with no cookie
        if ($idPlayer == "CRAP_NOSOUP4U") {
                header("HTTP/1.0 418 Im A TEAPOT - aRRiR: NO SOUP 4 U");
                $mySession = session_id();
                $idPlayer = substr_replace($mySession, '', 4, -1);
                //setcookie("idPlayer", $idPlayer);
                //-EXPIRE COOKIE- set time in past so browser deletes.
                setcookie ("idPlayer", "", time() - 3600);
                //-- just set a player right now
               // $idPlayer = "1234";
              //  $_COOKIE['idPlayer'] = $idPlayer;
        }
//-- if your using tokens you should be passing me this stuff
	$id         = (isset($_POST['id']))   ? ($_POST['id']  ) : ('IDfuckd');
	$idCreator  = (isset($_POST['idCreator'])) ? ($_POST['idCreator']) : ('UIDfuckd');
	$idGameBrd  = (isset($_POST['idGameBrd']))  ? ($_POST['idGameBrd'] ) : ('GameBrdFd');
        $idGamePos  = (isset($_POST['idGamePos'])) ? ($_POST['idGamePos']) : ('DeBugFd');
	$idOwner  = (isset($_POST['idOwner']))  ? ($_POST['idOwner'] ) : ('DeBugFd');
        $idPlayer = (isset($_POST['idPlayer'])) ? ($_POST['idPlayer']) : ('DeBugFd');
	$state  = (isset($_POST['state']))  ? ($_POST['state'] ) : ('DeBugFd');
//-- Get the right board for the user
$theGame = parse_ini_file("gameboard.ini", true);
$filename = $theGame["boardbank"]["filename"];
$gameTokenTotal = $theGame["gamegridinit"]["gametotaltokens"];
$gamedefaulttokenowner = $theGame["gamegridinit"]["gamedefaulttokenowner"];
            //--Pull the board out of storage
    if (file_exists($filename)) {
           $gamebrdout = unserialize(file_get_contents($filename));
    }
    if ($gamebrdout[$idGamePos]["idOwner"] == $gamedefaulttokenowner) {
     $gamebrdout[$idGamePos]["idOwner"] = $idPlayer;
    }
        //-- Store the new board
    $fp = fopen($filename, 'w+') or die("I could not open $filename.");
    fwrite($fp, serialize($gamebrdout));
    fclose($fp);
    echo json_encode($gamebrdout[$idGamePos]);


/*
$dataset  = '{"state": "play", "idCreator": "Christ", "idOwner": "' . $idPlayer ;
$dataset .= '", "idPlayer": "' . $idPlayer;
$dataset .= '", "idGameBrd": "' . $idGameBrd;
$dataset .= '", "idGamePos": "' . $idGamePos;
$dataset .= '", "id": ' . $id.'}';
 *
 */
//header('Content-type: application/json');
//echo $_GET['callback']. '('.json_encode(array('dataset'=>$dataset)) .')';
//echo $_GET['callback']. '('. $dataset .')';
//echo $dataset;
?>
