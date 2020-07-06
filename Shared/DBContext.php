<?
    include './Shared/DBQueries.php';

    class DBContext {

        private static $db;
        private $connection;
        
        private function __construct() {
            $this->connection = new MySQLi(/* credentials */);
        }

        function __destruct() {
            $this->connection->close();
        }

        public static function getConnection() {
            if (self::$db == null) {
                self::$db = new DBContext();
            }
            return self::$db->connection;
        }
        public static function getServer($serverID){
            getConnection(); //Make sure the DBContext is initialized.
            $query = printf(DBQueries::serverQuery, $serverID);
            $result = $db->query($query);
            if($result->num_rows === 0){
                return null;
            } else {
                return new Server($result->fetch_row());
            }
        }
        
        public static function insertPlayer($playerXUID, $playerName, $emblemArray){
            getConnection();
            $query = printf(DBQueries::insertPlayerQuery, $playerXUID, mysql_real_escape_string($playerName), $emblemArray);
            $result = $db->query($query);
            if($result === TRUE){
                return true;
            } else {
                ErrorOutAndExit('500', 'Server experienced and error when attempting to store a new player');
            }
        }
        public static function getPlayer($playerXUID){
            getConnection(); //Make sure the DBContext is Initalized.
            $query = printf(DBQueries::selectPlayerQuery, $playerXUID);
            $result = $db->query($query);
            if($result->num_rows === 0){
                return null;
            } else {
                return new Player($result->fetch_row());
            }
        }
        public static function getPlayerWeaponStats($playerXUID, $identifier){
            getConnection();
            $query = printf(DBQueries::selectPlayerWeaponStats, $playerXUID, $identifier);
            $result = $db->query($query);
            if($result->num_rows === 0){
                return null;
            } else {
                return new PlayerWeaponStats($result->fetch_row());
            }
        }
    }
?>