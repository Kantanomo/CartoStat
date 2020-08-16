CREATE TABLE CS_PlaylistRank(
    UUID VARCHAR(36),
    Playlist_Checksum VARCHAR(33),
    Player_XUID BIGINT UNSIGNED,
    XP INT DEFAULT 0,
    Rank INT DEFAULT 0,
    PRIMARY KEY(UUID, Playlist_Checksum, Player_XUID),
    FOREIGN KEY(Playlist_Checksum)
        REFERENCES CS_Playlist(Checksum),
    FOREIGN KEY(Player_XUID)
        REFERENCES CS_Player(XUID)
) Engine=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;