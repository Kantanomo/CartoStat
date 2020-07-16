<?php
    class DBQueries {
        const existsServerQuery = 'SELECT 1 FROM CS_Server where XUID = %s;';
        const selectServerQuery = 'SELECT * FROM CS_Server where XUID = "%s";';
        const insertServerQuery = 'INSERT INTO CS_Server VALUES(%s, 1, "%s");';

        const existsPlayerQuery = 'SELECT 1 FROM CS_Player where XUID = %s;';
        const selectPlayerQuery = 'SELECT * FROM CS_player where player_xuid = %s;';
        const insertPlayerQuery = 'INSERT INTO CS_Player (XUID, Gamertag, PrimaryColor, SecondaryColor, PrimaryEmblem, SecondaryEmblem, EmblemForeground, EmblemBackground, EmblemToggle, PlayerModel, NamePlate) VALUES(%s, "%s", %s, %s, %s, %s, %s, %s, %s, %s, %s);';

        const insertPlayerWeaponStats = "";
        const updatePlayerWeaponStats = "";
        const selectPlayerWeaponStats = "";

        const existsVariantQuery = 'SELECT 1 FROM CS_Variant where Playlist_Checksum = "%s" and `name` = "%s";';
        const insertVariantQuery = 'INSERT INTO CS_Variant VALUES("%s", "%s", "%s", %s, "%s");';
        const selectVariantQuery = 'SELECT * FROM CS_Variant where Playlist_Checksum = "%s" and `name` = "%s";';
        const selectVariantUUIDQuery = 'SELECT * FROM CS_Variant where UUID = "%s";';

        const existsMatchQuery = 'SELECT 1 FROM CS_Match where UUID = "%s";';
        const insertMatchQuery = 'INSERT INTO CS_Match Values("%s", "%s", "%s");';
        const selectMatchQuery = 'SELECT * FROM CS_Match where UUID = "%s";';

        const insertServerMatchQuery = 'INSERT INTO CS_ServerMatch VALUES("%s", "%s");';
        const selectServerMatchQuery = 'SELECT * FROM CS_ServerMatch where Match_UUID="%s";';

        const insertMatchPlayer = 'INSERT INTO CS_MatchPlayer VALUES("%s","%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s");';
        const selectMatchPlayerQuery = 'SELECT * FROM CS_MatchPlayer where Match_UUID = "%s";';

        const insertMatchPlayerMedalQuery = 'INSERT INTO CS_MatchPlayerMedals VALUES("%s", %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);';
        const selectMatchPlayerMedalQuery = 'SELECT * FROM CS_MatchPlayerMedals WHERE MatchPlayer_UUID = "%s";';

        const insertMatchPlayerWeaponQuery = 'INSERT INTO CS_MatchPlayerWeapon VALUES("%s", %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);';
        const selectMatchPlayerWeaponQuery = 'SELECT * FROM CS_MatchPlayerWeapon WHERE MatchPlayer_UUID = "%s";';

        const selectPlaylistQuery = 'SELECT * FROM CS_Playlist WHERE Checksum = "%s";';
        const selectPlaylistUUIDQuery = 'SELECT * FROM CS_Playlist WHERE UUID = "%s";';
    }
?>