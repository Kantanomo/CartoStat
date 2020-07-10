<?php
    include "../Shared/DBContext.php";
    include "../Shared/Objects/Player/Player.php";
    include '../Shared/Objects/Server/Server.php';
    include '../Shared/Objects/Match/Match.php';
    include '../Shared/Objects/Playlist/Playlist.php';
    include '../Shared/Objects/Playlist/Variant.php';
    include '../Shared/Enum/Colors.php';
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    if(!isset($_GET["Match_UUID"])){
        die("No Match Provided");
    } else if(!DBContext::matchExists($_GET["Match_UUID"])){
        die("Invalid Match Provided");
    }
    $Match_UUID = $_GET["Match_UUID"];
    $DataArray = array();
    $Match = DBContext::getMatch($Match_UUID);
    #$ServerMatch = DBContext::getServerMatch($Match_UUID);
    #$Server = DBContext::getServer($ServerMatch->Server_XUID);
    $Variant = DBContext::getVariantUUID($Match->Variant_UUID);
    $Playlist = DBContext::getPlaylist($Variant->Playlist_Checksum);
    $Players = DBContext::getMatchPlayer($Match_UUID);
    uasort($Players, function($item, $compare){
        return $item->EndGameIndex >= $compare->EndGameIndex;
    });
    switch($Variant->Type){
        case 1:

        break;
        case "Slayer":
           includeWithVariables("MatchDetailParts/MatchSlayer.php", array("Players" => $Players), true);
        break;
    }

    function includeWithVariables($filePath, $variables = array(), $print = true)
    {
        $output = NULL;
        if(file_exists($filePath)){
            extract($variables);
            ob_start();
            include $filePath;
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;

    }
?>