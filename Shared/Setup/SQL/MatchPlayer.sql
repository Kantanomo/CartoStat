CREATE TABLE CS_MatchPlayer(
    UUID VARCHAR(36),
    Match_UUID VARCHAR(36),
    Player_XUID BIGINT UNSIGNED,
    Gamertag VARCHAR(16),
    EndGameIndex TINYINT,
    PrimaryColor TINYINT,
    SecondaryColor TINYINT,
    PrimaryEmblem TINYINT,
    SecondaryEmblem TINYINT,
    EmblemForeground TINYINT,
    EmblemBackground TINYINT,
    EmblemToggle TINYINT,
    PlayerModel TINYINT,
    Team TINYINT,
    Handicap TINYINT,
    Rank TINYINT UNSIGNED,
    Nameplate TINYINT,
    Place VARCHAR(16),
    Score VARCHAR(16),
    Kills SMALLINT UNSIGNED,
    Deaths SMALLINT UNSIGNED,
    Assists SMALLINT UNSIGNED,
    Betrayals SMALLINT UNSIGNED,
    Suicides SMALLINT UNSIGNED,
    ShotsFired SMALLINT UNSIGNED,
    ShotsHit SMALLINT UNSIGNED,
    Accuracy SMALLINT UNSIGNED,
    HeadShots SMALLINT UNSIGNED,
    BestSpree SMALLINT UNSIGNED,
    TimeAlive SMALLINT UNSIGNED,
    FlagScores SMALLINT UNSIGNED,
    FlagSteals SMALLINT UNSIGNED,
    FlagSaves SMALLINT UNSIGNED,
    FlagUnk SMALLINT UNSIGNED,
    BombScores SMALLINT UNSIGNED,
    BombKills SMALLINT UNSIGNED,
    BombGrabs SMALLINT UNSIGNED,
    BallScore SMALLINT UNSIGNED,
    BallKills SMALLINT UNSIGNED,
    BallCarrierKills SMALLINT UNSIGNED,
    KingKillsAsKing SMALLINT UNSIGNED,
    KingKilledKings SMALLINT UNSIGNED,
    JuggKilledJuggs SMALLINT UNSIGNED,
    JuggKillsAsJugg SMALLINT UNSIGNED,
    JuggTime SMALLINT UNSIGNED,
    TerrTaken SMALLINT UNSIGNED,
    TerrLost SMALLINT UNSIGNED,
    VersusData TEXT,
    PRIMARY KEY(UUID, Match_UUID, Player_XUID),
    FOREIGN KEY(Player_XUID)
        REFERENCES CS_Player(XUID),
    FOREIGN KEY(Match_UUID)
        REFERENCES CS_Match(UUID)
) Engine=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/* Uuuuuuuuuuuuuuuuhhhhhhhhhhhhhhhhhh
DELIMITER $$
CREATE TRIGGER MatchPlayerInsert AFTER INSERT ON `MatchPlayer` 
    FOR EACH ROW
        begin
            DECLARE UUID_Exists Boolean;
            SELECT 1
            INTO @UUID_Exists
            FROM Player
            Where Player.UUID = NEW.Player_UUID;

            IF @UUID_Exists THEN
                UPDATE Player 
*/