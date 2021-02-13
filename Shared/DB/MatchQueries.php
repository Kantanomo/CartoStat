<?php
    $dir = dirname(__FILE__) . "/../Objects/Match/";
    include_once $dir . "Match.php";
    include_once $dir . "MatchPlayer.php";
    include_once $dir . "MatchPlayerMedal.php";
    include_once $dir . "MatchPlayerWeapon.php";
    include_once $dir . "MatchPlayerDamageReport.php";
    class MatchQueries{
        const existsMatchQuery = 'SELECT 1 FROM CS_Match where UUID = "%s";';
        const insertMatchQuery = 'INSERT INTO CS_Match (UUID, Variant_UUID, Scenario) Values("%s", "%s", "%s");';
        const selectMatchQuery = 'SELECT * FROM CS_Match where UUID = "%s";';
        const insertMatchPlayer = 'INSERT INTO CS_MatchPlayer VALUES("%s","%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s");';
        const selectMatchPlayerQuery = 'SELECT * FROM CS_MatchPlayer where Match_UUID = "%s";';
        const insertMatchPlayerMedalQuery = 'INSERT INTO CS_MatchPlayerMedals VALUES("%s", %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);';
        const selectMatchPlayerMedalQuery = 'SELECT * FROM CS_MatchPlayerMedals WHERE MatchPlayer_UUID = "%s";';
        const insertMatchPlayerWeaponQuery = 'INSERT INTO CS_MatchPlayerWeapon VALUES("%s", %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);';
        const selectMatchPlayerWeaponQuery = 'SELECT * FROM CS_MatchPlayerWeapon WHERE MatchPlayer_UUID = "%s";';
        const insertMatchPlayerDamageReportQuery = 'INSERT INTO CS_MatchPlayerDamageReport VALUES(null, "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s");';
        const selectMatchPlayerDamageReporyQuery = 'SELECT * FROM CS_MatchPlayerDamageReport WHERE MatchPlayer_UUID = "%s";';

        public static function matchExists($UUID){
            $query = sprintf(
                self::existsMatchQuery,
                $UUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }
        public static function insertMatch($match){
            
            $query = sprintf(
                self::insertMatchQuery,
                $match->UUID,
                $match->Variant_UUID,
                $match->Scenario
            );
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getMatch($UUID){
            
            $query = sprintf(
                self::selectMatchQuery,
                $UUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Match($result->fetch_assoc());
            }
        }
        public static function insertMatchPlayer($matchPlayer){
            
            //Fuck my life.
            $query = sprintf(
                self::insertMatchPlayer,
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
                $matchPlayer->ShotsFired,
                $matchPlayer->ShotsHit,
                $matchPlayer->Accuracy,
                $matchPlayer->HeadShots,
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
                $matchPlayer->TerrLost,
                json_encode($matchPlayer->VersusData)
            );
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                self::insertMatchPlayerMedal($matchPlayer->MedalData);
                foreach($matchPlayer->DamageData as $DamageReport => $a){
                    self::insertMatchPlayerDamageReport($a);
                }
                //self::insertMatchPlayerWeapon($matchPlayer->WeaponData);
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getMatchPlayer($UUID){
            
            $query = sprintf(
                self::selectMatchPlayerQuery,
                $UUID
            );
            $result = DBContext::getConnection()->query($query);
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
                self::insertMatchPlayerMedalQuery,
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
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getMatchPlayerMedal($UUID){
            
            $query = sprintf(
                self::selectMatchPlayerMedalQuery,
                $UUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new MatchPlayerMedal($result->fetch_row());
            }
        }

        public static function insertMatchPlayerWeapon($weapons){
            
            $query = sprintf(
                self::insertMatchPlayerWeaponQuery,
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
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function insertMatchPlayerDamageReport($damageType){
            $query = sprintf(
                self::insertMatchPlayerDamageReportQuery,
                $damageType->MatchPlayer_UUID,
                $damageType->Type,
                $damageType->Kills,
                $damageType->Deaths,
                $damageType->Betrayals,
                $damageType->Suicides,
                $damageType->ShotsFired,
                $damageType->ShotsHit,
                $damageType->Headshots
            );
            $result = DBContext::getConnection()->query($query);
            if($result == true){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", DBContext::getConnection()->error));
            }
        }

        public static function getMatchPlayerWeapon($UUID){
            
            $query = sprintf(
                self::selectMatchPlayerWeaponQuery,
                $UUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new MatchPlayerWeapon($result->fetch_assoc());
            }
        }
    }
?>