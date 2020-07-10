<?php
    class ServerMatch {
        public $Server_XUID;
        public $Match_UUID;

        public function __construct() {
            $get_arguments       = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct1($data){
            $this->Server_XUID = $data["Server_XUID"];
            $this->Match_UUID = $data["Match_UUID"];
        }
        function __construct2($match_UUID, $server_XUID){
            $this->Server_XUID = $server_XUID;
            $this->Match_UUID = $match_UUID;
        }
    }
?>