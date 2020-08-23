<?
    include_once dirname(__FILE__) . '/Objects/UUID.php';
    class DBContext {

        private static $db;
        private $connection;
        public $Config;
        
        private function __construct() {
            $this->Config = include('Config.php');
            $this->connection = new MySQLi(
                $this->Config["Host"], 
                $this->Config["Username"], 
                $this->Config["Password"], 
                $this->Config["DB"]
            );

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
    }
?>