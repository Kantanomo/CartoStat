DELIMITER $$
CREATE TRIGGER PlayerInsert AFTER INSERT ON `CS_Player` 
    FOR EACH ROW
        begin
            DECLARE UUID_Exists Boolean;
            SELECT 1
            INTO @UUID_Exists
            FROM CS_Player
            Where CS_Player.XUID = NEW.XUID;

            IF @UUID_Exists THEN
                INSERT INTO CS_PlayerMedals (Player_XUID) VALUES(NEW.XUID);
                INSERT INTO CS_PlayerWeapon (Player_XUID) VALUES(NEW.XUID);
            END IF;
        end;
    $$
CREATE TRIGGER MatchPlayerInsert AFTER INSERT ON `CS_MatchPlayer`
    FOR EACH ROW
        BEGIN
            DECLARE XUID_Exists Boolean;
            SELECT 1
            INTO @XUID_Exists
            FROM CS_Player
            WHERE CS_Player.XUID = NEW.Player_XUID;

            IF @XUID_Exists THEN
                UPDATE CS_Player
                SET
                    CS_Player.Kills = CS_Player.Kills + NEW.Kills,
                    CS_Player.Deaths = CS_Player.Deaths + NEW.Deaths,
                    CS_Player.Assists = CS_Player.Assists + NEW.Assists,
                    CS_Player.Betrayals = CS_Player.Betrayals + NEW.Assists,
                    CS_Player.Suicides = CS_Player.Suicides + NEW.Suicides,
                    CS_Player.ShotsFired = CS_Player.ShotsFired + NEW.ShotsFired,
                    CS_Player.ShotsHit = CS_Player.ShotsHit + NEW.ShotsHit,
                    CS_Player.HeadShots = CS_Player.HeadShots + NEW.HeadShots,
                    CS_Player.TimeAlive = CS_Player.TimeAlive + NEW.TimeAlive,
                    CS_Player.FlagScores = CS_Player.FlagScores + NEW.FlagScores,
                    CS_Player.FlagSteals = CS_Player.FlagSteals + NEW.FlagSteals,
                    CS_Player.FlagSaves = CS_Player.FlagSaves + NEW.FlagSaves,
                    CS_Player.FlagUnk = CS_Player.FlagUnk + NEW.FlagUnk,
                    CS_Player.BombScores = CS_Player.BombScores + NEW.BombScores,
                    CS_Player.BombKills = CS_Player.BombKills + NEW.BombKills,
                    CS_Player.BombGrabs = CS_Player.BombGrabs + NEW.BombGrabs,
                    CS_Player.BallScore = CS_Player.BallScore + NEW.BallScore,
                    CS_Player.BallKills = CS_Player.BallKills + NEW.BallKills,
                    CS_Player.BallCarrierKills = CS_Player.BallCarrierKills + NEW.BallCarrierKills,
                    CS_Player.KingKillsAsKing = CS_Player.KingKillsAsKing + NEW.KingKillsAsKing,
                    CS_Player.KingKilledKings = CS_Player.KingKilledKings + NEW.KingKilledKings,
                    CS_Player.JuggKilledJuggs = CS_Player.JuggKilledJuggs + NEW.JuggKilledJuggs,
                    CS_Player.JuggKillsAsJugg = CS_Player.JuggKillsAsJugg + NEW.JuggKillsAsJugg,
                    CS_Player.JuggTime = CS_Player.JuggTime + NEW.JuggTime,
                    CS_Player.TerrTaken = CS_Player.TerrTaken + NEW.TerrTaken,
                    CS_Player.TerrLost = CS_Player.TerrLost + NEW.TerrLost
                WHERE 
                    CS_Player.XUID = NEW.Player_XUID;                    
            END IF;
        END;
    $$
CREATE TRIGGER MatchPlayerMedalsInsert AFTER INSERT ON `CS_MatchPlayerMedals`
    FOR EACH ROW
        BEGIN 
            DECLARE XUID BIGINT;
            DECLARE XUID_Exists Boolean;

            SELECT Player_XUID 
            INTO XUID
            FROM CS_MatchPlayer
            WHERE CS_MatchPlayer.UUID = NEW.MatchPlayer_UUID;

            SELECT 1
            INTO XUID_Exists
            FROM CS_PlayerMedals
            WHERE CS_PlayerMedals.Player_XUID = XUID;

            if XUID_Exists THEN
                UPDATE CS_PlayerMedals
                SET
                    CS_PlayerMedals.DoubleKill = CS_PlayerMedals.DoubleKill + NEW.DoubleKill,
                    CS_PlayerMedals.TripleKill = CS_PlayerMedals.TripleKill + NEW.TripleKill,
                    CS_PlayerMedals.Killtacular = CS_PlayerMedals.Killtacular + NEW.Killtacular,
                    CS_PlayerMedals.KillFrenzy = CS_PlayerMedals.KillFrenzy + NEW.KillFrenzy,
                    CS_PlayerMedals.Killtrocity = CS_PlayerMedals.Killtrocity + NEW.Killtrocity,
                    CS_PlayerMedals.SniperKill = CS_PlayerMedals.SniperKill + NEW.SniperKill,
                    CS_PlayerMedals.Roadkill = CS_PlayerMedals.Roadkill + NEW.Roadkill,
                    CS_PlayerMedals.BoneCracker = CS_PlayerMedals.BoneCracker + NEW.BoneCracker,
                    CS_PlayerMedals.Assassin = CS_PlayerMedals.Assassin + NEW.Assassin,
                    CS_PlayerMedals.VehicleDestroyed = CS_PlayerMedals.VehicleDestroyed + NEW.VehicleDestroyed,
                    CS_PlayerMedals.Carjacking = CS_PlayerMedals.Carjacking + NEW.Carjacking,
                    CS_PlayerMedals.StickIt = CS_PlayerMedals.StickIt + NEW.StickIt,
                    CS_PlayerMedals.KillingSpree = CS_PlayerMedals.KillingSpree + NEW.KillingSpree,
                    CS_PlayerMedals.RunningRiot = CS_PlayerMedals.RunningRiot + NEW.RunningRiot,
                    CS_PlayerMedals.Rampage = CS_PlayerMedals.Rampage + NEW.Rampage,
                    CS_PlayerMedals.Berserker = CS_PlayerMedals.Berserker + NEW.Berserker,
                    CS_PlayerMedals.Overkill = CS_PlayerMedals.Overkill + NEW.Overkill,
                    CS_PlayerMedals.FlagTaken = CS_PlayerMedals.FlagTaken + NEW.FlagTaken,
                    CS_PlayerMedals.FlagCarrierKill = CS_PlayerMedals.FlagCarrierKill + NEW.FlagCarrierKill,
                    CS_PlayerMedals.FlagReturned = CS_PlayerMedals.FlagReturned + NEW.FlagReturned,
                    CS_PlayerMedals.BombPlanted = CS_PlayerMedals.BombPlanted + NEW.BombPlanted,
                    CS_PlayerMedals.BombReturned = CS_PlayerMedals.BombReturned + NEW.BombReturned
                WHERE
                    CS_PlayerMedals.Player_XUID = XUID;
            END IF;
        END;
    $$
