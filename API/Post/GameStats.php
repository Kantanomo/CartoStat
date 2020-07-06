<?php
    include '../Shared/Objects/Player/Player.php';
    include '../Shared/Objects/Server/Server.php';
    include '../Shared/Objects/Match/Match.php';
    function ProcessGameStats($filePath, $serverID){
        try{
            $rawContents = file_get_contents($filePath);
            $jsonObject = json_decode($rawContents);
            #$server = DBContext::getServer($serverID);
            $match = new Match();
            $match->UUID = UUID::v4();
            $match->VariantName = $jsonObject["VariantName"];
            $match->VariantType = $jsonObject["VariantType"];
            $match->ScenarionName = $jsonObject["Scenario"];
            #$match->VariantSettings = $jsonObject["VariantSettings"];
            $match->Server = DBContext::getServer($jsonObject["ServerXUID"]);
            $playerArr = array();
            foreach($jsonObjcet["Players"] as $name => $data){
                $matchPlayer = new MatchPlayer($data);
            }

        }
        catch(exception $e){
            ErrorOutAndExit('500', "There was an unsepcified issue with parsing the Game Stats");
        }
    }
?>