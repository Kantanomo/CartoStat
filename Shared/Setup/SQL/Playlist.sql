CREATE TABLE CS_Playlist(
    UUID VARCHAR(36),
    Checksum VARCHAR(32),
    Name VARCHAR(50),
    FileName VARCHAR(50),
    PRIMARY KEY(UUID),
    KEY(Checksum)
) Engine=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;