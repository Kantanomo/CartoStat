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
    
    include_once '../Shared/DBContext.php';
    include_once '../Shared/Error.php';
    include_once '../Shared/Enum/PostType.php';
    include_once '../Shared/UploadHandler.php';

    //This Script should only accept post requests.
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        ErrorOutAndExit('404', "You're not supposed to be here.");
    }
    if(!isset($_POST["Type"])){
        ErrorOutAndExit('500', 'Inavlid Parameters were recieved.');
    }

    
    
    switch($_POST["Type"]){
        case PostType::GameStats:
            include_once 'Post/GameStats.php';
            include_once 'Post/GameStats/Ranking.php';
            include_once 'Post/ServerAuthentication.php';
            include_once '../Shared/DB/PlayerQueries.php';
            include_once '../Shared/DB/MatchQueries.php';
            include_once '../Shared/DB/ServerQueries.php';
            include_once '../Shared/DB/PlaylistQueries.php';
            if(isset($_POST["AuthToken"])){
                if(VerifyJWT($_POST["AuthToken"])){
                    $uploadedFilePath = StoreUpload();
                    ProcessGameStats($uploadedFilePath, GetJWTXUID($_POST["AuthToken"]));
                    header("HTTP/1.0 200 Game Stats Processed");
                } else {
                    header("HTTP/1.0 500 Invalid Token");
                }
            } else {
                header("HTTP/1.0 500 Missing Token");
            }
        break;
        case PostType::PlaylistUpload:
            include_once '../Shared/DB/PlaylistQueries.php';
            include_once 'Post/ServerAuthentication.php';
            if(isset($_POST["Playlist_Checksum"]) && isset($_POST["AuthToken"])){
                if(VerifyJWT($_POST["AuthToken"])){
                    if(!PlaylistQueries::playlistExists($_POST["Playlist_Checksum"])){
                        $uploadedFilePath = StoreUpload($_POST["Playlist_Checksum"]);
                        PlaylistQueries::insertPlaylist(
                            new Playlist(
                                array(
                                    "Checksum" => $_POST["Playlist_Checksum"],
                                    "Name" => $_FILES['file']['name'],
                                    "FileName" => $_POST["Playlist_Checksum"] . "_" . $_FILES['file']['name']
                                ), 
                                true
                                )
                            );
                        header("HTTP/1.0 200 Playlist Uploaded");
                    } else {
                        header("HTTP/1.0 201 Playlist Already Exists");
                    }
                } else {
                    header("HTTP/1.0 500 Invalid Token");
                }
            } else{
                header("HTTP/1.0 500 Invalid Parameters");
            }
        break;
        case PostType::ServerRegistration:
            if(isset($_POST["AuthKey"]) && isset($_POST["Server_XUID"]) && isset($_POST["Server_Name"])){
                include_once '../Shared/DB/ServerQueries.php';
                include_once 'Post/ServerAuthentication.php';
                NewServerRegistration($_POST["Server_XUID"], $_POST["Server_Name"], $_POST["AuthKey"]);
                header("HTTP/1.0 200 Server Registered");
            }
            else{
                header("HTTP/1.0 500 Invalid Parameters");
            }
        break;
        case PostType::ServerLogin:
            if(isset($_POST["AuthKey"])){
                include_once '../Shared/DB/ServerQueries.php';
                include_once 'Post/ServerAuthentication.php';
                file_put_contents('./log_'.date("j.n.Y").'.log', $_POST["AuthKey"], FILE_APPEND);
                ServerLogin($_POST["AuthKey"]);
            }
            else{
                header("HTTP/1.0 500 Invalid Parameters");
            }
        break;
        case "TestLogin":
            if(isset($_POST["JWT"])){
                include_once '../Shared/DB/ServerQueries.php';
                include_once 'Post/ServerAuthentication.php';
                if(VerifyJWT($_POST["JWT"])){
                    echo "Yes";
                }
            }
        break;
    }
?>