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
    include '../Shared/DBContext.php';
    include '../Shared/Error.php';
    include '../Shared/Enum/GetType.php';
    include '../Shared/UploadHandler.php';


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
            include 'Get/GameStats.php';
            if(isset($_GET["Match_UUID"])){
                echo RetrieveGameStats($_GET["Match_UUID"]);
            } else {
                ErrorOutAndExit('500', "Match_UUID Parameter is missing.");
            }
        break;
        case GetType::PlaylistCheck:
            include_once 'Get/ServerAuthentication.php';
            include_once '../Shared/DB/PlaylistQueries.php';
            if(isset($_GET["Playlist_Checksum"]) && isset($_GET["AuthToken"])){
                if(VerifyJWT($_GET["AuthToken"])){
                    if(PlaylistQueries::playlistExists($_GET["Playlist_Checksum"])){
                        header("HTTP/1.0 200 Playlist Found");
                    } else{
                        header("HTTP/1.0 201 Playlist not found");
                    }
                } else {
                    header("HTTP/1.0 202 Invalid Token");    
                }
            } else {
                header("HTTP/1.0 203 Paramters missing");
            }
        break;
        case GetType::PlaylistRanks:
            include_once '../Shared/DB/PlaylistQueries.php';
            include_once '../Shared/DB/ServerQueries.php';
            include_once '../Shared/DB/PlayerQueries.php';
            include_once 'Get/PlaylistRanks.php';
            if(isset($_GET["Playlist_Checksum"]) && isset($_GET["Player_XUIDS"]) && isset($_GET["Server_XUID"])){
                header("HTTP/1.0 200");
                echo RetrievePlayerRanks($_GET["Server_XUID"], $_GET["Playlist_Checksum"], $_GET["Player_XUIDS"]);
            } else{
                header("HTTP/1.0 500 Paramters missing");
            }
        break;
        case GetType::ServerRegistrationCheck:
            include_once '../Shared/DB/ServerQueries.php';
            if(isset($_GET["Server_XUID"])){
                if(ServerQueries::serverExists($_GET["Server_XUID"])){
                    header("HTTP/1.0 200");
                    $Server = ServerQueries::getServer($_GET["Server_XUID"]);
                    print(json_encode(["Registered" => true, "RanksEnabled" => ($Server->RanksEnabled == 1) ? "true" : "false", "StatsEnabled" => ($Server->Enabled == 1) ? "true" : "false"]));
                } else {
                    header("HTTP/1.0 201");
                    echo ServerQueries::generateUniqueAuthKey();
                }
            } else{
                header("HTTP/1.0 500 Paramters missing");
            }
        break;
    }
?>