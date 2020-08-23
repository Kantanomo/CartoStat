<?php
    class MatchPlayer{
        #const emblemURI = "http://halo.bungie.net/Stats/emblem.ashx?s=120&0=%s&1=%s&2=%s&3=%s&fi=%s&bi=%s&fl=%s";
        const emblemURI = "./Emblem/emblem.php?P=%s&S=%s&EP=%s&ES=%s&EF=%s&EB=%s&ET=%s";
        public $UUID = null;
        public $Match_UUID;
        public $Player_XUID = null;
        public $Gamertag = null;
        public $EndGameIndex = null;
        public $PrimaryColor = null;
        public $SecondaryColor = null;
        public $PrimaryEmblem = null;
        public $SecondaryEmblem = null;
        public $EmblemForeground = null;
        public $EmblemBackground = null;
        public $EmblemToggle = null;
        public $PlayerModel = null;
        public $Team = null;
        public $Handicap = null;
        public $Rank = null;
        public $Nameplate = null;
        public $Place = null;
        public $Score = null;
        public $Kills = null;
        public $Assists = null;
        public $Betrayals = null;
        public $Suicides = null;
        public $BestSpree = null;
        public $ShotsFired = null;
        public $ShotsHit = null;
        public $Accuracy = null;
        public $HeadShots = null;
        public $TimeAlive = null;
        public $FlagScores = null;
        public $FlagSteals = null;
        public $FlagSaves = null;
        public $FlagUnk = null;
        public $BombScores = null;
        public $BombKills = null;
        public $BombGrabs = null;
        public $BallScore = null;
        public $BallKills = null;
        public $BallCarrierKills = null;
        public $KingKillsAsKing = null;
        public $KingKilledKings = null;
        public $JuggKilledJuggs = null;
        public $JuggKillsAsJugg = null;
        public $JuggTime = null;
        public $TerrTaken = null;
        public $TerrLost  = null;
        public $WeaponData = null;
        public $MedalData = null;
        public function __construct() {
            $get_arguments       = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct2($match_UUID, $jsonData){
           $this->UUID = UUID::v4();
           $this->Match_UUID = $match_UUID;
           $this->Player_XUID = $jsonData["XUID"];
           $this->Gamertag = $jsonData["Gamertag"];
           $this->EndGameIndex = $jsonData["EndGameIndex"];
           $this->PrimaryColor = $jsonData["PrimaryColor"];
           $this->SecondaryColor = $jsonData["SecondaryColor"];
           $this->PrimaryEmblem = $jsonData["PrimaryEmblem"];
           $this->SecondaryEmblem = $jsonData["SecondaryEmblem"];
           $this->PlayerModel = $jsonData["PlayerModel"];
           $this->EmblemForeground = $jsonData["EmblemForeground"];
           $this->EmblemBackground = $jsonData["EmblemBackground"];
           $this->EmblemToggle = $jsonData["EmblemToggle"];
           $this->Team = $jsonData["Team"];
           $this->Handicap = $jsonData["Handicap"];
           $this->Rank = $jsonData["Rank"];
           $this->Nameplate = $jsonData["Nameplate"];
           $this->Place = $jsonData["Place"];
           $this->Score = $jsonData["Score"];
           $this->Kills = $jsonData["Kills"];
           $this->Assists = $jsonData["Assists"];
           $this->Deaths = $jsonData["Deaths"];
           $this->Betrayals = $jsonData["Betrayals"];
           $this->Suicides = $jsonData["Suicides"];
           $this->BestSpree = $jsonData["BestSpree"];
           $this->ShotsFired = $jsonData["ShotsFired"];
           $this->ShotsHit = $jsonData["ShotsHit"];
           $Acc = 0;
           if($this->ShotsFired != "0" && $this->ShotsHit != "0"){
                $Acc =(round($this->ShotsHit / $this->ShotsFired, 2) * 100);
           }
           $this->Accuracy = $Acc;
           $this->HeadShots = $jsonData["HeadShots"];
           $this->TimeAlive  = $jsonData["TimeAlive"];
           $this->FlagScores = $jsonData["FlagScores"];
           $this->FlagSteals = $jsonData["FlagSteals"];
           $this->FlagSaves = $jsonData["FlagSaves"];
           $this->FlagUnk = $jsonData["FlagUnk"];
           $this->BombScores = $jsonData["BombScores"];
           $this->BombKills = $jsonData["BombKills"];
           $this->BombGrabs = $jsonData["BombGrabs"];
           $this->BallScore = $jsonData["BallScore"];
           $this->BallKills = $jsonData["BallKills"];
           $this->BallCarrierKills = $jsonData["BallCarrierKills"];
           $this->KingKillsAsKing = $jsonData["KingKillsAsKing"];  
           $this->KingKilledKings = $jsonData["KingKilledKings"];
           $this->JuggKilledJuggs = $jsonData["JuggKilledJuggs"];
           $this->JuggKillsAsJugg = $jsonData["JuggKillsAsJugg"];
           $this->JuggTime = $jsonData["JuggTime"];
           $this->TerrTaken = $jsonData["TerrTaken"];
           $this->TerrLost = $jsonData["TerrLost"];
           $this->VersusData = $jsonData["VersusData"];
           $this->WeaponData = new MatchPlayerWeapon($this->UUID, $jsonData["WeaponData"]);
           $this->MedalData = new MatchPlayerMedal($this->UUID, $jsonData["MedalData"]);
        }
        function __construct1($dataRow){
           $this->UUID = $dataRow["UUID"];
           $this->Player_XUID = $dataRow["Player_XUID"];
           $this->Gamertag = $dataRow["Gamertag"];
           $this->EndGameIndex = $dataRow["EndGameIndex"];
           $this->PrimaryColor = $dataRow["PrimaryColor"];
           $this->SecondaryColor = $dataRow["SecondaryColor"];
           $this->PrimaryEmblem = $dataRow["PrimaryEmblem"];
           $this->SecondaryEmblem = $dataRow["SecondaryEmblem"];
           $this->PlayerModel = $dataRow["PlayerModel"];
           $this->EmblemForeground = $dataRow["EmblemForeground"];
           $this->EmblemBackground = $dataRow["EmblemBackground"];
           $this->EmblemToggle = $dataRow["EmblemToggle"];
           $this->Team = $dataRow["Team"];
           $this->Handicap = $dataRow["Handicap"];
           $this->Rank = $dataRow["Rank"];
           $this->Nameplate = $dataRow["Nameplate"];
           $this->Place = $dataRow["Place"];
           $this->Score = $dataRow["Score"];
           $this->Kills = $dataRow["Kills"];
           $this->Assists = $dataRow["Assists"];
           $this->Deaths = $dataRow["Deaths"];
           $this->Betrayals = $dataRow["Betrayals"];
           $this->Suicides = $dataRow["Suicides"];
           $this->BestSpree = $dataRow["BestSpree"];
           $this->ShotsFired = $dataRow["ShotsFired"];
           $this->ShotsHit = $dataRow["ShotsHit"];
           $this->Accuracy = $dataRow["Accuracy"];
           $this->HeadShots = $dataRow["HeadShots"];
           $this->TimeAlive  = $dataRow["TimeAlive"];
           $this->FlagScores = $dataRow["FlagScores"];
           $this->FlagSteals = $dataRow["FlagSteals"];
           $this->FlagSaves = $dataRow["FlagSaves"];
           $this->FlagUnk = $dataRow["FlagUnk"];
           $this->BombScores = $dataRow["BombScores"];
           $this->BombKills = $dataRow["BombKills"];
           $this->BombGrabs = $dataRow["BombGrabs"];
           $this->BallScore = $dataRow["BallScore"];
           $this->BallKills = $dataRow["BallKills"];
           $this->BallCarrierKills = $dataRow["BallCarrierKills"];
           $this->KingKillsAsKing = $dataRow["KingKillsAsKing"];  
           $this->KingKilledKings = $dataRow["KingKilledKings"];
           $this->JuggKilledJuggs = $dataRow["JuggKilledJuggs"];
           $this->JuggKillsAsJugg = $dataRow["JuggKillsAsJugg"];
           $this->JuggTime = $dataRow["JuggTime"];
           $this->TerrTaken = $dataRow["TerrTaken"];
           $this->TerrLost = $dataRow["TerrLost"];
           $this->VersusData = json_decode($dataRow["VersusData"]);
           $this->MedalData = MatchQueries::getMatchPlayerMedal($dataRow["UUID"]);
           $this->WeaponData = MatchQueries::getMatchPlayerWeapon($dataRow["UUID"]);
        }
        public function emblemURL(){
            return sprintf(
                MatchPlayer::emblemURI,
                $this->PrimaryColor,
                $this->SecondaryColor,
                $this->PrimaryEmblem,
                $this->SecondaryEmblem,
                $this->EmblemForeground,
                $this->EmblemBackground,
                $this->EmblemToggle
            );
        }
        public function AverageLife(){
            if($this->Deaths == 0){
                return $this->TimeAlive;
            } else {
                return ceil($this->TimeAlive / $this->Deaths);
            }
        }
    }
?>