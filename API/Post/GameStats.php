<?php

    function ProcessGameStats($filePath, $XUID){
        #$start_time = microtime(true); 
        $rawContents = file_get_contents($filePath);
        $jsonObject = json_decode($rawContents, true);
        $ip = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $Server = null;
        if(!ServerQueries::serverExists($XUID)){
            #$Server = new Server($jsonObject["Server"], true);
            #ServerQueries::insertServer($Server);
            header("HTTP/1.0 500 Server not found");
            die();
        } else {
            $Server = ServerQueries::getServer($XUID);
            if($Server->IP != $ip && $Server->IP != $jsonObject["Server"]["IP"]){
                header("HTTP/1.0 500 Invalid IP");
                die();
            }
        }
        if($Server->Enabled == 1){
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
            
            if($Server->RanksEnabled == 1)
                CalculateMatchResults($Variant, $jsonObject["PlaylistChecksum"], $jsonObject["Players"]);
            unlink($filePath);
            #$end_time = microtime(true); 
            #$execution_time = ($end_time - $start_time); 
        }
    }
?>