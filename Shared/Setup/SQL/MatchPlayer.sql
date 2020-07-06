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
    Rank TINYINT,
    Nameplate TINYINT,
    Place VARCHAR(16),
    Score VARCHAR(16),
    Kills SMALLINT,
    Assists SMALLINT,
    Betrayals SMALLINT,
    Suicides SMALLINT,
    BestSpree SMALLINT,
    TimeAlive SMALLINT,
    FlagScores SMALLINT,
    FlagSteals SMALLINT,
    FlagSaves SMALLINT,
    FlagUnk SMALLINT,
    BombScores SMALLINT,
    BombKills SMALLINT,
    BombGrabs SMALLINT,
    BallScore SMALLINT,
    BallKills SMALLINT,
    BallCarrierKills SMALLINT,
    KingKillsAsKing SMALLINT,
    KingKilledKings SMALLINT,
    JuggKilledJuggs SMALLINT,
    JuggKillsAsJugg SMALLINT,
    JuggTime SMALLINT,
    TerrTaken SMALLINT,
    TerrLost SMALLINT,
    PRIMARY KEY(UUID, Match_UUID, Player_XUID),
    FOREIGN KEY(Player_XUID)
        REFERENCES CS_Player(XUID),
    FOREIGN KEY(Match_UUID)
        REFERENCES CS_Match(UUID)
);
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