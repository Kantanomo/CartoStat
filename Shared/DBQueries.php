<?php
    class DBQueries {
        const existsServerQuery = 'SELECT TOP 1 FROM CS_Servers where XUID = %s;';
        const selectServerQuery = 'SELECT * FROM CS_Servers where XUID = "%s";';
        const insertServerQuery = 'INSERT INTO CS_Servers VALUES(%s, 1, "%s");';

        const existsPlayerQuery = 'SELECT TOP 1 FROM CS_Players where XUID = %s;';
        const selectPlayerQuery = 'SELECT * FROM CS_players where player_xuid = %s;';
        const insertPlayerQuery = 'INSERT INTO CS_Players (XUID, Gamertag, PrimaryColor, SecondaryColor, PrimaryEmblem, SecondaryEmblem, EmblemForeground, EmblemBackground, EmblemToggle, PlayerModel, NamePlate) VALUES(%s, "%s", %s, %s, %s, %s, %s, %s, %s, %s, %s);';
        const updatePlayerQuery = "";
        //const insertServerQuery;

        const insertPlayerWeaponStats = "";
        const updatePlayerWeaponStats = "";
        const selectPlayerWeaponStats = "";

        const existsVariantQuery = 'SELECT TOP 1 FROM CS_Variant where Playlist_Checksum = "%s" and `name` = "%s";';
        const insertVariantQuery = 'INSERT INTO CS_Variant VALUES("%s", "%s", "%s", %s, "%s");';
        const selectVariantQuery = 'SELECT * FROM CS_Variant where Playlist_Checksum = "%s" and `name` = "%s";';

        const insertMatchQuery = 'INSERT INTO CS_Match Values("%s", "%s", "%s");';
        const selectMatchQuery = 'SELECT * FROM CS_Match where UUID = "%s";';

        const insertMatchPlayer = 'INSERT INTO CS_MatchPlayer VALUES("%s","%s", %s, "%s", %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);';
    }
?>