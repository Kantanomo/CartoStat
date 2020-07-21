CREATE TABLE CS_PlayerWeapon(
    Player_XUID BIGINT UNSIGNED ,
    MagnumKills INT UNSIGNED DEFAULT 0,
    MagnumDeaths INT UNSIGNED DEFAULT 0,
    MagnumSuicide INT UNSIGNED DEFAULT 0,
    MagnumShotsFired INT UNSIGNED DEFAULT 0,
    MagnumShotsHit INT UNSIGNED DEFAULT 0,
    MagnumHeadshot INT UNSIGNED DEFAULT 0,
    PlasmaPistolKills INT UNSIGNED DEFAULT 0,
    PlasmaPistolDeaths INT UNSIGNED DEFAULT 0,
    PlasmaPistolSuicide INT UNSIGNED DEFAULT 0,
    PlasmaPistolShotsFired INT UNSIGNED DEFAULT 0,
    PlasmaPistolShotsHit INT UNSIGNED DEFAULT 0,
    PlasmaPistolHeadshot INT UNSIGNED DEFAULT 0,
    NeedlerKills INT UNSIGNED DEFAULT 0,
    NeedlerDeaths INT UNSIGNED DEFAULT 0,
    NeedlerSuicide INT UNSIGNED DEFAULT 0,
    NeedlerShotsFired INT UNSIGNED DEFAULT 0,
    NeedlerShotsHit INT UNSIGNED DEFAULT 0,
    NeedlerHeadshot INT UNSIGNED DEFAULT 0,
    SubMachineGunKills INT UNSIGNED DEFAULT 0,
    SubMachineGunDeaths INT UNSIGNED DEFAULT 0,
    SubMachineGunSuicide INT UNSIGNED DEFAULT 0,
    SubMachineGunShotsFired INT UNSIGNED DEFAULT 0,
    SubMachineGunShotsHit INT UNSIGNED DEFAULT 0,
    SubMachineGunHeadshot INT UNSIGNED DEFAULT 0,
    PlasmaRifleKills INT UNSIGNED DEFAULT 0,
    PlasmaRifleDeaths INT UNSIGNED DEFAULT 0,
    PlasmaRifleSuicide INT UNSIGNED DEFAULT 0,
    PlasmaRifleShotsFired INT UNSIGNED DEFAULT 0,
    PlasmaRifleShotsHit INT UNSIGNED DEFAULT 0,
    PlasmaRifleHeadshot INT UNSIGNED DEFAULT 0,
    BattleRifleKills INT UNSIGNED DEFAULT 0,
    BattleRifleDeaths INT UNSIGNED DEFAULT 0,
    BattleRifleSuicide INT UNSIGNED DEFAULT 0,
    BattleRifleShotsFired INT UNSIGNED DEFAULT 0,
    BattleRifleShotsHit INT UNSIGNED DEFAULT 0,
    BattleRifleHeadshot INT UNSIGNED DEFAULT 0,
    CarbineKills INT UNSIGNED DEFAULT 0,
    CarbineDeaths INT UNSIGNED DEFAULT 0,
    CarbineSuicide INT UNSIGNED DEFAULT 0,
    CarbineShotsFired INT UNSIGNED DEFAULT 0,
    CarbineShotsHit INT UNSIGNED DEFAULT 0,
    CarbineHeadshot INT UNSIGNED DEFAULT 0,
    ShotgunKills INT UNSIGNED DEFAULT 0,
    ShotgunDeaths INT UNSIGNED DEFAULT 0,
    ShotgunSuicide INT UNSIGNED DEFAULT 0,
    ShotgunShotsFired INT UNSIGNED DEFAULT 0,
    ShotgunShotsHit INT UNSIGNED DEFAULT 0,
    ShotgunHeadshot INT UNSIGNED DEFAULT 0,
    SniperRifleKills INT UNSIGNED DEFAULT 0,
    SniperRifleDeaths INT UNSIGNED DEFAULT 0,
    SniperRifleSuicide INT UNSIGNED DEFAULT 0,
    SniperRifleShotsFired INT UNSIGNED DEFAULT 0,
    SniperRifleShotsHit INT UNSIGNED DEFAULT 0,
    SniperRifleHeadshot INT UNSIGNED DEFAULT 0,
    BeamRifleKills INT UNSIGNED DEFAULT 0,
    BeamRifleDeaths INT UNSIGNED DEFAULT 0,
    BeamRifleSuicide INT UNSIGNED DEFAULT 0,
    BeamRifleShotsFired INT UNSIGNED DEFAULT 0,
    BeamRifleShotsHit INT UNSIGNED DEFAULT 0,
    BeamRifleHeadshot INT UNSIGNED DEFAULT 0,
    BrutePlasmaRifleKills INT UNSIGNED DEFAULT 0,
    BrutePlasmaRifleDeaths INT UNSIGNED DEFAULT 0,
    BrutePlasmaRifleSuicide INT UNSIGNED DEFAULT 0,
    BrutePlasmaRifleShotsFired INT UNSIGNED DEFAULT 0,
    BrutePlasmaRifleShotsHit INT UNSIGNED DEFAULT 0,
    BrutePlasmaRifleHeadshot INT UNSIGNED DEFAULT 0,
    RocketLauncherKills INT UNSIGNED DEFAULT 0,
    RocketLauncherDeaths INT UNSIGNED DEFAULT 0,
    RocketLauncherSuicide INT UNSIGNED DEFAULT 0,
    RocketLauncherShotsFired INT UNSIGNED DEFAULT 0,
    RocketLauncherShotsHit INT UNSIGNED DEFAULT 0,
    RocketLauncherHeadshot INT UNSIGNED DEFAULT 0,
    FuelRodCannonKills INT UNSIGNED DEFAULT 0,
    FuelRodCannonDeaths INT UNSIGNED DEFAULT 0,
    FuelRodCannonSuicide INT UNSIGNED DEFAULT 0,
    FuelRodCannonShotsFired INT UNSIGNED DEFAULT 0,
    FuelRodCannonShotsHit INT UNSIGNED DEFAULT 0,
    FuelRodCannonHeadshot INT UNSIGNED DEFAULT 0,
    BruteshotKills INT UNSIGNED DEFAULT 0,
    BruteshotDeaths INT UNSIGNED DEFAULT 0,
    BruteshotSuicide INT UNSIGNED DEFAULT 0,
    BruteshotShotsFired INT UNSIGNED DEFAULT 0,
    BruteshotShotsHit INT UNSIGNED DEFAULT 0,
    BruteshotHeadshot INT UNSIGNED DEFAULT 0,
    Unused1Kills INT UNSIGNED DEFAULT 0,
    Unused1Deaths INT UNSIGNED DEFAULT 0,
    Unused1Suicide INT UNSIGNED DEFAULT 0,
    Unused1ShotsFired INT UNSIGNED DEFAULT 0,
    Unused1ShotsHit INT UNSIGNED DEFAULT 0,
    Unused1Headshot INT UNSIGNED DEFAULT 0,
    SentinalBeamKills INT UNSIGNED DEFAULT 0,
    SentinalBeamDeaths INT UNSIGNED DEFAULT 0,
    SentinalBeamSuicide INT UNSIGNED DEFAULT 0,
    SentinalBeamShotsFired INT UNSIGNED DEFAULT 0,
    SentinalBeamShotsHit INT UNSIGNED DEFAULT 0,
    SentinalBeamHeadshot INT UNSIGNED DEFAULT 0,
    Unused2Kills INT UNSIGNED DEFAULT 0,
    Unused2Deaths INT UNSIGNED DEFAULT 0,
    Unused2Suicide INT UNSIGNED DEFAULT 0,
    Unused2ShotsFired INT UNSIGNED DEFAULT 0,
    Unused2ShotsHit INT UNSIGNED DEFAULT 0,
    Unused2Headshot INT UNSIGNED DEFAULT 0,
    EnergySwordKills INT UNSIGNED DEFAULT 0,
    EnergySwordDeaths INT UNSIGNED DEFAULT 0,
    EnergySwordSuicide INT UNSIGNED DEFAULT 0,
    EnergySwordShotsFired INT UNSIGNED DEFAULT 0,
    EnergySwordShotsHit INT UNSIGNED DEFAULT 0,
    EnergySwordHeadshot INT UNSIGNED DEFAULT 0,
    FragGrenadeKills INT UNSIGNED DEFAULT 0,
    FragGrenadeDeaths INT UNSIGNED DEFAULT 0,
    FragGrenadeSuicide INT UNSIGNED DEFAULT 0,
    FragGrenadeShotsFired INT UNSIGNED DEFAULT 0,
    FragGrenadeShotsHit INT UNSIGNED DEFAULT 0,
    FragGrenadeHeadshot INT UNSIGNED DEFAULT 0,
    PlasmaGrenadeKills INT UNSIGNED DEFAULT 0,
    PlasmaGrenadeDeaths INT UNSIGNED DEFAULT 0,
    PlasmaGrenadeSuicide INT UNSIGNED DEFAULT 0,
    PlasmaGrenadeShotsFired INT UNSIGNED DEFAULT 0,
    PlasmaGrenadeShotsHit INT UNSIGNED DEFAULT 0,
    PlasmaGrenadeHeadshot INT UNSIGNED DEFAULT 0,
    CTFFlagKills INT UNSIGNED DEFAULT 0,
    CTFFlagDeaths INT UNSIGNED DEFAULT 0,
    CTFFlagSuicide INT UNSIGNED DEFAULT 0,
    CTFFlagShotsFired INT UNSIGNED DEFAULT 0,
    CTFFlagShotsHit INT UNSIGNED DEFAULT 0,
    CTFFlagHeadshot INT UNSIGNED DEFAULT 0,
    AssaultBombKills INT UNSIGNED DEFAULT 0,
    AssaultBombDeaths INT UNSIGNED DEFAULT 0,
    AssaultBombSuicide INT UNSIGNED DEFAULT 0,
    AssaultBombShotsFired INT UNSIGNED DEFAULT 0,
    AssaultBombShotsHit INT UNSIGNED DEFAULT 0,
    AssaultBombHeadshot INT UNSIGNED DEFAULT 0,
    OddballSkullKills INT UNSIGNED DEFAULT 0,
    OddballSkullDeaths INT UNSIGNED DEFAULT 0,
    OddballSkullSuicide INT UNSIGNED DEFAULT 0,
    OddballSkullShotsFired INT UNSIGNED DEFAULT 0,
    OddballSkullShotsHit INT UNSIGNED DEFAULT 0,
    OddballSkullHeadshot INT UNSIGNED DEFAULT 0,
    HumanTurretKills INT UNSIGNED DEFAULT 0,
    HumanTurretDeaths INT UNSIGNED DEFAULT 0,
    HumanTurretSuicide INT UNSIGNED DEFAULT 0,
    HumanTurretShotsFired INT UNSIGNED DEFAULT 0,
    HumanTurretShotsHit INT UNSIGNED DEFAULT 0,
    HumanTurretHeadshot INT UNSIGNED DEFAULT 0,
    CovenantTurretKills INT UNSIGNED DEFAULT 0,
    CovenantTurretDeaths INT UNSIGNED DEFAULT 0,
    CovenantTurretSuicide INT UNSIGNED DEFAULT 0,
    CovenantTurretShotsFired INT UNSIGNED DEFAULT 0,
    CovenantTurretShotsHit INT UNSIGNED DEFAULT 0,
    CovenantTurretHeadshot INT UNSIGNED DEFAULT 0,
    BansheeKills INT UNSIGNED DEFAULT 0,
    BansheeDeaths INT UNSIGNED DEFAULT 0,
    BansheeSuicide INT UNSIGNED DEFAULT 0,
    BansheeShotsFired INT UNSIGNED DEFAULT 0,
    BansheeShotsHit INT UNSIGNED DEFAULT 0,
    BansheeHeadshot INT UNSIGNED DEFAULT 0,
    GhostKills INT UNSIGNED DEFAULT 0,
    GhostDeaths INT UNSIGNED DEFAULT 0,
    GhostSuicide INT UNSIGNED DEFAULT 0,
    GhostShotsFired INT UNSIGNED DEFAULT 0,
    GhostShotsHit INT UNSIGNED DEFAULT 0,
    GhostHeadshot INT UNSIGNED DEFAULT 0,
    Unused3Kills INT UNSIGNED DEFAULT 0,
    Unused3Deaths INT UNSIGNED DEFAULT 0,
    Unused3Suicide INT UNSIGNED DEFAULT 0,
    Unused3ShotsFired INT UNSIGNED DEFAULT 0,
    Unused3ShotsHit INT UNSIGNED DEFAULT 0,
    Unused3Headshot INT UNSIGNED DEFAULT 0,
    ScorpionTurretKills INT UNSIGNED DEFAULT 0,
    ScorpionTurretDeaths INT UNSIGNED DEFAULT 0,
    ScorpionTurretSuicide INT UNSIGNED DEFAULT 0,
    ScorpionTurretShotsFired INT UNSIGNED DEFAULT 0,
    ScorpionTurretShotsHit INT UNSIGNED DEFAULT 0,
    ScorpionTurretHeadshot INT UNSIGNED DEFAULT 0,
    SpectreDriverKills INT UNSIGNED DEFAULT 0,
    SpectreDriverDeaths INT UNSIGNED DEFAULT 0,
    SpectreDriverSuicide INT UNSIGNED DEFAULT 0,
    SpectreDriverShotsFired INT UNSIGNED DEFAULT 0,
    SpectreDriverShotsHit INT UNSIGNED DEFAULT 0,
    SpectreDriverHeadshot INT UNSIGNED DEFAULT 0,
    SpectreTurrentKills INT UNSIGNED DEFAULT 0,
    SpectreTurrentDeaths INT UNSIGNED DEFAULT 0,
    SpectreTurrentSuicide INT UNSIGNED DEFAULT 0,
    SpectreTurrentShotsFired INT UNSIGNED DEFAULT 0,
    SpectreTurrentShotsHit INT UNSIGNED DEFAULT 0,
    SpectreTurrentHeadshot INT UNSIGNED DEFAULT 0,
    WarthogDriverKills INT UNSIGNED DEFAULT 0,
    WarthogDriverDeaths INT UNSIGNED DEFAULT 0,
    WarthogDriverSuicide INT UNSIGNED DEFAULT 0,
    WarthogDriverShotsFired INT UNSIGNED DEFAULT 0,
    WarthogDriverShotsHit INT UNSIGNED DEFAULT 0,
    WarthogDriverHeadshot INT UNSIGNED DEFAULT 0,
    WarthogTurretKills INT UNSIGNED DEFAULT 0,
    WarthogTurretDeaths INT UNSIGNED DEFAULT 0,
    WarthogTurretSuicide INT UNSIGNED DEFAULT 0,
    WarthogTurretShotsFired INT UNSIGNED DEFAULT 0,
    WarthogTurretShotsHit INT UNSIGNED DEFAULT 0,
    WarthogTurretHeadshot INT UNSIGNED DEFAULT 0,
    WraithKills INT UNSIGNED DEFAULT 0,
    WraithDeaths INT UNSIGNED DEFAULT 0,
    WraithSuicide INT UNSIGNED DEFAULT 0,
    WraithShotsFired INT UNSIGNED DEFAULT 0,
    WraithShotsHit INT UNSIGNED DEFAULT 0,
    WraithHeadshot INT UNSIGNED DEFAULT 0,
    ScorpionCannonKills INT UNSIGNED DEFAULT 0,
    ScorpionCannonDeaths INT UNSIGNED DEFAULT 0,
    ScorpionCannonSuicide INT UNSIGNED DEFAULT 0,
    ScorpionCannonShotsFired INT UNSIGNED DEFAULT 0,
    ScorpionCannonShotsHit INT UNSIGNED DEFAULT 0,
    ScorpionCannonHeadshot INT UNSIGNED DEFAULT 0,
    AssultBombKills INT UNSIGNED DEFAULT 0,
    AssultBombDeaths INT UNSIGNED DEFAULT 0,
    AssultBombSuicide INT UNSIGNED DEFAULT 0,
    AssultBombShotsFired INT UNSIGNED DEFAULT 0,
    AssultBombShotsHit INT UNSIGNED DEFAULT 0,
    AssultBombHeadshot INT UNSIGNED DEFAULT 0,
    PRIMARY KEY(Player_XUID),
    FOREIGN KEY(Player_XUID)
        REFERENCES CS_Player(XUID)
) Engine=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;