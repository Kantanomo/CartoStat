<?php
    $dir = dirname(__FILE__) . "\..\Objects\Playlist\\";
    include_once $dir . "Playlist.php";
    include_once $dir . "PlaylistRank.php";
    include_once $dir . "Variant.php";
    class PlaylistQueries {
        const existsVariantQuery = 'SELECT 1 FROM CS_Variant where Playlist_Checksum = "%s" and `name` = "%s";';
        const insertVariantQuery = 'INSERT INTO CS_Variant VALUES("%s", "%s", "%s", %s, "%s");';
        const selectVariantQuery = 'SELECT * FROM CS_Variant where Playlist_Checksum = "%s" and `name` = "%s";';
        const selectVariantUUIDQuery = 'SELECT * FROM CS_Variant where UUID = "%s";';
        const selectPlaylistQuery = 'SELECT * FROM CS_Playlist WHERE Checksum = "%s";';
        const insertPlaylistQuery = 'INSERT INTO CS_Playlist VALUES("%s", "%s", "%s", "%s");';
        const selectPlaylistUUIDQuery = 'SELECT * FROM CS_Playlist WHERE UUID = "%s";';
        const selectPlaylistRank = 'SELECT * FROM CS_PlaylistRank WHERE Playlist_Checksum = "%s" and Player_XUID = "%s";';
        const insertPlaylistRank = 'INSERT INTO CS_PlaylistRank VALUES("%s", "%s", "%s", "%s", "%s");';
        const updatePlaylistRank = 'UPDATE CS_PlaylistRank SET XP = "%s", Rank = "%s" WHERE UUID = "%s"';

        public static function variantExists($playlistChecksum, $variantName){
            $query = sprintf(
                self::existsVariantQuery,
                $playlistChecksum,
                $variantName
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }
        public static function insertVariant($variant){
            
            $query = sprintf(
                self::insertVariantQuery,
                $variant->UUID,
                $variant->Playlist_Checksum,
                $variant->Name,
                $variant->Type,
                mysqli_real_escape_string(DBContext::getConnection(),json_encode($variant->Settings))
            );
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }
        public static function getVariantUUID($UUID){
            $query = sprintf(
                self::selectVariantUUIDQuery,
                $UUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Variant($result->fetch_assoc());
            }
        }
        public static function getVariant($playlistChecksum, $variantName){
            
            $query = sprintf(
                self::selectVariantQuery,
                $playlistChecksum,
                $variantName
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Variant($result->fetch_assoc());
            }
        }
        public static function playlistExists($Checksum){
            $query = sprintf(
                self::selectPlaylistQuery,
                $Checksum
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }
        public static function getPlaylist($Checksum){
            $query = sprintf(
                self::selectPlaylistQuery,
                $Checksum
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Playlist($result->fetch_assoc(), false);
            }
        }
        public static function getPlaylistUUID($UUID){
            $query = sprintf(
                self::selectPlaylistUUIDQuery,
                $UUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Playlist($result->fetch_assoc(), false);
            }
        }
        public static function insertPlaylist($playlist){
            $query = sprintf(
                self::insertPlaylistQuery,
                $playlist->UUID,
                $playlist->Checksum,
                $playlist->Name,
                $playlist->FileName
            );
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", DBContext::getConnection()->error));
            }
        }
        public static function getPlaylistRank($playlist_Checksum, $xuid){
            $query = sprintf(
                self::selectPlaylistRank,
                $playlist_Checksum, $xuid
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                $temp = new PlaylistRank($playlist_Checksum, $xuid);
                self::insertPlaylistRank($temp);
                return $temp;
            } else {
                return new PlaylistRank($result->fetch_assoc());
            }
        }
        public static function insertPlaylistRank($playlistRank){
            $query = sprintf(
                self::insertPlaylistRank,
                $playlistRank->UUID,
                $playlistRank->Playlist,
                $playlistRank->XUID,
                $playlistRank->XP,
                $playlistRank->Rank
            );
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", DBContext::getConnection()->error));
            }
        }
        public static function updatePlaylistRank($xp, $rank, $uuid){
            $query = sprintf(
                self::updatePlaylistRank,
                $xp,
                $rank,
                $uuid
            );
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", DBContext::getConnection()->error));
            }
        }
    }
?>