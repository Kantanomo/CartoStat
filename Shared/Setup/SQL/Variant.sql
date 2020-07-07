CREATE TABLE CS_Variant(
    UUID VARCHAR(36),
    Playlist_Checksum VARCHAR(32),
    Name VARCHAR(16),
    Type ENUM("Capture the Flag", 
        "Slayer", 
        "Oddball", 
        "King of the Hill", 
        "Unused1", 
        "Unused2", 
        "Juggernaut", 
        "Territories", 
        "Assault"),
    Settings TEXT,
    PRIMARY KEY(UUID),
    KEY(Playlist_Checksum, Name),
    FOREIGN KEY(Playlist_Checksum)
        REFERENCES CS_Playlist(Checksum)
) Engine=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;