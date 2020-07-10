<?php
    /*
     * Post Paramters
     *  - Type: "GameStats", "PlayerStats"
     *  - ServerID: XUID
     *  - MatchID: Server Generated unique ID (xuid+dattime, guid, etc..)
     */

     /*
        Trying to avoid as much round tripping as possible..
     */
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include 'Get/GameStats.php';
    include '../Shared/DBContext.php';
    include '../Shared/Error.php';
    include '../Shared/Enum/GetType.php';
    include '../Shared/UploadHandler.php';
    include '../Shared/Objects/UUID.php';


    //Global DB Connection for the entire scope
    $GLOBALS["db"] = DBContext::getConnection();

    //This Script should only accept post requests.
    if ($_SERVER['REQUEST_METHOD'] != 'GET') {
        ErrorOutAndExit('404', "You're not supposed to be here.");
    }
    if(!isset($_GET["Type"])){
        ErrorOutAndExit('500', 'Inavlid Parameters were recieved.');
    }

    switch($_GET["Type"]){
        case GetType::GameStats:
            if(isset($_GET["Match_UUID"])){
                echo RetrieveGameStats($_GET["Match_UUID"]);
            } else {
                ErrorOutAndExit('500', "Match_UUID Parameter is missing.");
            }
        break;
    }
?>