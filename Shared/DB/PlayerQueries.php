<?php
    $dir = dirname(__FILE__);
    include_once $dir . "\..\Objects\Player\Player.php";
    include_once $dir . "\..\Objects\Player\PlayerWeaponStats.php";
    class PlayerQueries {
        const existsPlayerQuery = 'SELECT 1 FROM CS_Player where XUID = %s;';
        const selectPlayerQuery = 'SELECT * FROM CS_player where XUID = "%s";';
        const insertPlayerQuery = 'INSERT INTO CS_Player (XUID, Gamertag, PrimaryColor, SecondaryColor, PrimaryEmblem, SecondaryEmblem, EmblemForeground, EmblemBackground, EmblemToggle, PlayerModel, NamePlate) VALUES(%s, "%s", %s, %s, %s, %s, %s, %s, %s, %s, %s);';
        const insertPlayerWeaponStats = "";
        const updatePlayerWeaponStats = "";
        const selectPlayerWeaponStats = "";

        const getPlayerMatchCount = 'SELECT COUNT(UUID) as "Count" FROM `CS_MatchPlayer` where Player_XUID = "%s";';

        public static function playerExists($XUID){
            
            $query = sprintf(
                self::existsPlayerQuery,
                $XUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }
        public static function insertPlayer($player){
            
            $query = sprintf(
                self::insertPlayerQuery,
                $player->XUID,
                $player->Gamertag,
                $player->PrimaryColor,
                $player->SecondaryColor,
                $player->PrimaryEmblem,
                $player->SecondaryEmblem,
                $player->EmblemForeground,
                $player->EmblemBackground,
                $player->EmblemToggle,
                $player->PlayerModel,
                $player->Nameplate
            );
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                #ErrorOutAndExit('500', 'Server experienced and error when attempting to store a new player');
            }
        }

        public static function getPlayer($playerXUID){
             //Make sure the DBContext is Initalized.
            $query = sprintf(self::selectPlayerQuery, $playerXUID);
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new Player($result->fetch_assoc());
            }
        }
        public static function getPlayerWeaponStats($playerXUID, $identifier){
            
            $query = sprintf(self::selectPlayerWeaponStats, $playerXUID, $identifier);
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new PlayerWeaponStats($result->fetch_assoc());
            }
        }
        public static function playerMatchCount($playerXUID){
            $query = sprintf(
                self::getPlayerMatchCount,
                $playerXUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return 0;
            } else {
                return $result->fetch_assoc()["Count"];
            }
        }
    }
?>