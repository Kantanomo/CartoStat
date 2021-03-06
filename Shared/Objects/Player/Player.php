<?php
    class Player {
        const emblemURI = "./Emblem/emblem.php?P=%s&S=%s&EP=%s&ES=%s&EF=%s&EB=%s&ET=%s";
        public $XUID = null;
        public $Gamertag = null;
        public $PrimaryColor = null;
        public $SecondaryColor = null;
        public $PrimaryEmblem = null;
        public $SecondaryEmblem = null;
        public $EmblemForeground = null;
        public $EmblemBackground = null;
        public $EmblemToggle = null;
        public $PlayerModel = null;
        public $Handicap = null;
        public $Nameplate = null;
        public $Kills = null;
        public $Assists = null;
        public $Betrayals = null;
        public $Suicides = null;
        public $BestSpree = null;
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
        public $WeaponStats = null;
        public $MedalStats = null;
        function __construct($data){
            $this->XUID = $data["XUID"];
            $this->Gamertag = $data["Gamertag"];
            $this->PrimaryColor = $data["PrimaryColor"];
            $this->SecondaryColor = $data["SecondaryColor"];
            $this->PrimaryEmblem = $data["PrimaryEmblem"];
            $this->SecondaryEmblem = $data["SecondaryEmblem"];
            $this->PlayerModel = $data["PlayerModel"];
            $this->EmblemForeground = $data["EmblemForeground"];
            $this->EmblemBackground = $data["EmblemBackground"];
            $this->EmblemToggle = $data["EmblemToggle"];
            //$this->Handicap = $data["Handicap"];
            $this->Nameplate = $data["Nameplate"];
            $this->Kills = $data["Kills"];
            $this->Assists = $data["Assists"];
            $this->Deaths = $data["Deaths"];
            $this->Betrayals = $data["Betrayals"];
            $this->Suicides = $data["Suicides"];
            $this->BestSpree = $data["BestSpree"];
            $this->TimeAlive  = $data["TimeAlive"];
            $this->FlagScores = $data["FlagScores"];
            $this->FlagSteals = $data["FlagSteals"];
            $this->FlagSaves = $data["FlagSaves"];
            $this->FlagUnk = $data["FlagUnk"];
            $this->BombScores = $data["BombScores"];
            $this->BombKills = $data["BombKills"];
            $this->BombGrabs = $data["BombGrabs"];
            $this->BallScore = $data["BallScore"];
            $this->BallKills = $data["BallKills"];
            $this->BallCarrierKills = $data["BallCarrierKills"];
            $this->KingKillsAsKing = $data["KingKillsAsKing"];  
            $this->KingKilledKings = $data["KingKilledKings"];
            $this->JuggKilledJuggs = $data["JuggKilledJuggs"];
            $this->JuggKillsAsJugg = $data["JuggKillsAsJugg"];
            $this->JuggTime = $data["JuggTime"];
            $this->TerrTaken = $data["TerrTaken"];
            $this->TerrLost = $data["TerrLost"];
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
        public function getMatchCount(){
            return PlayerQueries::playerMatchCount($this->XUID);
        }
    }
?>