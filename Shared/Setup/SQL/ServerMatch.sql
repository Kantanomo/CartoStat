CREATE TABLE CS_ServerMatch(
    Server_XUID BIGINT UNSIGNED,
    Match_UUID VARCHAR(36),
    PRIMARY KEY(Server_XUID, Match_UUID),
    FOREIGN KEY(Server_XUID)
        REFERENCES CS_Server(XUID),
    FOREIGN KEY(Match_UUID)
        REFERENCES CS_Match(UUID)
) Engine=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;