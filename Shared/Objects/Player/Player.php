<?php
    include './PlayerWeaponStats.php';
    class PlayerObject {
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
        public $Team = null;
        public $Handicap = null;
        public $Rank = null;
        public $Nameplate = null;
        public $Place = null;
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
        function __construct(){
        }
        function __construct1($jsonData){
            $XUID = $jsonData["XUID"];
            $Gamertag = $jsonData["Gamertag"];
            $PrimaryColor = $jsonData["PrimaryColor"];
            $SecondaryColor = $jsonData["SecondaryColor"];
            $PrimaryEmblem = $jsonData["PrimaryEmblem"];
            $SecondaryEmblem = $jsonData["SecondaryEmblem"];
            $PlayerModel = $jsonData["PlayerModel"];
            $EmblemForeground = $jsonData["EmblemForeground"];
            $EmblemBackground = $jsonData["EmblemBackground"];
            $EmblemToggle = $jsonData["EmblemToggle"];
            $Team = $jsonData["Team"];
            $Handicap = $jsonData["Handicap"];
            $Rank = $jsonData["Rank"];
            $Nameplate = $jsonData["Nameplate"];
            $Place = $jsonData["Place"];
            $Kills = $jsonData["Kills"];
            $Assists = $jsonData["Assists"];
            $Deaths = $jsonData["Deaths"];
            $Betrayals = $jsonData["Betrayals"];
            $Suicides = $jsonData["Suicides"];
            $BestSpree = $jsonData["BestSpree"];
            $TimeAlive  = $jsonData["TimeAlive"];
            $FlagScores = $jsonData["FlagScores"];
            $FlagSteals = $jsonData["FlagSteals"];
            $FlagSaves = $jsonData["FlagSaves"];
            $FlagUnk = $jsonData["FlagUnk"];
            $BombScores = $jsonData["BombScores"];
            $BombKills = $jsonData["BombKills"];
            $BombGrabs = $jsonData["BombGrabs"];
            $BallScore = $jsonData["BallScore"];
            $BallKills = $jsonData["BallKills"];
            $BallCarrierKills = $jsonData["BallCarrierKills"];
            $KingKillsAsKing = $jsonData["KingKillsAsKing"];  
            $KingKilledKings = $jsonData["KingKilledKings"];
            $JuggKilledJuggs = $jsonData["JuggKilledJuggs"];
            $JuggKillsAsJugg = $jsonData["JuggKillsAsJugg"];
            $JuggTime = $jsonData["JuggTime"];
            $TerrTaken = $jsonData["TerrTaken"];
            $TerrLost = $jsonData["TerrLost"];
        }
        function __construct2($dataRow){
            $xuid = $dataRow["xuid"];
            $playerName = $dataRow["name"];
            $emblemArray = $dataRow["emblemArray"];
        }
        function update(){
            DBContext::updatePlayer($xuid, $emblemArray);
        }
    }
?>