CREATE TRIGGER MatchPlayerWeaponInsert AFTER INSERT ON `CS_MatchPlayerWeapon`
    FOR EACH ROW
        BEGIN
            DECLARE XUID BIGINT;
            DECLARE XUID_Exists Boolean;

            SELECT Player_XUID 
            INTO XUID
            FROM CS_MatchPlayer
            WHERE CS_MatchPlayer.UUID = NEW.MatchPlayer_UUID;

            SELECT 1
            INTO XUID_Exists
            FROM CS_PlayerWeapon
            WHERE CS_PlayerWeapon.Player_XUID = XUID;

            if XUID_Exists THEN
                UPDATE CS_PlayerWeapon
                SET
                    CS_PlayerWeapon.MagnumKills = CS_PlayerWeapon.MagnumKills + NEW.MagnumKills,
                    CS_PlayerWeapon.MagnumDeaths = CS_PlayerWeapon.MagnumDeaths + NEW.MagnumDeaths,
                    CS_PlayerWeapon.MagnumSuicide = CS_PlayerWeapon.MagnumSuicide + NEW.MagnumSuicide,
                    CS_PlayerWeapon.MagnumShotsFired = CS_PlayerWeapon.MagnumShotsFired + NEW.MagnumShotsFired,
                    CS_PlayerWeapon.MagnumShotsHit = CS_PlayerWeapon.MagnumShotsHit + NEW.MagnumShotsHit,
                    CS_PlayerWeapon.MagnumHeadshot = CS_PlayerWeapon.MagnumHeadshot + NEW.MagnumHeadshot,
                    CS_PlayerWeapon.PlasmaPistolKills = CS_PlayerWeapon.PlasmaPistolKills + NEW.PlasmaPistolKills,
                    CS_PlayerWeapon.PlasmaPistolDeaths = CS_PlayerWeapon.PlasmaPistolDeaths + NEW.PlasmaPistolDeaths,
                    CS_PlayerWeapon.PlasmaPistolSuicide = CS_PlayerWeapon.PlasmaPistolSuicide + NEW.PlasmaPistolSuicide,
                    CS_PlayerWeapon.PlasmaPistolShotsFired = CS_PlayerWeapon.PlasmaPistolShotsFired + NEW.PlasmaPistolShotsFired,
                    CS_PlayerWeapon.PlasmaPistolShotsHit = CS_PlayerWeapon.PlasmaPistolShotsHit + NEW.PlasmaPistolShotsHit,
                    CS_PlayerWeapon.PlasmaPistolHeadshot = CS_PlayerWeapon.PlasmaPistolHeadshot + NEW.PlasmaPistolHeadshot,
                    CS_PlayerWeapon.NeedlerKills = CS_PlayerWeapon.NeedlerKills + NEW.NeedlerKills,
                    CS_PlayerWeapon.NeedlerDeaths = CS_PlayerWeapon.NeedlerDeaths + NEW.NeedlerDeaths,
                    CS_PlayerWeapon.NeedlerSuicide = CS_PlayerWeapon.NeedlerSuicide + NEW.NeedlerSuicide,
                    CS_PlayerWeapon.NeedlerShotsFired = CS_PlayerWeapon.NeedlerShotsFired + NEW.NeedlerShotsFired,
                    CS_PlayerWeapon.NeedlerShotsHit = CS_PlayerWeapon.NeedlerShotsHit + NEW.NeedlerShotsHit,
                    CS_PlayerWeapon.NeedlerHeadshot = CS_PlayerWeapon.NeedlerHeadshot + NEW.NeedlerHeadshot,
                    CS_PlayerWeapon.SubMachineGunKills = CS_PlayerWeapon.SubMachineGunKills + NEW.SubMachineGunKills,
                    CS_PlayerWeapon.SubMachineGunDeaths = CS_PlayerWeapon.SubMachineGunDeaths + NEW.SubMachineGunDeaths,
                    CS_PlayerWeapon.SubMachineGunSuicide = CS_PlayerWeapon.SubMachineGunSuicide + NEW.SubMachineGunSuicide,
                    CS_PlayerWeapon.SubMachineGunShotsFired = CS_PlayerWeapon.SubMachineGunShotsFired + NEW.SubMachineGunShotsFired,
                    CS_PlayerWeapon.SubMachineGunShotsHit = CS_PlayerWeapon.SubMachineGunShotsHit + NEW.SubMachineGunShotsHit,
                    CS_PlayerWeapon.SubMachineGunHeadshot = CS_PlayerWeapon.SubMachineGunHeadshot + NEW.SubMachineGunHeadshot,
                    CS_PlayerWeapon.PlasmaRifleKills = CS_PlayerWeapon.PlasmaRifleKills + NEW.PlasmaRifleKills,
                    CS_PlayerWeapon.PlasmaRifleDeaths = CS_PlayerWeapon.PlasmaRifleDeaths + NEW.PlasmaRifleDeaths,
                    CS_PlayerWeapon.PlasmaRifleSuicide = CS_PlayerWeapon.PlasmaRifleSuicide + NEW.PlasmaRifleSuicide,
                    CS_PlayerWeapon.PlasmaRifleShotsFired = CS_PlayerWeapon.PlasmaRifleShotsFired + NEW.PlasmaRifleShotsFired,
                    CS_PlayerWeapon.PlasmaRifleShotsHit = CS_PlayerWeapon.PlasmaRifleShotsHit + NEW.PlasmaRifleShotsHit,
                    CS_PlayerWeapon.PlasmaRifleHeadshot = CS_PlayerWeapon.PlasmaRifleHeadshot + NEW.PlasmaRifleHeadshot,
                    CS_PlayerWeapon.BattleRifleKills = CS_PlayerWeapon.BattleRifleKills + NEW.BattleRifleKills,
                    CS_PlayerWeapon.BattleRifleDeaths = CS_PlayerWeapon.BattleRifleDeaths + NEW.BattleRifleDeaths,
                    CS_PlayerWeapon.BattleRifleSuicide = CS_PlayerWeapon.BattleRifleSuicide + NEW.BattleRifleSuicide,
                    CS_PlayerWeapon.BattleRifleShotsFired = CS_PlayerWeapon.BattleRifleShotsFired + NEW.BattleRifleShotsFired,
                    CS_PlayerWeapon.BattleRifleShotsHit = CS_PlayerWeapon.BattleRifleShotsHit + NEW.BattleRifleShotsHit,
                    CS_PlayerWeapon.BattleRifleHeadshot = CS_PlayerWeapon.BattleRifleHeadshot + NEW.BattleRifleHeadshot,
                    CS_PlayerWeapon.CarbineKills = CS_PlayerWeapon.CarbineKills + NEW.CarbineKills,
                    CS_PlayerWeapon.CarbineDeaths = CS_PlayerWeapon.CarbineDeaths + NEW.CarbineDeaths,
                    CS_PlayerWeapon.CarbineSuicide = CS_PlayerWeapon.CarbineSuicide + NEW.CarbineSuicide,
                    CS_PlayerWeapon.CarbineShotsFired = CS_PlayerWeapon.CarbineShotsFired + NEW.CarbineShotsFired,
                    CS_PlayerWeapon.CarbineShotsHit = CS_PlayerWeapon.CarbineShotsHit + NEW.CarbineShotsHit,
                    CS_PlayerWeapon.CarbineHeadshot = CS_PlayerWeapon.CarbineHeadshot + NEW.CarbineHeadshot,
                    CS_PlayerWeapon.ShotgunKills = CS_PlayerWeapon.ShotgunKills + NEW.ShotgunKills,
                    CS_PlayerWeapon.ShotgunDeaths = CS_PlayerWeapon.ShotgunDeaths + NEW.ShotgunDeaths,
                    CS_PlayerWeapon.ShotgunSuicide = CS_PlayerWeapon.ShotgunSuicide + NEW.ShotgunSuicide,
                    CS_PlayerWeapon.ShotgunShotsFired = CS_PlayerWeapon.ShotgunShotsFired + NEW.ShotgunShotsFired,
                    CS_PlayerWeapon.ShotgunShotsHit = CS_PlayerWeapon.ShotgunShotsHit + NEW.ShotgunShotsHit,
                    CS_PlayerWeapon.ShotgunHeadshot = CS_PlayerWeapon.ShotgunHeadshot + NEW.ShotgunHeadshot,
                    CS_PlayerWeapon.SniperRifleKills = CS_PlayerWeapon.SniperRifleKills + NEW.SniperRifleKills,
                    CS_PlayerWeapon.SniperRifleDeaths = CS_PlayerWeapon.SniperRifleDeaths + NEW.SniperRifleDeaths,
                    CS_PlayerWeapon.SniperRifleSuicide = CS_PlayerWeapon.SniperRifleSuicide + NEW.SniperRifleSuicide,
                    CS_PlayerWeapon.SniperRifleShotsFired = CS_PlayerWeapon.SniperRifleShotsFired + NEW.SniperRifleShotsFired,
                    CS_PlayerWeapon.SniperRifleShotsHit = CS_PlayerWeapon.SniperRifleShotsHit + NEW.SniperRifleShotsHit,
                    CS_PlayerWeapon.SniperRifleHeadshot = CS_PlayerWeapon.SniperRifleHeadshot + NEW.SniperRifleHeadshot,
                    CS_PlayerWeapon.BeamRifleKills = CS_PlayerWeapon.BeamRifleKills + NEW.BeamRifleKills,
                    CS_PlayerWeapon.BeamRifleDeaths = CS_PlayerWeapon.BeamRifleDeaths + NEW.BeamRifleDeaths,
                    CS_PlayerWeapon.BeamRifleSuicide = CS_PlayerWeapon.BeamRifleSuicide + NEW.BeamRifleSuicide,
                    CS_PlayerWeapon.BeamRifleShotsFired = CS_PlayerWeapon.BeamRifleShotsFired + NEW.BeamRifleShotsFired,
                    CS_PlayerWeapon.BeamRifleShotsHit = CS_PlayerWeapon.BeamRifleShotsHit + NEW.BeamRifleShotsHit,
                    CS_PlayerWeapon.BeamRifleHeadshot = CS_PlayerWeapon.BeamRifleHeadshot + NEW.BeamRifleHeadshot,
                    CS_PlayerWeapon.BrutePlasmaRifleKills = CS_PlayerWeapon.BrutePlasmaRifleKills + NEW.BrutePlasmaRifleKills,
                    CS_PlayerWeapon.BrutePlasmaRifleDeaths = CS_PlayerWeapon.BrutePlasmaRifleDeaths + NEW.BrutePlasmaRifleDeaths,
                    CS_PlayerWeapon.BrutePlasmaRifleSuicide = CS_PlayerWeapon.BrutePlasmaRifleSuicide + NEW.BrutePlasmaRifleSuicide,
                    CS_PlayerWeapon.BrutePlasmaRifleShotsFired = CS_PlayerWeapon.BrutePlasmaRifleShotsFired + NEW.BrutePlasmaRifleShotsFired,
                    CS_PlayerWeapon.BrutePlasmaRifleShotsHit = CS_PlayerWeapon.BrutePlasmaRifleShotsHit + NEW.BrutePlasmaRifleShotsHit,
                    CS_PlayerWeapon.BrutePlasmaRifleHeadshot = CS_PlayerWeapon.BrutePlasmaRifleHeadshot + NEW.BrutePlasmaRifleHeadshot,
                    CS_PlayerWeapon.RocketLauncherKills = CS_PlayerWeapon.RocketLauncherKills + NEW.RocketLauncherKills,
                    CS_PlayerWeapon.RocketLauncherDeaths = CS_PlayerWeapon.RocketLauncherDeaths + NEW.RocketLauncherDeaths,
                    CS_PlayerWeapon.RocketLauncherSuicide = CS_PlayerWeapon.RocketLauncherSuicide + NEW.RocketLauncherSuicide,
                    CS_PlayerWeapon.RocketLauncherShotsFired = CS_PlayerWeapon.RocketLauncherShotsFired + NEW.RocketLauncherShotsFired,
                    CS_PlayerWeapon.RocketLauncherShotsHit = CS_PlayerWeapon.RocketLauncherShotsHit + NEW.RocketLauncherShotsHit,
                    CS_PlayerWeapon.RocketLauncherHeadshot = CS_PlayerWeapon.RocketLauncherHeadshot + NEW.RocketLauncherHeadshot,
                    CS_PlayerWeapon.FuelRodCannonKills = CS_PlayerWeapon.FuelRodCannonKills + NEW.FuelRodCannonKills,
                    CS_PlayerWeapon.FuelRodCannonDeaths = CS_PlayerWeapon.FuelRodCannonDeaths + NEW.FuelRodCannonDeaths,
                    CS_PlayerWeapon.FuelRodCannonSuicide = CS_PlayerWeapon.FuelRodCannonSuicide + NEW.FuelRodCannonSuicide,
                    CS_PlayerWeapon.FuelRodCannonShotsFired = CS_PlayerWeapon.FuelRodCannonShotsFired + NEW.FuelRodCannonShotsFired,
                    CS_PlayerWeapon.FuelRodCannonShotsHit = CS_PlayerWeapon.FuelRodCannonShotsHit + NEW.FuelRodCannonShotsHit,
                    CS_PlayerWeapon.FuelRodCannonHeadshot = CS_PlayerWeapon.FuelRodCannonHeadshot + NEW.FuelRodCannonHeadshot,
                    CS_PlayerWeapon.BruteshotKills = CS_PlayerWeapon.BruteshotKills + NEW.BruteshotKills,
                    CS_PlayerWeapon.BruteshotDeaths = CS_PlayerWeapon.BruteshotDeaths + NEW.BruteshotDeaths,
                    CS_PlayerWeapon.BruteshotSuicide = CS_PlayerWeapon.BruteshotSuicide + NEW.BruteshotSuicide,
                    CS_PlayerWeapon.BruteshotShotsFired = CS_PlayerWeapon.BruteshotShotsFired + NEW.BruteshotShotsFired,
                    CS_PlayerWeapon.BruteshotShotsHit = CS_PlayerWeapon.BruteshotShotsHit + NEW.BruteshotShotsHit,
                    CS_PlayerWeapon.BruteshotHeadshot = CS_PlayerWeapon.BruteshotHeadshot + NEW.BruteshotHeadshot,
                    CS_PlayerWeapon.Unused1Kills = CS_PlayerWeapon.Unused1Kills + NEW.Unused1Kills,
                    CS_PlayerWeapon.Unused1Deaths = CS_PlayerWeapon.Unused1Deaths + NEW.Unused1Deaths,
                    CS_PlayerWeapon.Unused1Suicide = CS_PlayerWeapon.Unused1Suicide + NEW.Unused1Suicide,
                    CS_PlayerWeapon.Unused1ShotsFired = CS_PlayerWeapon.Unused1ShotsFired + NEW.Unused1ShotsFired,
                    CS_PlayerWeapon.Unused1ShotsHit = CS_PlayerWeapon.Unused1ShotsHit + NEW.Unused1ShotsHit,
                    CS_PlayerWeapon.Unused1Headshot = CS_PlayerWeapon.Unused1Headshot + NEW.Unused1Headshot,
                    CS_PlayerWeapon.SentinalBeamKills = CS_PlayerWeapon.SentinalBeamKills + NEW.SentinalBeamKills,
                    CS_PlayerWeapon.SentinalBeamDeaths = CS_PlayerWeapon.SentinalBeamDeaths + NEW.SentinalBeamDeaths,
                    CS_PlayerWeapon.SentinalBeamSuicide = CS_PlayerWeapon.SentinalBeamSuicide + NEW.SentinalBeamSuicide,
                    CS_PlayerWeapon.SentinalBeamShotsFired = CS_PlayerWeapon.SentinalBeamShotsFired + NEW.SentinalBeamShotsFired,
                    CS_PlayerWeapon.SentinalBeamShotsHit = CS_PlayerWeapon.SentinalBeamShotsHit + NEW.SentinalBeamShotsHit,
                    CS_PlayerWeapon.SentinalBeamHeadshot = CS_PlayerWeapon.SentinalBeamHeadshot + NEW.SentinalBeamHeadshot,
                    CS_PlayerWeapon.Unused2Kills = CS_PlayerWeapon.Unused2Kills + NEW.Unused2Kills,
                    CS_PlayerWeapon.Unused2Deaths = CS_PlayerWeapon.Unused2Deaths + NEW.Unused2Deaths,
                    CS_PlayerWeapon.Unused2Suicide = CS_PlayerWeapon.Unused2Suicide + NEW.Unused2Suicide,
                    CS_PlayerWeapon.Unused2ShotsFired = CS_PlayerWeapon.Unused2ShotsFired + NEW.Unused2ShotsFired,
                    CS_PlayerWeapon.Unused2ShotsHit = CS_PlayerWeapon.Unused2ShotsHit + NEW.Unused2ShotsHit,
                    CS_PlayerWeapon.Unused2Headshot = CS_PlayerWeapon.Unused2Headshot + NEW.Unused2Headshot,
                    CS_PlayerWeapon.EnergySwordKills = CS_PlayerWeapon.EnergySwordKills + NEW.EnergySwordKills,
                    CS_PlayerWeapon.EnergySwordDeaths = CS_PlayerWeapon.EnergySwordDeaths + NEW.EnergySwordDeaths,
                    CS_PlayerWeapon.EnergySwordSuicide = CS_PlayerWeapon.EnergySwordSuicide + NEW.EnergySwordSuicide,
                    CS_PlayerWeapon.EnergySwordShotsFired = CS_PlayerWeapon.EnergySwordShotsFired + NEW.EnergySwordShotsFired,
                    CS_PlayerWeapon.EnergySwordShotsHit = CS_PlayerWeapon.EnergySwordShotsHit + NEW.EnergySwordShotsHit,
                    CS_PlayerWeapon.EnergySwordHeadshot = CS_PlayerWeapon.EnergySwordHeadshot + NEW.EnergySwordHeadshot,
                    CS_PlayerWeapon.FragGrenadeKills = CS_PlayerWeapon.FragGrenadeKills + NEW.FragGrenadeKills,
                    CS_PlayerWeapon.FragGrenadeDeaths = CS_PlayerWeapon.FragGrenadeDeaths + NEW.FragGrenadeDeaths,
                    CS_PlayerWeapon.FragGrenadeSuicide = CS_PlayerWeapon.FragGrenadeSuicide + NEW.FragGrenadeSuicide,
                    CS_PlayerWeapon.FragGrenadeShotsFired = CS_PlayerWeapon.FragGrenadeShotsFired + NEW.FragGrenadeShotsFired,
                    CS_PlayerWeapon.FragGrenadeShotsHit = CS_PlayerWeapon.FragGrenadeShotsHit + NEW.FragGrenadeShotsHit,
                    CS_PlayerWeapon.FragGrenadeHeadshot = CS_PlayerWeapon.FragGrenadeHeadshot + NEW.FragGrenadeHeadshot,
                    CS_PlayerWeapon.PlasmaGrenadeKills = CS_PlayerWeapon.PlasmaGrenadeKills + NEW.PlasmaGrenadeKills,
                    CS_PlayerWeapon.PlasmaGrenadeDeaths = CS_PlayerWeapon.PlasmaGrenadeDeaths + NEW.PlasmaGrenadeDeaths,
                    CS_PlayerWeapon.PlasmaGrenadeSuicide = CS_PlayerWeapon.PlasmaGrenadeSuicide + NEW.PlasmaGrenadeSuicide,
                    CS_PlayerWeapon.PlasmaGrenadeShotsFired = CS_PlayerWeapon.PlasmaGrenadeShotsFired + NEW.PlasmaGrenadeShotsFired,
                    CS_PlayerWeapon.PlasmaGrenadeShotsHit = CS_PlayerWeapon.PlasmaGrenadeShotsHit + NEW.PlasmaGrenadeShotsHit,
                    CS_PlayerWeapon.PlasmaGrenadeHeadshot = CS_PlayerWeapon.PlasmaGrenadeHeadshot + NEW.PlasmaGrenadeHeadshot,
                    CS_PlayerWeapon.CTFFlagKills = CS_PlayerWeapon.CTFFlagKills + NEW.CTFFlagKills,
                    CS_PlayerWeapon.CTFFlagDeaths = CS_PlayerWeapon.CTFFlagDeaths + NEW.CTFFlagDeaths,
                    CS_PlayerWeapon.CTFFlagSuicide = CS_PlayerWeapon.CTFFlagSuicide + NEW.CTFFlagSuicide,
                    CS_PlayerWeapon.CTFFlagShotsFired = CS_PlayerWeapon.CTFFlagShotsFired + NEW.CTFFlagShotsFired,
                    CS_PlayerWeapon.CTFFlagShotsHit = CS_PlayerWeapon.CTFFlagShotsHit + NEW.CTFFlagShotsHit,
                    CS_PlayerWeapon.CTFFlagHeadshot = CS_PlayerWeapon.CTFFlagHeadshot + NEW.CTFFlagHeadshot,
                    CS_PlayerWeapon.AssaultBombKills = CS_PlayerWeapon.AssaultBombKills + NEW.AssaultBombKills,
                    CS_PlayerWeapon.AssaultBombDeaths = CS_PlayerWeapon.AssaultBombDeaths + NEW.AssaultBombDeaths,
                    CS_PlayerWeapon.AssaultBombSuicide = CS_PlayerWeapon.AssaultBombSuicide + NEW.AssaultBombSuicide,
                    CS_PlayerWeapon.AssaultBombShotsFired = CS_PlayerWeapon.AssaultBombShotsFired + NEW.AssaultBombShotsFired,
                    CS_PlayerWeapon.AssaultBombShotsHit = CS_PlayerWeapon.AssaultBombShotsHit + NEW.AssaultBombShotsHit,
                    CS_PlayerWeapon.AssaultBombHeadshot = CS_PlayerWeapon.AssaultBombHeadshot + NEW.AssaultBombHeadshot,
                    CS_PlayerWeapon.OddballSkullKills = CS_PlayerWeapon.OddballSkullKills + NEW.OddballSkullKills,
                    CS_PlayerWeapon.OddballSkullDeaths = CS_PlayerWeapon.OddballSkullDeaths + NEW.OddballSkullDeaths,
                    CS_PlayerWeapon.OddballSkullSuicide = CS_PlayerWeapon.OddballSkullSuicide + NEW.OddballSkullSuicide,
                    CS_PlayerWeapon.OddballSkullShotsFired = CS_PlayerWeapon.OddballSkullShotsFired + NEW.OddballSkullShotsFired,
                    CS_PlayerWeapon.OddballSkullShotsHit = CS_PlayerWeapon.OddballSkullShotsHit + NEW.OddballSkullShotsHit,
                    CS_PlayerWeapon.OddballSkullHeadshot = CS_PlayerWeapon.OddballSkullHeadshot + NEW.OddballSkullHeadshot,
                    CS_PlayerWeapon.HumanTurretKills = CS_PlayerWeapon.HumanTurretKills + NEW.HumanTurretKills,
                    CS_PlayerWeapon.HumanTurretDeaths = CS_PlayerWeapon.HumanTurretDeaths + NEW.HumanTurretDeaths,
                    CS_PlayerWeapon.HumanTurretSuicide = CS_PlayerWeapon.HumanTurretSuicide + NEW.HumanTurretSuicide,
                    CS_PlayerWeapon.HumanTurretShotsFired = CS_PlayerWeapon.HumanTurretShotsFired + NEW.HumanTurretShotsFired,
                    CS_PlayerWeapon.HumanTurretShotsHit = CS_PlayerWeapon.HumanTurretShotsHit + NEW.HumanTurretShotsHit,
                    CS_PlayerWeapon.HumanTurretHeadshot = CS_PlayerWeapon.HumanTurretHeadshot + NEW.HumanTurretHeadshot,
                    CS_PlayerWeapon.CovenantTurretKills = CS_PlayerWeapon.CovenantTurretKills + NEW.CovenantTurretKills,
                    CS_PlayerWeapon.CovenantTurretDeaths = CS_PlayerWeapon.CovenantTurretDeaths + NEW.CovenantTurretDeaths,
                    CS_PlayerWeapon.CovenantTurretSuicide = CS_PlayerWeapon.CovenantTurretSuicide + NEW.CovenantTurretSuicide,
                    CS_PlayerWeapon.CovenantTurretShotsFired = CS_PlayerWeapon.CovenantTurretShotsFired + NEW.CovenantTurretShotsFired,
                    CS_PlayerWeapon.CovenantTurretShotsHit = CS_PlayerWeapon.CovenantTurretShotsHit + NEW.CovenantTurretShotsHit,
                    CS_PlayerWeapon.CovenantTurretHeadshot = CS_PlayerWeapon.CovenantTurretHeadshot + NEW.CovenantTurretHeadshot,
                    CS_PlayerWeapon.BansheeKills = CS_PlayerWeapon.BansheeKills + NEW.BansheeKills,
                    CS_PlayerWeapon.BansheeDeaths = CS_PlayerWeapon.BansheeDeaths + NEW.BansheeDeaths,
                    CS_PlayerWeapon.BansheeSuicide = CS_PlayerWeapon.BansheeSuicide + NEW.BansheeSuicide,
                    CS_PlayerWeapon.BansheeShotsFired = CS_PlayerWeapon.BansheeShotsFired + NEW.BansheeShotsFired,
                    CS_PlayerWeapon.BansheeShotsHit = CS_PlayerWeapon.BansheeShotsHit + NEW.BansheeShotsHit,
                    CS_PlayerWeapon.BansheeHeadshot = CS_PlayerWeapon.BansheeHeadshot + NEW.BansheeHeadshot,
                    CS_PlayerWeapon.GhostKills = CS_PlayerWeapon.GhostKills + NEW.GhostKills,
                    CS_PlayerWeapon.GhostDeaths = CS_PlayerWeapon.GhostDeaths + NEW.GhostDeaths,
                    CS_PlayerWeapon.GhostSuicide = CS_PlayerWeapon.GhostSuicide + NEW.GhostSuicide,
                    CS_PlayerWeapon.GhostShotsFired = CS_PlayerWeapon.GhostShotsFired + NEW.GhostShotsFired,
                    CS_PlayerWeapon.GhostShotsHit = CS_PlayerWeapon.GhostShotsHit + NEW.GhostShotsHit,
                    CS_PlayerWeapon.GhostHeadshot = CS_PlayerWeapon.GhostHeadshot + NEW.GhostHeadshot,
                    CS_PlayerWeapon.Unused3Kills = CS_PlayerWeapon.Unused3Kills + NEW.Unused3Kills,
                    CS_PlayerWeapon.Unused3Deaths = CS_PlayerWeapon.Unused3Deaths + NEW.Unused3Deaths,
                    CS_PlayerWeapon.Unused3Suicide = CS_PlayerWeapon.Unused3Suicide + NEW.Unused3Suicide,
                    CS_PlayerWeapon.Unused3ShotsFired = CS_PlayerWeapon.Unused3ShotsFired + NEW.Unused3ShotsFired,
                    CS_PlayerWeapon.Unused3ShotsHit = CS_PlayerWeapon.Unused3ShotsHit + NEW.Unused3ShotsHit,
                    CS_PlayerWeapon.Unused3Headshot = CS_PlayerWeapon.Unused3Headshot + NEW.Unused3Headshot,
                    CS_PlayerWeapon.ScorpionTurretKills = CS_PlayerWeapon.ScorpionTurretKills + NEW.ScorpionTurretKills,
                    CS_PlayerWeapon.ScorpionTurretDeaths = CS_PlayerWeapon.ScorpionTurretDeaths + NEW.ScorpionTurretDeaths,
                    CS_PlayerWeapon.ScorpionTurretSuicide = CS_PlayerWeapon.ScorpionTurretSuicide + NEW.ScorpionTurretSuicide,
                    CS_PlayerWeapon.ScorpionTurretShotsFired = CS_PlayerWeapon.ScorpionTurretShotsFired + NEW.ScorpionTurretShotsFired,
                    CS_PlayerWeapon.ScorpionTurretShotsHit = CS_PlayerWeapon.ScorpionTurretShotsHit + NEW.ScorpionTurretShotsHit,
                    CS_PlayerWeapon.ScorpionTurretHeadshot = CS_PlayerWeapon.ScorpionTurretHeadshot + NEW.ScorpionTurretHeadshot,
                    CS_PlayerWeapon.SpectreDriverKills = CS_PlayerWeapon.SpectreDriverKills + NEW.SpectreDriverKills,
                    CS_PlayerWeapon.SpectreDriverDeaths = CS_PlayerWeapon.SpectreDriverDeaths + NEW.SpectreDriverDeaths,
                    CS_PlayerWeapon.SpectreDriverSuicide = CS_PlayerWeapon.SpectreDriverSuicide + NEW.SpectreDriverSuicide,
                    CS_PlayerWeapon.SpectreDriverShotsFired = CS_PlayerWeapon.SpectreDriverShotsFired + NEW.SpectreDriverShotsFired,
                    CS_PlayerWeapon.SpectreDriverShotsHit = CS_PlayerWeapon.SpectreDriverShotsHit + NEW.SpectreDriverShotsHit,
                    CS_PlayerWeapon.SpectreDriverHeadshot = CS_PlayerWeapon.SpectreDriverHeadshot + NEW.SpectreDriverHeadshot,
                    CS_PlayerWeapon.SpectreTurrentKills = CS_PlayerWeapon.SpectreTurrentKills + NEW.SpectreTurrentKills,
                    CS_PlayerWeapon.SpectreTurrentDeaths = CS_PlayerWeapon.SpectreTurrentDeaths + NEW.SpectreTurrentDeaths,
                    CS_PlayerWeapon.SpectreTurrentSuicide = CS_PlayerWeapon.SpectreTurrentSuicide + NEW.SpectreTurrentSuicide,
                    CS_PlayerWeapon.SpectreTurrentShotsFired = CS_PlayerWeapon.SpectreTurrentShotsFired + NEW.SpectreTurrentShotsFired,
                    CS_PlayerWeapon.SpectreTurrentShotsHit = CS_PlayerWeapon.SpectreTurrentShotsHit + NEW.SpectreTurrentShotsHit,
                    CS_PlayerWeapon.SpectreTurrentHeadshot = CS_PlayerWeapon.SpectreTurrentHeadshot + NEW.SpectreTurrentHeadshot,
                    CS_PlayerWeapon.WarthogDriverKills = CS_PlayerWeapon.WarthogDriverKills + NEW.WarthogDriverKills,
                    CS_PlayerWeapon.WarthogDriverDeaths = CS_PlayerWeapon.WarthogDriverDeaths + NEW.WarthogDriverDeaths,
                    CS_PlayerWeapon.WarthogDriverSuicide = CS_PlayerWeapon.WarthogDriverSuicide + NEW.WarthogDriverSuicide,
                    CS_PlayerWeapon.WarthogDriverShotsFired = CS_PlayerWeapon.WarthogDriverShotsFired + NEW.WarthogDriverShotsFired,
                    CS_PlayerWeapon.WarthogDriverShotsHit = CS_PlayerWeapon.WarthogDriverShotsHit + NEW.WarthogDriverShotsHit,
                    CS_PlayerWeapon.WarthogDriverHeadshot = CS_PlayerWeapon.WarthogDriverHeadshot + NEW.WarthogDriverHeadshot,
                    CS_PlayerWeapon.WarthogTurretKills = CS_PlayerWeapon.WarthogTurretKills + NEW.WarthogTurretKills,
                    CS_PlayerWeapon.WarthogTurretDeaths = CS_PlayerWeapon.WarthogTurretDeaths + NEW.WarthogTurretDeaths,
                    CS_PlayerWeapon.WarthogTurretSuicide = CS_PlayerWeapon.WarthogTurretSuicide + NEW.WarthogTurretSuicide,
                    CS_PlayerWeapon.WarthogTurretShotsFired = CS_PlayerWeapon.WarthogTurretShotsFired + NEW.WarthogTurretShotsFired,
                    CS_PlayerWeapon.WarthogTurretShotsHit = CS_PlayerWeapon.WarthogTurretShotsHit + NEW.WarthogTurretShotsHit,
                    CS_PlayerWeapon.WarthogTurretHeadshot = CS_PlayerWeapon.WarthogTurretHeadshot + NEW.WarthogTurretHeadshot,
                    CS_PlayerWeapon.WraithKills = CS_PlayerWeapon.WraithKills + NEW.WraithKills,
                    CS_PlayerWeapon.WraithDeaths = CS_PlayerWeapon.WraithDeaths + NEW.WraithDeaths,
                    CS_PlayerWeapon.WraithSuicide = CS_PlayerWeapon.WraithSuicide + NEW.WraithSuicide,
                    CS_PlayerWeapon.WraithShotsFired = CS_PlayerWeapon.WraithShotsFired + NEW.WraithShotsFired,
                    CS_PlayerWeapon.WraithShotsHit = CS_PlayerWeapon.WraithShotsHit + NEW.WraithShotsHit,
                    CS_PlayerWeapon.WraithHeadshot = CS_PlayerWeapon.WraithHeadshot + NEW.WraithHeadshot,
                    CS_PlayerWeapon.ScorpionCannonKills = CS_PlayerWeapon.ScorpionCannonKills + NEW.ScorpionCannonKills,
                    CS_PlayerWeapon.ScorpionCannonDeaths = CS_PlayerWeapon.ScorpionCannonDeaths + NEW.ScorpionCannonDeaths,
                    CS_PlayerWeapon.ScorpionCannonSuicide = CS_PlayerWeapon.ScorpionCannonSuicide + NEW.ScorpionCannonSuicide,
                    CS_PlayerWeapon.ScorpionCannonShotsFired = CS_PlayerWeapon.ScorpionCannonShotsFired + NEW.ScorpionCannonShotsFired,
                    CS_PlayerWeapon.ScorpionCannonShotsHit = CS_PlayerWeapon.ScorpionCannonShotsHit + NEW.ScorpionCannonShotsHit,
                    CS_PlayerWeapon.ScorpionCannonHeadshot = CS_PlayerWeapon.ScorpionCannonHeadshot + NEW.ScorpionCannonHeadshot,
                    CS_PlayerWeapon.AssultBombKills = CS_PlayerWeapon.AssultBombKills + NEW.AssultBombKills,
                    CS_PlayerWeapon.AssultBombDeaths = CS_PlayerWeapon.AssultBombDeaths + NEW.AssultBombDeaths,
                    CS_PlayerWeapon.AssultBombSuicide = CS_PlayerWeapon.AssultBombSuicide + NEW.AssultBombSuicide,
                    CS_PlayerWeapon.AssultBombShotsFired = CS_PlayerWeapon.AssultBombShotsFired + NEW.AssultBombShotsFired,
                    CS_PlayerWeapon.AssultBombShotsHit = CS_PlayerWeapon.AssultBombShotsHit + NEW.AssultBombShotsHit,
                    CS_PlayerWeapon.AssultBombHeadshot = CS_PlayerWeapon.AssultBombHeadshot + NEW.AssultBombHeadshot,
                    CS_PlayerWeapon.AssultBombKills = CS_PlayerWeapon.AssultBombKills + NEW.AssultBombKills,
                    CS_PlayerWeapon.AssultBombDeaths = CS_PlayerWeapon.AssultBombDeaths + NEW.AssultBombDeaths,
                    CS_PlayerWeapon.AssultBombSuicide = CS_PlayerWeapon.AssultBombSuicide + NEW.AssultBombSuicide,
                    CS_PlayerWeapon.AssultBombShotsFired = CS_PlayerWeapon.AssultBombShotsFired + NEW.AssultBombShotsFired,
                    CS_PlayerWeapon.AssultBombShotsHit = CS_PlayerWeapon.AssultBombShotsHit + NEW.AssultBombShotsHit,
                    CS_PlayerWeapon.AssultBombHeadshot = CS_PlayerWeapon.AssultBombHeadshot + NEW.AssultBombHeadshot
                WHERE
                    CS_PlayerWeapon.Player_XUID = XUID;
            END IF;
        END;
    $$
DELIMITER ;