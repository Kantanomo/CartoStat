<?php
    include("../Shared/Objects/Player/Player.php");
    include '../Shared/Objects/Server/Server.php';
    include '../Shared/Objects/Match/Match.php';
    include '../Shared/Objects/Playlist/Playlist.php';
    include '../Shared/Objects/Playlist/Variant.php';
    function ProcessGameStats($filePath){
            $rawContents = file_get_contents($filePath);
            $jsonObject = json_decode($rawContents, true);
            
            
            
            $Server = null;
            if(!DBContext::serverExists($jsonObject["Server"]["XUID"])){
                $Server = new Server($jsonObject["Server"], true);
                DBContext::insertServer($Server);
            } else {
                $Server = DBContext::getServer($jsonObject["Server"]["XUID"]);
            }

            $Variant = null;
            if(!DBContext::variantExists($jsonObject["PlaylistChecksum"], $jsonObject["Variant"]["Name"])){
                $Variant = new Variant(
                    $jsonObject["PlaylistChecksum"], 
                    $jsonObject["Variant"]
                );
                DBContext::insertVariant($Variant);
            } else {
                $Variant = DBContext::getVariant($jsonObject["PlaylistChecksum"], $jsonObject["Variant"]["Name"]);
            }
            
            $match = new Match($Variant->UUID, $jsonObject["Scenario"]);
            DBContext::insertMatch($match);
            
            foreach($jsonObject["Players"] as $data){
                $Player = null;
                if(!DBContext::playerExists($data["XUID"])){
                    $Player = new Player($data);
                    DBContext::insertPlayer($Player);
                }
                $MatchPlayer = new MatchPlayer($match->UUID, $data);
                DBContext::insertMatchPlayer($MatchPlayer);
            }
            echo 'Hey, Thats pretty cool';
    }
?>