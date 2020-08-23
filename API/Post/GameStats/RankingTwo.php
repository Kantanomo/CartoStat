<?php
    include 'RankTables.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    function GetCurrentStandings($Playlist_Checksum, $Players){
        $StandingArray = array();
        for($i = 0; $i < count($Players); $i++){
            $StandingArray[$i] = DBContext::getPlaylistRank($Playlist_Checksum, $Players[$i]["XUID"]);
        }
        return $StandingArray;
    }
    function XPToRank($XP){
        $Base = null;
        if($XP < 100){
            $Base = 0;
        } else if($XP < 1399) {
            $Base =  floor($XP / 100);
        } else if($XP < 2000 && $XP >= 1399) {   
            $Base = 12 + floor(($XP - 1399) / 200);
        } else if($XP >= 2000) {
            $Base = 16 + floor(($XP - 2000) / 250);
            if($Base >= 49){
                $Base = 49;
            }
        }
        return $Base;
    }
    function CalculateMatchResults($Variant, $Playlist_Checksum, $Players){
        //Grab all the current standings for each player in the match
        $PlayerStandings = GetCurrentStandings($Playlist_Checksum, $Players);
        //Create a store for xp gains/losses
        $XPMod = array();
        //Loop through every player
        for($x = 0; $x < count($Players); $x++){
            //Player currently being calculated
            $item = $Players[$x];
            $itemPlace = preg_replace("/[^0-9]/", "", $item["Place"]);
            $itemStanding = $PlayerStandings[$x];
            $XPMod[$x] = 0;
            //Variable used to get the average of the XP gains/losses (XPMod / Players Compared to)
            $BaseRate = 0;
            //Loop through every player to compare them to the current player
            for($y = 0; $y < count($Players); $y++){
                //Make sure we are not comparing the current player to it's self or it's team mates.
                if($x != $y && $Players[$x]["Team"] != $Players[$y]["Team"]){
                    $BaseRate++;
                    //Player being compared against
                    $compare = $Players[$y];
                    $comparePlace = preg_replace("/[^0-9]/", "", $compare["Place"]);
                    $compareStanding = $PlayerStandings[$y];
                    //calculate the difference in levels
                    $LevelDiff = abs($itemStanding->Rank - $compareStanding->Rank);
                    $ALevelDiff = null;
                    
                    //Adjust level difference to make sure it is within the allowed rank differences
                    if(RankTables::AllowedRankDiff[$itemStanding->Rank][0] > $compareStanding->Rank){
                        $ALevelDiff = abs($itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][0]);
                    } else if(RankTables::AllowedRankDiff[$itemStanding->Rank][1] < $compareStanding->Rank) {
                        $ALevelDiff = abs($itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][1]);
                    } else{
                        $ALevelDiff = $LevelDiff;
                    }

                    if($itemStanding->Rank >= $compareStanding->Rank){
                        if($itemPlace <= $comparePlace){
                            $XPGain = RankTables::DiffChart[$ALevelDiff][0];
                            $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0];
                            $XPMod[$x] += $XPGain * $Factor;
                        } else {
                            $XPGain = RankTables::DiffChart[$ALevelDiff][1] * - 1;
                            $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1];
                            $XPMod[$x] += $XPGain * $Factor;
                        }
                    } else {
                        if($itemPlace <= $comparePlace){
                            $XPGain = RankTables::DiffChart[$ALevelDiff][2];
                            $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0];
                            $XPMod[$x] += $XPGain * $Factor;
                        } else {
                            $XPGain = RankTables::DiffChart[$ALevelDiff][3] * -1;
                            $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1];
                            $XPMod[$x] += $XPGain * $Factor;
                        }
                    }
                }
            }
            $PlayerStandings[$x]->XP += $XPMod[$x] / $TeamBaseRate;
        }
        for($i = 0; $i < count($PlayerStandings); $i++){
            if($PlayerStandings[$i]->XP < 0){
                $PlayerStandings[$i]->XP = 0;
            }
            DBContext::updatePlaylistRank($PlayerStandings[$i]->XP, XPToRank($PlayerStandings[$i]->XP), $PlayerStandings[$i]->UUID);
        }
    }
?>