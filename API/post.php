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
    include '../Shared/Enum/PostType.php';
    include '../Shared/UploadHandler.php';
    include '../Shared/Objects/UUID.php';
    include '../Shared/Objects/Playlist/Playlist.php';


    //Global DB Connection for the entire scope
    $GLOBALS["db"] = DBContext::getConnection();

    //This Script should only accept post requests.
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        ErrorOutAndExit('404', "You're not supposed to be here.");
    }
    if(!isset($_POST["Type"])){
        ErrorOutAndExit('500', 'Inavlid Parameters were recieved.');
    }

    
    
    switch($_POST["Type"]){
        case PostType::GameStats:
            include 'Post/GameStats.php';
            $uploadedFilePath = StoreUpload();
            ProcessGameStats($uploadedFilePath);
        break;
        case PostType::PlaylistUpload:
            if(isset($_POST["Playlist_Checksum"])){
                if(!DBContext::playlistExists($_POST["Playlist_Checksum"])){
                    $uploadedFilePath = StoreUpload($_POST["Playlist_Checksum"]);
                    DBContext::insertPlaylist(
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
            } else{
                ErrorOutAndExit('500', 'Inavlid Parameters were recieved.');
            }
        break;
    }
?>