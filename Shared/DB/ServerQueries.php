<?php 
    $dir = dirname(__FILE__) . "\..\Objects\Server\\";
    include_once $dir . "Server.php";
    include_once $dir . "ServerMatch.php";
    class ServerQueries {
        const existsServerQuery = 'SELECT 1 FROM CS_Server where XUID = %s;';
        const selectServerQuery = 'SELECT * FROM CS_Server where XUID = "%s";';
        const insertServerQuery = 'INSERT INTO CS_Server VALUES(%s, 1, "%s");';
        const insertServerMatchQuery = 'INSERT INTO CS_ServerMatch VALUES("%s", "%s");';
        const selectServerMatchQuery = 'SELECT * FROM CS_ServerMatch where Match_UUID="%s";';

        public static function serverExists($XUID){
            $query = sprintf(self::existsServerQuery,
                $XUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return false;
            } else {
                return true;
            }
        }

        public static function insertServer($server){
            $query = sprintf(
                self::insertServerQuery,
                $server->XUID,
                $server->Name
            );
            $result = DBContext::getConnection()->query($query);
            if($result == TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', sprintf("%s\n", self::getConnection()->error));
            }
        }

        public static function getServer($serverID){
             //Make sure the DBContext is initialized.
            $query = sprintf(self::selectServerQuery, $serverID);
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                ErrorOutAndExit('500', 'Server not found');
            } else {
                return new Server($result->fetch_assoc(), false);
            }
        }
        
        public static function getServerMatch($UUID){
            $query = sprintf(
                self::selectServerMatchQuery,
                $UUID
            );
            $result = DBContext::getConnection()->query($query);
            if($result->num_rows == 0){
                return null;
            } else {
                return new ServerMatch($result->fetch_assoc());
            }
        }
        
        public static function insertServerMatch($ServerMatch){
            $query = sprintf(
                self::insertServerMatchQuery,
                $ServerMatch->Server_XUID,
                $ServerMatch->Match_UUID
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