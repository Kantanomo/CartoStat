<?
    include './Shared/DBQueries.php';
    $Config = include('config.php');
    class DBContext {

        private static $db;
        private $connection;
        
        private function __construct() {
            $this->connection = new MySQLi(
                $Config["Host"], 
                $Config["Username"], 
                $Config["Password"], 
                $Config["DB"]
            );
        }

        function __destruct() {
            $this->connection->close();
        }

        public static function getConnection() {
            if (self::$db == null) {
                self::$db = new DBContext();
            }
            return self::$db->connection;
        }
        public static function serverExists($XUID){
            getConnection();
            $query = printf(DBQueries::existsServerQuery,
                $XUID
            );
            $result = $db->query($query);
            if($result->num_rows === 0){
                return false;
            } else {
                return true;
            }
        }
        public static function getServer($serverID){
            getConnection(); //Make sure the DBContext is initialized.
            $query = printf(DBQueries::serverQuery, $serverID);
            $result = $db->query($query);
            if($result->num_rows === 0){
                ErrorOutAndExit('500', 'Server not found');
            } else {
                return new Server($result->fetch_row());
            }
        }
        public static function playerExists($XUID){
            getConnection();
            $query = printf(
                DBQueries::existsPlayerQuery,
                $XUID
            );
            if($result->num_rows === 0){
                return false;
            } else {
                return true;
            }
        }
        public static function insertPlayer($player){
            getConnection();
            $query = printf(
                DBQueries::insertPlayerQuery,
                $player->XUID,
                mysql_real_escape_string($player->Gamertag),
                $player->PrimaryColor,
                $player->SecondaryColor,
                $player->PrimaryEmblem,
                $player->SecondaryEmblem,
                $player->EmblemForeground,
                $player->EmblemBackground,
                $player->EmblemToggle,
                $player->PlayerModel,
                $player->Nameplate
            );
            $result = $db->query($query);
            if($result === TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', 'Server experienced and error when attempting to store a new player');
            }
        }
        public static function getPlayer($playerXUID){
            getConnection(); //Make sure the DBContext is Initalized.
            $query = printf(DBQueries::selectPlayerQuery, $playerXUID);
            $result = $db->query($query);
            if($result->num_rows === 0){
                return null;
            } else {
                return new Player($result->fetch_row());
            }
        }
        public static function updatePlayer($playerXUID, $emblemArray){
            getConnection();
            $query = printf(DBQueries::updatePlayerQuery, $playerXUID, $emblemArray);

        }
        public static function getPlayerWeaponStats($playerXUID, $identifier){
            getConnection();
            $query = printf(DBQueries::selectPlayerWeaponStats, $playerXUID, $identifier);
            $result = $db->query($query);
            if($result->num_rows === 0){
                return null;
            } else {
                return new PlayerWeaponStats($result->fetch_row());
            }
        }

        public static function variantExists($playlistChecksum, $variantName){
            getConnection();
            $query = printf(
                DBQueries::existsVariantQuery,
                $playlistChecksum,
                $variantName
            );
            $result = $db->query($query);
            if($result->num_rows === 0){
                return false;
            } else {
                return true;
            }
        }
        public static function insertVariant($variant){
            getConnection();
            $query = printf(
                DBQueries::insertVariantQuery,
                $variant->UUID,
                $variant->Playlist_Checksum,
                $variant->Name,
                $variant->Type,
                mysql_real_escape_string($variant->Settings)
            );
            $result = $db->query($query);
            if($result === TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', 'Server experienced and error when attempting to store a new variant');
            }
        }
        public static function getVariant($playlistChecksum, $variantName){
            getConnection();
            $query = printf(
                DBQueries::selectVariantQuery,
                $playlistChecksum,
                $variantName
            );
            $result = $db->query($query);
            if($result->num_rows === 0){
                return null;
            } else {
                return new Variant($result->fetch_row());
            }
        }

        public static function insertMatch($match){
            getConnection();
            $query = printf(
                DBQueries::insertMatchQuery,
                $match->UUID,
                $match->Variant_UUID,
                $match->Scenario
            );
            $result = $db->query($query);
            if($result === TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', 'Server experienced and error when attempting to store a new match');
            }
        }

        public static function getMatch($UUID){
            getConnection();
            $query = printf(
                DBQueries::selectMatchQuery,
                $UUID
            );
            $result = $db->query($query);
            if($result->num_rows === 0){
                return null;
            } else {
                return new Match($result->fetch_row());
            }
        }

        public static function insertMatchPlayer($matchPlayer){
            getConnection();
            //Fuck my life.
            $query = prinf(
                DBQueries::insertMatchPlayer,
                $matchPlayer->UUID,
                $matchPlayer->Match_UUID,
                $matchPlayer->Player_XUID,
                $matchPlayer->Gamertag,
                $matchPlayer->EndGameIndex,
                $matchPlayer->PrimaryColor,
                $matchPlayer->SecondaryColor,
                $matchPlayer->PrimaryEmblem,
                $matchPlayer->SecondaryEmblem,
                $matchPlayer->EmblemForeground,
                $matchPlayer->EmblemBackground,
                $matchPlayer->EmblemToggle,
                $matchPlayer->PlayerModel,
                $matchPlayer->Team,
                $matchPlayer->Handicap,
                $matchPlayer->Rank,
                $matchPlayer->Nameplate,
                $matchPlayer->Place,
                $matchPlayer->Score,
                $matchPlayer->Kills,
                $matchPlayer->Assists,
                $matchPlayer->Betrayals,
                $matchPlayer->Suicides,
                $matchPlayer->BestSpree,
                $matchPlayer->TimeAlive,
                $matchPlayer->FlagScores,
                $matchPlayer->FlagSteals,
                $matchPlayer->FlagSaves,
                $matchPlayer->FlagUnk,
                $matchPlayer->BombScores,
                $matchPlayer->BombKills,
                $matchPlayer->BombGrabs,
                $matchPlayer->BallScore,
                $matchPlayer->BallKills,
                $matchPlayer->BallCarrierKills,
                $matchPlayer->KingKillsAsKing,
                $matchPlayer->KingKilledKings,
                $matchPlayer->JuggKilledJuggs,
                $matchPlayer->JuggKillsAsJug,
                $matchPlayer->JuggTime,
                $matchPlayer->TerrTaken,
                $matchPlayer->TerrLost
            );
            $result = $db->query($query);
            if($result === TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', 'Server experienced and error when attempting to store a new match player');
            }
        }
    }
?>