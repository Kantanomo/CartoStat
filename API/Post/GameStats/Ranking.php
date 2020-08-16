<?php
    include 'RankTables.php';
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
            $Base = 1;
        } else if($XP < 1399) {
            $Base =  1 + floor($XP / 100);
        } else if($XP < 2000 && $XP >= 1399) {   
            $Base = 13 + floor(($XP - 1399) / 200);
        } else if($XP >= 2000) {
            $Base = 17 + floor(($XP - 2000) / 250);
            if($Base >= 50){
                $Base = 50;
            }
        }
        return $Base;
    }
    function CalculateMatchResults($Variant, $Playlist_Checksum, $Players){
        $PlayerStandings = GetCurrentStandings($Playlist_Checksum, $Players);
        $BaseRate = count($Players) - 1;
        if($BaseRate == 0)
            $BaseRate = 1;
        if($Variant->Settings["Team Play"] == "1"){
        
            for($x = 0; $x < count($Players); $x++){
                for($y = 0; $y < count($Players); $y++){
                    //No need to compare against current item
                    if($x != $y && $Players[$x]["Team"] != $Players[$y]["Team"]){
                        $item = $Players[$x];
                        $itemPlace = preg_replace("/[^0-9]/", "", $item["Place"]);
                        $itemStanding = $PlayerStandings[$x];
                        $compare = $Players[$y];
                        $comparePlace = preg_replace("/[^0-9]/", "", $compare["Place"]);
                        $compareStanding = $PlayerStandings[$y];
                        $LevelDiff = abs($itemStanding->Rank - $compareStanding->Rank);
                        $ALevelDiff = null;
                        if(RankTables::AllowedRankDiff[$itemStanding->Rank][0] > $compareStanding->Rank){
                            $ALevelDiff = $itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][0];
                        } else if(RankTables::AllowedRankDiff[$itemStanding->Rank][1] < $compareStanding->Rank) {
                            $ALevelDiff = $itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][1];
                        } else{
                            $ALevelDiff = $LevelDiff;
                        }
                        if($itemStanding->Rank >= $compareStanding->Rank){
                            if($itemPlace <= $comparePlace){
                                $XPGain = RankTables::DiffChart[$ALevelDiff][0];
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1];
                                $itemStanding->XP += ($XPGain * $Factor) / $BaseRate;
                            } else {
                                $XPGain = RankTables::DiffChart[$ALevelDiff][1] * - 1;
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0];
                                $itemStanding->XP += ($XPGain * $Factor) / $BaseRate;
                            }
                        } else {
                            if($itemPlace <= $comparePlace){
                                $XPGain = RankTables::DiffChart[$ALevelDiff][2];
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1];
                                $itemStanding->XP += ($XPGain * $Factor) / $BaseRate;
                            } else {
                                $XPGain = RankTables::DiffChart[$ALevelDiff][3] * -1;
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0];
                                $itemStanding->XP += ($XPGain * $Factor) / $BaseRate;
                            }
                        }
                    }
                }
            }
            for($i = 0; $i < count($PlayerStandings); $i++){
                if($PlayerStandings[$i]->XP < 0){
                    $PlayerStandings[$i]->XP = 0;
                }
                DBContext::updatePlaylistRank($PlayerStandings[$i]->XP, XPToRank($PlayerStandings[$i]->XP), $PlayerStandings[$i]->UUID);
            }
        } else {
            for($x = 0; $x < count($Players); $x++){
                for($y = 0; $y < count($Players); $y++){
                    //No need to compare against current item
                    if($x != $y){
                        $item = $Players[$x];
                        $itemPlace = preg_replace("/[^0-9]/", "", $item["Place"]);
                        $itemStanding = $PlayerStandings[$x];
                        $compare = $Players[$y];
                        $comparePlace = preg_replace("/[^0-9]/", "", $compare["Place"]);
                        $compareStanding = $PlayerStandings[$y];
                        $LevelDiff = abs($itemStanding->Rank - $compareStanding->Rank);
                        $ALevelDiff = null;
                        if(RankTables::AllowedRankDiff[$itemStanding->Rank][0] > $compareStanding->Rank){
                            $ALevelDiff = $itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][0];
                        } else if(RankTables::AllowedRankDiff[$itemStanding->Rank][1] < $compareStanding->Rank) {
                            $ALevelDiff = $itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][1];
                        } else{
                            $ALevelDiff = $LevelDiff;
                        }
                        if($itemStanding->Rank >= $compareStanding->Rank){
                            if($itemPlace <= $comparePlace){
                                $XPGain = RankTables::DiffChart[$ALevelDiff][0];
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1];
                                $itemStanding->XP += ($XPGain * $Factor) / $BaseRate;
                            } else {
                                $XPGain = RankTables::DiffChart[$ALevelDiff][1] * -1;
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0];
                                $itemStanding->XP += ($XPGain * $Factor) / $BaseRate;
                            }
                        } else {
                            if($itemPlace <= $comparePlace){
                                $XPGain = RankTables::DiffChart[$ALevelDiff][2];
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1];
                                $itemStanding->XP += ($XPGain * $Factor) / $BaseRate;
                            } else {
                                $XPGain = RankTables::DiffChart[$ALevelDiff][3] * - 1;
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0];
                                $itemStanding->XP += ($XPGain * $Factor) / $BaseRate;
                            }
                        }
                    }
                }
            }
            for($i = 0; $i < count($PlayerStandings); $i++){
                if($PlayerStandings[$i]->XP < 0){
                    $PlayerStandings[$i]->XP = 0;
                }
                DBContext::updatePlaylistRank($PlayerStandings[$i]->XP, XPToRank($PlayerStandings[$i]->XP), $PlayerStandings[$i]->UUID);
            }
        }
    }
?>