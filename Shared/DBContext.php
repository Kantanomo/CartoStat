<?
    include 'DBQueries.php';
    class DBContext {

        private static $db;
        private $connection;
        public $Config;
        
        private function __construct() {
            $this->Config = include('Config.php');
            $this->connection = new MySQLi(
                $this->Config["Host"], 
                $this->Config["Username"], 
                $this->Config["Password"], 
                $this->Config["DB"]
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
            
            $query = sprintf(DBQueries::existsServerQuery,
                $XUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }

        public static function insertServer($server){
            $query = sprintf(
                DBQueries::insertServerQuery,
                $server->XUID,
                $server->Name
            );
            $result = self::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getServer($serverID){
             //Make sure the DBContext is initialized.
            $query = sprintf(DBQueries::selectServerQuery, $serverID);
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                ErrorOutAndExit('500', 'Server not found');
            } else {
                return new Server($result->fetch_assoc(), false);
            }
        }
        public static function playerExists($XUID){
            
            $query = sprintf(
                DBQueries::existsPlayerQuery,
                $XUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }
        public static function insertPlayer($player){
            
            $query = sprintf(
                DBQueries::insertPlayerQuery,
                $player->XUID,
                $player->Gamertag,
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
            $result = self::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                #ErrorOutAndExit('500', 'Server experienced and error when attempting to store a new player');
            }
        }
        public static function getPlayer($playerXUID){
             //Make sure the DBContext is Initalized.
            $query = sprintf(DBQueries::selectPlayerQuery, $playerXUID);
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Player($result->fetch_assoc());
            }
        }
        public static function updatePlayer($playerXUID, $emblemArray){
            
            $query = sprintf(DBQueries::updatePlayerQuery, $playerXUID, $emblemArray);

        }
        public static function getPlayerWeaponStats($playerXUID, $identifier){
            
            $query = sprintf(DBQueries::selectPlayerWeaponStats, $playerXUID, $identifier);
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new PlayerWeaponStats($result->fetch_assoc());
            }
        }

        public static function variantExists($playlistChecksum, $variantName){
            $query = sprintf(
                DBQueries::existsVariantQuery,
                $playlistChecksum,
                $variantName
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }
        public static function insertVariant($variant){
            
            $query = sprintf(
                DBQueries::insertVariantQuery,
                $variant->UUID,
                $variant->Playlist_Checksum,
                $variant->Name,
                $variant->Type,
                $variant->Settings
            );
            $result = self::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                echo $query;
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }
        public static function getVariantUUID($UUID){
            $query = sprintf(
                DBQueries::selectVariantUUIDQuery,
                $UUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Variant($result->fetch_assoc());
            }
        }
        public static function getVariant($playlistChecksum, $variantName){
            
            $query = sprintf(
                DBQueries::selectVariantQuery,
                $playlistChecksum,
                $variantName
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Variant($result->fetch_assoc());
            }
        }

        public static function getPlaylist($Checksum){
            $query = sprintf(
                DBQueries::selectPlaylistQuery,
                $Checksum
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Playlist($result->fetch_assoc(), false);
            }
        }
        public static function getPlaylistUUID($UUID){
            $query = sprintf(
                DBQueries::selectPlaylistUUIDQuery,
                $UUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Playlist($result->fetch_assoc(), false);
            }
        }
        
        public static function matchExists($UUID){
            $query = sprintf(
                DBQueries::existsMatchQuery,
                $UUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }
        public static function insertMatch($match){
            
            $query = sprintf(
                DBQueries::insertMatchQuery,
                $match->UUID,
                $match->Variant_UUID,
                $match->Scenario
            );
            $result = self::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getMatch($UUID){
            
            $query = sprintf(
                DBQueries::selectMatchQuery,
                $UUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Match($result->fetch_assoc());
            }
        }

        public static function getServerMatch($UUID){
            $query = sprintf(
                DBQueries::selectServerMatchQuery,
                $UUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new ServerMatch($result->fetch_assoc());
            }
        }

        public static function insertMatchPlayer($matchPlayer){
            
            //Fuck my life.
            $query = sprintf(
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
                $matchPlayer->Deaths,
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
                $matchPlayer->JuggKillsAsJugg,
                $matchPlayer->JuggTime,
                $matchPlayer->TerrTaken,
                $matchPlayer->TerrLost
            );
            $result = self::getConnection()->query($query);
            if($result == TRUE){
                DBContext::insertMatchPlayerMedal($matchPlayer->MedalData);
                DBContext::insertMatchPlayerWeapon($matchPlayer->WeaponData);
                return true;
            } else {
                echo $query;
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getMatchPlayer($UUID){
            
            $query = sprintf(
                DBQueries::selectMatchPlayerQuery,
                $UUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                $rows = array();
                while($row = $result->fetch_assoc()) {
                    $rows[] = new MatchPlayer($row);
                }
                return $rows;
            }
        }

        public static function insertMatchPlayerMedal($medals){
            
            $query = sprintf(
                DBQueries::insertMatchPlayerMedalQuery,
                $medals->MatchPlayer_UUID,
                $medals->DoubleKill,
                $medals->TripleKill,
                $medals->Killtacular,
                $medals->KillFrenzy,
                $medals->Killamanjaro,
                $medals->SniperKill,
                $medals->RoadKill,
                $medals->BoneCracker,
                $medals->Assassin,
                $medals->VehicleDestroyed,
                $medals->CarJacking,
                $medals->StickIt,
                $medals->KillingSpree,
                $medals->RunningRiot,
                $medals->Rampage,
                $medals->Berserker,
                $medals->Overkill,
                $medals->Overkill,
                $medals->FlagTaken,
                $medals->FlagCarrierKill,
                $medals->FlagReturned,
                $medals->BombPlanted,
                $medals->BombCarrierKill,
                $medals->BombReturned,
                $medals->Unused1,
                $medals->Unused2,
                $medals->Unused3,
                $medals->Unused4,
                $medals->Unused5,
                $medals->Unused6,
                $medals->Unused7,
                $medals->Unused8
            );
            $result = self::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                echo $query;
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getMatchPlayerMedal($UUID){
            
            $query = sprintf(
                DBQueries::selectMatchPlayerMedalQuery,
                $UUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new MatchPlayerMedal($result->fetch_row());
            }
        }

        public static function insertMatchPlayerWeapon($weapons){
            
            $query = sprintf(
                DBQueries::insertMatchPlayerWeaponQuery,
                $weapons->MatchPlayer_UUID,
                $weapons->MagnumKills,
                $weapons->MagnumDeaths,
                $weapons->MagnumSuicide,
                $weapons->MagnumShotsFired,
                $weapons->MagnumShotsHit,
                $weapons->MagnumHeadshot,
                $weapons->PlasmaPistolKills,
                $weapons->PlasmaPistolDeaths,
                $weapons->PlasmaPistolSuicide,
                $weapons->PlasmaPistolShotsFired,
                $weapons->PlasmaPistolShotsHit,
                $weapons->PlasmaPistolHeadshot,
                $weapons->NeedlerKills,
                $weapons->NeedlerDeaths,
                $weapons->NeedlerSuicide,
                $weapons->NeedlerShotsFired,
                $weapons->NeedlerShotsHit,
                $weapons->NeedlerHeadshot,
                $weapons->SubMachineGunKills,
                $weapons->SubMachineGunDeaths,
                $weapons->SubMachineGunSuicide,
                $weapons->SubMachineGunShotsFired,
                $weapons->SubMachineGunShotsHit,
                $weapons->SubMachineGunHeadshot,
                $weapons->PlasmaRifleKills,
                $weapons->PlasmaRifleDeaths,
                $weapons->PlasmaRifleSuicide,
                $weapons->PlasmaRifleShotsFired,
                $weapons->PlasmaRifleShotsHit,
                $weapons->PlasmaRifleHeadshot,
                $weapons->BattleRifleKills,
                $weapons->BattleRifleDeaths,
                $weapons->BattleRifleSuicide,
                $weapons->BattleRifleShotsFired,
                $weapons->BattleRifleShotsHit,
                $weapons->BattleRifleHeadshot,
                $weapons->CarbineKills,
                $weapons->CarbineDeaths,
                $weapons->CarbineSuicide,
                $weapons->CarbineShotsFired,
                $weapons->CarbineShotsHit,
                $weapons->CarbineHeadshot,
                $weapons->ShotgunKills,
                $weapons->ShotgunDeaths,
                $weapons->ShotgunSuicide,
                $weapons->ShotgunShotsFired,
                $weapons->ShotgunShotsHit,
                $weapons->ShotgunHeadshot,
                $weapons->SniperRifleKills,
                $weapons->SniperRifleDeaths,
                $weapons->SniperRifleSuicide,
                $weapons->SniperRifleShotsFired,
                $weapons->SniperRifleShotsHit,
                $weapons->SniperRifleHeadshot,
                $weapons->BeamRifleKills,
                $weapons->BeamRifleDeaths,
                $weapons->BeamRifleSuicide,
                $weapons->BeamRifleShotsFired,
                $weapons->BeamRifleShotsHit,
                $weapons->BeamRifleHeadshot,
                $weapons->BrutePlasmaRifleKills,
                $weapons->BrutePlasmaRifleDeaths,
                $weapons->BrutePlasmaRifleSuicide,
                $weapons->BrutePlasmaRifleShotsFired,
                $weapons->BrutePlasmaRifleShotsHit,
                $weapons->BrutePlasmaRifleHeadshot,
                $weapons->RocketLauncherKills,
                $weapons->RocketLauncherDeaths,
                $weapons->RocketLauncherSuicide,
                $weapons->RocketLauncherShotsFired,
                $weapons->RocketLauncherShotsHit,
                $weapons->RocketLauncherHeadshot,
                $weapons->FuelRodCannonKills,
                $weapons->FuelRodCannonDeaths,
                $weapons->FuelRodCannonSuicide,
                $weapons->FuelRodCannonShotsFired,
                $weapons->FuelRodCannonShotsHit,
                $weapons->FuelRodCannonHeadshot,
                $weapons->BruteshotKills,
                $weapons->BruteshotDeaths,
                $weapons->BruteshotSuicide,
                $weapons->BruteshotShotsFired,
                $weapons->BruteshotShotsHit,
                $weapons->BruteshotHeadshot,
                $weapons->Unused1Kills,
                $weapons->Unused1Deaths,
                $weapons->Unused1Suicide,
                $weapons->Unused1ShotsFired,
                $weapons->Unused1ShotsHit,
                $weapons->Unused1Headshot,
                $weapons->SentinalBeamKills,
                $weapons->SentinalBeamDeaths,
                $weapons->SentinalBeamSuicide,
                $weapons->SentinalBeamShotsFired,
                $weapons->SentinalBeamShotsHit,
                $weapons->SentinalBeamHeadshot,
                $weapons->Unused2Kills,
                $weapons->Unused2Deaths,
                $weapons->Unused2Suicide,
                $weapons->Unused2ShotsFired,
                $weapons->Unused2ShotsHit,
                $weapons->Unused2Headshot,
                $weapons->EnergySwordKills,
                $weapons->EnergySwordDeaths,
                $weapons->EnergySwordSuicide,
                $weapons->EnergySwordShotsFired,
                $weapons->EnergySwordShotsHit,
                $weapons->EnergySwordHeadshot,
                $weapons->FragGrenadeKills,
                $weapons->FragGrenadeDeaths,
                $weapons->FragGrenadeSuicide,
                $weapons->FragGrenadeShotsFired,
                $weapons->FragGrenadeShotsHit,
                $weapons->FragGrenadeHeadshot,
                $weapons->PlasmaGrenadeKills,
                $weapons->PlasmaGrenadeDeaths,
                $weapons->PlasmaGrenadeSuicide,
                $weapons->PlasmaGrenadeShotsFired,
                $weapons->PlasmaGrenadeShotsHit,
                $weapons->PlasmaGrenadeHeadshot,
                $weapons->CTFFlagKills,
                $weapons->CTFFlagDeaths,
                $weapons->CTFFlagSuicide,
                $weapons->CTFFlagShotsFired,
                $weapons->CTFFlagShotsHit,
                $weapons->CTFFlagHeadshot,
                $weapons->AssaultBombKills,
                $weapons->AssaultBombDeaths,
                $weapons->AssaultBombSuicide,
                $weapons->AssaultBombShotsFired,
                $weapons->AssaultBombShotsHit,
                $weapons->AssaultBombHeadshot,
                $weapons->OddballSkullKills,
                $weapons->OddballSkullDeaths,
                $weapons->OddballSkullSuicide,
                $weapons->OddballSkullShotsFired,
                $weapons->OddballSkullShotsHit,
                $weapons->OddballSkullHeadshot,
                $weapons->HumanTurretKills,
                $weapons->HumanTurretDeaths,
                $weapons->HumanTurretSuicide,
                $weapons->HumanTurretShotsFired,
                $weapons->HumanTurretShotsHit,
                $weapons->HumanTurretHeadshot,
                $weapons->CovenantTurretKills,
                $weapons->CovenantTurretDeaths,
                $weapons->CovenantTurretSuicide,
                $weapons->CovenantTurretShotsFired,
                $weapons->CovenantTurretShotsHit,
                $weapons->CovenantTurretHeadshot,
                $weapons->BansheeKills,
                $weapons->BansheeDeaths,
                $weapons->BansheeSuicide,
                $weapons->BansheeShotsFired,
                $weapons->BansheeShotsHit,
                $weapons->BansheeHeadshot,
                $weapons->GhostKills,
                $weapons->GhostDeaths,
                $weapons->GhostSuicide,
                $weapons->GhostShotsFired,
                $weapons->GhostShotsHit,
                $weapons->GhostHeadshot,
                $weapons->Unused3Kills,
                $weapons->Unused3Deaths,
                $weapons->Unused3Suicide,
                $weapons->Unused3ShotsFired,
                $weapons->Unused3ShotsHit,
                $weapons->Unused3Headshot,
                $weapons->ScorpionTurretKills,
                $weapons->ScorpionTurretDeaths,
                $weapons->ScorpionTurretSuicide,
                $weapons->ScorpionTurretShotsFired,
                $weapons->ScorpionTurretShotsHit,
                $weapons->ScorpionTurretHeadshot,
                $weapons->SpectreDriverKills,
                $weapons->SpectreDriverDeaths,
                $weapons->SpectreDriverSuicide,
                $weapons->SpectreDriverShotsFired,
                $weapons->SpectreDriverShotsHit,
                $weapons->SpectreDriverHeadshot,
                $weapons->SpectreTurrentKills,
                $weapons->SpectreTurrentDeaths,
                $weapons->SpectreTurrentSuicide,
                $weapons->SpectreTurrentShotsFired,
                $weapons->SpectreTurrentShotsHit,
                $weapons->SpectreTurrentHeadshot,
                $weapons->WarthogDriverKills,
                $weapons->WarthogDriverDeaths,
                $weapons->WarthogDriverSuicide,
                $weapons->WarthogDriverShotsFired,
                $weapons->WarthogDriverShotsHit,
                $weapons->WarthogDriverHeadshot,
                $weapons->WarthogTurretKills,
                $weapons->WarthogTurretDeaths,
                $weapons->WarthogTurretSuicide,
                $weapons->WarthogTurretShotsFired,
                $weapons->WarthogTurretShotsHit,
                $weapons->WarthogTurretHeadshot,
                $weapons->WraithKills,
                $weapons->WraithDeaths,
                $weapons->WraithSuicide,
                $weapons->WraithShotsFired,
                $weapons->WraithShotsHit,
                $weapons->WraithHeadshot,
                $weapons->ScorpionCannonKills,
                $weapons->ScorpionCannonDeaths,
                $weapons->ScorpionCannonSuicide,
                $weapons->ScorpionCannonShotsFired,
                $weapons->ScorpionCannonShotsHit,
                $weapons->ScorpionCannonHeadshot,
                $weapons->AssultBombKills,
                $weapons->AssultBombDeaths,
                $weapons->AssultBombSuicide,
                $weapons->AssultBombShotsFired,
                $weapons->AssultBombShotsHit,
                $weapons->AssultBombHeadshot,
                $weapons->AssultBombKills,
                $weapons->AssultBombDeaths,
                $weapons->AssultBombSuicide,
                $weapons->AssultBombShotsFired,
                $weapons->AssultBombShotsHit,
                $weapons->AssultBombHeadshot,
            );
            $result = self::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getMatchPlayerWeapon($UUID){
            
            $query = sprintf(
                DBQueries::selectMatchPlayerWeaponQuery,
                $UUID
            );
            $result = self::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new MatchPlayerWeapon($result->fetch_assoc());
            }
        }
    }
?>