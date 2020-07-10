<?php
    include("../Shared/Objects/Player/Player.php");
    include '../Shared/Objects/Server/Server.php';
    include '../Shared/Objects/Match/Match.php';
    include '../Shared/Objects/Playlist/Playlist.php';
    include '../Shared/Objects/Playlist/Variant.php';

    function RetrieveGameStats($Match_UUID){
        $DataArray = array();
        $DataArray["Match"] = DBContext::getMatch($Match_UUID);
        #$ServerMatch = DBContext::getServerMatch($Match_UUID);
        #$DataArray["Server"] = DBContext::getServer($ServerMatch->Server_XUID);
        $DataArray["Variant"] = DBContext::getVariantUUID($DataArray["Match"]->Variant_UUID);
        $DataArray["Playlist"] = DBContext::getPlaylist($DataArray["Variant"]->Playlist_Checksum);
        $DataArray["Players"] = DBContext::getMatchPlayer($Match_UUID);
        return json_encode($DataArray);
    }
?>