<?php
    include 'RankTables.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    $GLOBALS["LOGGING"] = FALSE;
    error_reporting(E_ALL);
    function GetCurrentStandings($Playlist_Checksum, $Players){
        $StandingArray = array();
        for($i = 0; $i < count($Players); $i++){
            $StandingArray[$i] = PlaylistQueries::getPlaylistRank($Playlist_Checksum, $Players[$i]["XUID"]);
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
        $PlayerStandings = GetCurrentStandings($Playlist_Checksum, $Players);
        $XPMod = array();
        $BaseRate = count($Players) - 1;
        if($BaseRate == 0)
            $BaseRate = 1;
        if($Variant->Settings["Team Play"] == "1"){
            if($GLOBALS["LOGGING"])
                $myfile = fopen($Playlist_Checksum . strtotime("10 September 2000") . ".txt", "w");
            for($x = 0; $x < count($Players); $x++){
                $item = $Players[$x];
                $itemPlace = preg_replace("/[^0-9]/", "", $item["Place"]);
                $itemStanding = $PlayerStandings[$x];
                $XPMod[$x] = 0;
                $TeamBaseRate = 0;
                if($GLOBALS["LOGGING"])
                    fwrite($myfile, "Calculating Stats for " . $item["Gamertag"] . "\n");
                for($y = 0; $y < count($Players); $y++){
                    if($x != $y && $Players[$x]["Team"] != $Players[$y]["Team"]){
                        $TeamBaseRate++;
                        $compare = $Players[$y];
                        $comparePlace = preg_replace("/[^0-9]/", "", $compare["Place"]);
                        $compareStanding = $PlayerStandings[$y];
                        $LevelDiff = abs($itemStanding->Rank - $compareStanding->Rank);
                        $ALevelDiff = null;
                        if(RankTables::AllowedRankDiff[$itemStanding->Rank][0] > $compareStanding->Rank){
                            $ALevelDiff = abs($itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][0]);
                        } else if(RankTables::AllowedRankDiff[$itemStanding->Rank][1] < $compareStanding->Rank) {
                            $ALevelDiff = abs($itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][1]);
                        } else{
                            $ALevelDiff = $LevelDiff;
                        }
                        if($GLOBALS["LOGGING"]){
                            fwrite($myfile, "Comparing: " . $item["Gamertag"] . " To: " . $compare["Gamertag"] . "\n");
                            fwrite($myfile, $item["Gamertag"] . " Rank: " . $itemStanding->Rank . " " . $compare["Gamertag"] . " Rank: " . $compareStanding->Rank . "\n");
                            fwrite($myfile, "\tLevelDifferences: " . $ALevelDiff . "\n");
                        }
                        if($itemStanding->Rank >= $compareStanding->Rank){
                            if($itemPlace <= $comparePlace){
                                $XPGain = RankTables::DiffChart[$ALevelDiff][0];
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0];
                                $XPMod[$x] += $XPGain * $Factor;
                                if($GLOBALS["LOGGING"]){
                                    fwrite($myfile, "\tHigher Win" . "\n");
                                    fwrite($myfile, "\t\tXP Gain(" . $compare["Gamertag"] . "): " . $XPGain . "\n");
                                    fwrite($myfile, "\t\tXP Factor(" . $compare["Gamertag"] . "): " . $Factor . "\n");
                                    fwrite($myfile, "\t\tXP Computed(" . $compare["Gamertag"] . "): " . $XPGain * $Factor . "\n");
                                }
                            } else {
                                $XPGain = RankTables::DiffChart[$ALevelDiff][1] * - 1;
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1];
                                $XPMod[$x] += $XPGain * $Factor;
                                if($GLOBALS["LOGGING"]){
                                    fwrite($myfile, "\tHigher Loss" . "\n");
                                    fwrite($myfile, "\t\tXP Loss(" . $compare["Gamertag"] . "): " . $XPGain . "\n");
                                    fwrite($myfile, "\t\tXP Factor(" . $compare["Gamertag"] . "): " . $Factor . "\n");
                                    fwrite($myfile, "\t\tXP Computed(" . $compare["Gamertag"] . "): " . $XPGain * $Factor . "\n");
                                }
                            }
                        } else {
                            if($itemPlace <= $comparePlace){
                                $XPGain = RankTables::DiffChart[$ALevelDiff][2];
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0];
                                $XPMod[$x] += $XPGain * $Factor;
                                if($GLOBALS["LOGGING"]){
                                    fwrite($myfile, "\tLower Win" . "\n");
                                    fwrite($myfile, "\t\tXP Gain(" . $compare["Gamertag"] . "): " . $XPGain . "\n");
                                    fwrite($myfile, "\t\tXP Factor(" . $compare["Gamertag"] . "): " . $Factor . "\n");
                                    fwrite($myfile, "\t\tXP Computed(" . $compare["Gamertag"] . "): " . $XPGain * $Factor . "\n");
                                }
                            } else {
                                $XPGain = RankTables::DiffChart[$ALevelDiff][3] * -1;
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1];
                                $XPMod[$x] += $XPGain * $Factor;
                                if($GLOBALS["LOGGING"]){
                                    fwrite($myfile, "\tLower Loss" . "\n");
                                    fwrite($myfile, "\t\tXP Loss(" . $compare["Gamertag"] . "): " . $XPGain . "\n");
                                    fwrite($myfile, "\t\tXP Factor(" . $compare["Gamertag"] . "): " . $Factor . "\n");
                                    fwrite($myfile, "\t\tXP Computed(" . $compare["Gamertag"] . "): " . $XPGain * $Factor . "\n");
                                }
                            }
                        }
                    }
                }
                if($GLOBALS["LOGGING"]){
                    fwrite($myfile, $TeamBaseRate . "\n");
                    fwrite($myfile, $Players[$x]["Gamertag"] . " Rank: " . XPToRank($PlayerStandings[$x]->XP) . " Previous XP: " . $PlayerStandings[$x]->XP . " New Xp: " . ($PlayerStandings[$x]->XP + $XPMod[$x] / $TeamBaseRate) . " New Rank:" . XPToRank(($PlayerStandings[$x]->XP + $XPMod[$x] / $TeamBaseRate)) . " Gained XP: " . ($XPMod[$x] / $TeamBaseRate) . "\r\n");
                }
                $PlayerStandings[$x]->XP += $XPMod[$x] / $TeamBaseRate;
            }
            if($GLOBALS["LOGGING"]){
                fclose($myfile);
            }
            for($i = 0; $i < count($PlayerStandings); $i++){
                
                if($PlayerStandings[$i]->XP < 0){
                    $PlayerStandings[$i]->XP = 0;
                }
                PlaylistQueries::updatePlaylistRank($PlayerStandings[$i]->XP, XPToRank($PlayerStandings[$i]->XP), $PlayerStandings[$i]->UUID);
            }
        } else {
            if($GLOBALS["LOGGING"]){
                $myfile = fopen($Playlist_Checksum . strtotime("10 September 2000") . ".txt", "w");
            }
            for($x = 0; $x < count($Players); $x++){
                $item = $Players[$x];
                $itemPlace = preg_replace("/[^0-9]/", "", $item["Place"]);
                $itemStanding = $PlayerStandings[$x];
                $XPMod[$x] = 0;
                if($GLOBALS["LOGGING"]){
                    fwrite($myfile, "Calculating Stats for " . $item["Gamertag"] . "\n");
                }
                for($y = 0; $y < count($Players); $y++){
                    if($x != $y){
                        $compare = $Players[$y];
                        $comparePlace = preg_replace("/[^0-9]/", "", $compare["Place"]);
                        $compareStanding = $PlayerStandings[$y];
                        $LevelDiff = abs($itemStanding->Rank - $compareStanding->Rank);
                        $ALevelDiff = null;
                        if(RankTables::AllowedRankDiff[$itemStanding->Rank][0] > $compareStanding->Rank){
                            $ALevelDiff = abs($itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][0]);
                        } else if(RankTables::AllowedRankDiff[$itemStanding->Rank][1] < $compareStanding->Rank) {
                            $ALevelDiff = abs($itemStanding->Rank - RankTables::AllowedRankDiff[$itemStanding->Rank][1]);
                        } else{
                            $ALevelDiff = $LevelDiff;
                        }
                        if($GLOBALS["LOGGING"]){
                            fwrite($myfile, "Comparing: " . $item["Gamertag"] . " To: " . $compare["Gamertag"] . "\n");
                            fwrite($myfile, $item["Gamertag"] . " Rank: " . $itemStanding->Rank . " " . $compare["Gamertag"] . " Rank: " . $compareStanding->Rank . "\n");
                            fwrite($myfile, "\tLevelDifferences: " . $ALevelDiff . "\n");
                        }

                        if($itemStanding->Rank >= $compareStanding->Rank){
                            if($itemPlace <= $comparePlace){
                                 //RankTables::WinLostFactors[PlayerRank]([0] Win Factor)([1] Loss Factor)
                                 //RankTables::DiffChart[Diff]  ([0]Higher Win)([1]Higher Loss)([2]Lower Win)([3]Lower Loss)
                                 //RankTables::AllowdRankDiff[PlayerRank]([0] Lowest)([1] Highest)  
                                $XPGain = RankTables::DiffChart[$ALevelDiff][0]; //Higher Win
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0]; //WinLoss Win Factor
                                $XPMod[$x] += $XPGain * $Factor;
                                if($GLOBALS["LOGGING"]){
                                    fwrite($myfile, "\tHigher Win" . "\n");
                                    fwrite($myfile, "\t\tXP Gain(" . $compare["Gamertag"] . "): " . $XPGain . "\n");
                                    fwrite($myfile, "\t\tXP Factor(" . $compare["Gamertag"] . "): " . $Factor . "\n");
                                    fwrite($myfile, "\t\tXP Computed(" . $compare["Gamertag"] . "): " . $XPGain * $Factor . "\n");
                                }
                            } else {
                                $XPGain = RankTables::DiffChart[$ALevelDiff][1] * -1; //Higher Loss
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1]; //Loss Factor
                                $XPMod[$x] += $XPGain * $Factor;
                                if($GLOBALS["LOGGING"]){
                                    fwrite($myfile, "\tHigher Loss" . "\n");
                                    fwrite($myfile, "\t\tXP Loss(" . $compare["Gamertag"] . "): " . $XPGain . "\n");
                                    fwrite($myfile, "\t\tXP Factor(" . $compare["Gamertag"] . "): " . $Factor . "\n");
                                    fwrite($myfile, "\t\tXP Computed(" . $compare["Gamertag"] . "): " . $XPGain * $Factor . "\n");
                                }
                            }
                        } else {
                            if($itemPlace <= $comparePlace){
                                $XPGain = RankTables::DiffChart[$ALevelDiff][2]; //Lower Win
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][0]; //Win Factor
                                $XPMod[$x] += $XPGain * $Factor;
                                if($GLOBALS["LOGGING"]){
                                    fwrite($myfile, "\tLower Win" . "\n");
                                    fwrite($myfile, "\t\tXP Gain(" . $compare["Gamertag"] . "): " . $XPGain . "\n");
                                    fwrite($myfile, "\t\tXP Factor(" . $compare["Gamertag"] . "): " . $Factor . "\n");
                                    fwrite($myfile, "\t\tXP Computed(" . $compare["Gamertag"] . "): " . $XPGain * $Factor . "\n");
                                }
                            } else {
                                $XPGain = RankTables::DiffChart[$ALevelDiff][3] * - 1; //Lower Loss
                                $Factor = RankTables::WinLossFactors[$itemStanding->Rank][1]; //Loss Factor
                                $XPMod[$x] += $XPGain * $Factor;
                                if($GLOBALS["LOGGING"]){
                                    fwrite($myfile, "\tLower Loss" . "\n");
                                    fwrite($myfile, "\t\tXP Loss(" . $compare["Gamertag"] . "): " . $XPGain . "\n");
                                    fwrite($myfile, "\t\tXP Factor(" . $compare["Gamertag"] . "): " . $Factor . "\n");
                                    fwrite($myfile, "\t\tXP Computed(" . $compare["Gamertag"] . "): " . $XPGain * $Factor . "\n");
                                }
                            }
                        }
                    }
                }
            }
            
            for($i = 0; $i < count($PlayerStandings); $i++){
                if($GLOBALS["LOGGING"]){
                    $txt = $Players[$i]["Gamertag"] . " Rank: " . XPToRank($PlayerStandings[$i]->XP) . " Previous XP: " . $PlayerStandings[$i]->XP . " New Xp: " . ($PlayerStandings[$i]->XP + $XPMod[$i] / $BaseRate) . " New Rank:" . XPToRank(($PlayerStandings[$i]->XP + $XPMod[$i] / $BaseRate)) . " Gained XP: " . ($XPMod[$i] / $BaseRate) . "\r\n";
                    fwrite($myfile, $txt);
                }
                $PlayerStandings[$i]->XP += $XPMod[$i] / $BaseRate;
                if($PlayerStandings[$i]->XP < 0){
                    $PlayerStandings[$i]->XP = 0;
                }
                
                PlaylistQueries::updatePlaylistRank($PlayerStandings[$i]->XP, XPToRank($PlayerStandings[$i]->XP), $PlayerStandings[$i]->UUID);
            }
            if($GLOBALS["LOGGING"]){
                fclose($myfile);
            }
        }
    }
?>