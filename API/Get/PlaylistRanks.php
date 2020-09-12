<?php
    function RetrievePlayerRanks($Server_XUID, $Playlist_Checksum, $Player_XUIDS){
        if(ServerQueries::serverExists($Server_XUID)){
            $Server = ServerQueries::getServer($Server_XUID);
            if($Server->RanksEnabled == 1){
                $XUIDSplit = explode (",", $Player_XUIDS);
                $StandingArray = array();
                for($i = 0; $i < count($XUIDSplit); $i++){
                    if(PlayerQueries::playerExists($XUIDSplit[$i])){
                        $Standing = PlaylistQueries::getPlaylistRank($Playlist_Checksum, $XUIDSplit[$i]);
                        $StandingArray[$i]["XUID"] = $XUIDSplit[$i];
                        $StandingArray[$i]["Rank"] = $Standing->Rank;
                    } else{
                        $StandingArray[$i]["XUID"] = $XUIDSplit[$i];
                        $StandingArray[$i]["Rank"] = "0";
                    }
                }
                return json_encode($StandingArray);
            } else {
                return "";
            }
        } else {
            return "";
        }
    }
?>