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
    include 'Post/GameStats.php';
    include 'Post/PlayerStats.php';
    include '../Shared/DBContext.php';
    include '../Shared/Error.php';
    include '../Shared/Enum/PostType.php';
    include '../Shared/UploadHandler.php';
    include '../Shared/Objects/UUID.php';
    include '../Shared/Objects/Player/Player.php';
    include '../Shared/Objects/Server/Server.php';
    include '../Shared/Objects/Match/Match.php';

    //Global DB Connection for the entire scope
    $GLOBALS["db"] = DBContext::getConnection();

    //This Script should only accept post requests.
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        ErrorOutAndExit('404', "You're not supposed to be here.");
    }
    if(!isset($_POST["Type"]) || !isset($_POST["ServerID"])){
        ErrorOutAndExit('500', 'Inavlid Parameters were recieved.');
    }

    $uploadedFilePath = StoreUpload();
    
    switch($_POST["Type"]){
        case PostType::GameStats:
            if(!isset($_POST["MatchID"])){
                ErrorOutAndExit('500', 'No Match ID was provided');
            }
            ProcessGameStats($uploadedFilePath, $_POST["ServerID"]);
        break;
    }
?>