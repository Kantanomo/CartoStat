<?php
    include '../Shared/Objects/Playlist/PlaylistRank.php';
    function RetrievePlayerRanks($Playlist_Checksum, $Player_XUIDS){
        $XUIDSplit = explode (",", $Player_XUIDS);
        $StandingArray = array();
        for($i = 0; $i < count($XUIDSplit); $i++){
            $Standing = DBContext::getPlaylistRank($Playlist_Checksum, $XUIDSplit[$i]);
            $StandingArray[$i]["XUID"] = $XUIDSplit[$i];
            $StandingArray[$i]["Rank"] = $Standing->Rank;
        }
        return json_encode($StandingArray);
    }
?>