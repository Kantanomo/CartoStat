CREATE TABLE CS_PlaylistRank(
    Playlist_UUID VARCHAR(36),
    Player_XUID BIGINT UNSIGNED,
    XP INT DEFAULT 0,
    PRIMARY KEY(Playlist_UUID, Player_XUID),
    FOREIGN KEY(Playlist_UUID)
        REFERENCES CS_Playlist(UUID),
    FOREIGN KEY(Player_XUID)
        REFERENCES CS_Player(XUID)
) Engine=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;