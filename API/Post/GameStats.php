<?php

    function ProcessGameStats($filePath){
        #$start_time = microtime(true); 
        $rawContents = file_get_contents($filePath);
        $jsonObject = json_decode($rawContents, true);
        
        $Server = null;
        if(!ServerQueries::serverExists($jsonObject["Server"]["XUID"])){
            $Server = new Server($jsonObject["Server"], true);
            ServerQueries::insertServer($Server);
        } else {
            $Server = ServerQueries::getServer($jsonObject["Server"]["XUID"]);
        }

        $Variant = null;
        if(!PlaylistQueries::variantExists($jsonObject["PlaylistChecksum"], $jsonObject["Variant"]["Name"])){
            $Variant = new Variant(
                $jsonObject["PlaylistChecksum"], 
                $jsonObject["Variant"]
            );
            PlaylistQueries::insertVariant($Variant);
        } else {
            $Variant = PlaylistQueries::getVariant($jsonObject["PlaylistChecksum"], $jsonObject["Variant"]["Name"]);
        }
        
        $match = new Match($Variant->UUID, $jsonObject["Scenario"]);
        MatchQueries::insertMatch($match);
        
        $serverMatch = new ServerMatch($match->UUID, $Server->XUID);
        ServerQueries::insertServerMatch($serverMatch);

        foreach($jsonObject["Players"] as $data){
            $Player = null;
            if(!PlayerQueries::playerExists($data["XUID"])){
                $Player = new Player($data);
                PlayerQueries::insertPlayer($Player);
            }
            $MatchPlayer = new MatchPlayer($match->UUID, $data);
            MatchQueries::insertMatchPlayer($MatchPlayer);
        }
        
        if($Server->Enabled == 1)
            CalculateMatchResults($Variant, $jsonObject["PlaylistChecksum"], $jsonObject["Players"]);
        #$end_time = microtime(true); 
        #$execution_time = ($end_time - $start_time); 
        echo 'Hey, Thats pretty cool';
    }
?>