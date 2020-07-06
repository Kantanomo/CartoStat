<?php
    include '.../Shared/Objects/Player/Player.php';
    include '.../Shared/Objects/Server/Server.php';
    include '.../Shared/Objects/Match/Match.php';
    include '.../Shared/Objects/Playlist/Playlist.php';
    include '.../Shared/Objects/Playlist/Variant.php';
    function ProcessGameStats($filePath, $serverID){
        try{
            $rawContents = file_get_contents($filePath);
            $jsonObject = json_decode($rawContents);
            
            
            
            $Server = null;
            if(!DBContext::serverExists($jsonObject["Server"]["XUID"])){
                $Server = new Server($jsonObject["Server"]);
                DBContext::insertServer($Server);
            } else {
                $Server = DBContext::getServer($jsonObject["Server"]["XUID"]);
            }

            $Variant = null;
            if(!DBContext::variantExists($jsonObject["PlaylistChecksum"], $jsonObject["Variant"]["VariantName"])){
                $Variant = new Variant(
                    $jsonObject["PlaylistChecksum"], 
                    $jsonObject["Variant"]
                );
                DBContext::insertVariant($Variant);
            } else {
                $Variant = DBContext::getVariant($jsonObject["PlaylistChecksum"], $jsonObject["Variant"]["VariantName"]);
            }

            $match = new Match($Variant->UUID, $jsonObject["Scenario"]);
            DBContext::insertMatch($match);

            foreach($jsonObject["Players"] as $name => $data){
                $Player = null;
                if(!DBContext::playerExists($data["XUID"])){
                    $Player = new Player($data);
                    DBContext::insertPlayer($Player);
                }
                $MatchPlayer = new MatchPlayer($match->UUID, $data);
                DBContext::insertMatchPlayer($Variant->UUID, $MatchPlayer);
            }

        }
        catch(exception $e){
            ErrorOutAndExit('500', "There was an unsepcified issue with parsing the Game Stats");
        }
    }
?>