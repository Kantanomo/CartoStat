<?php
    include "ServerMatch.php";
    class Server {
        public $XUID;
        public $Enabled;
        public $Name;
        function __construct($data, $isNew){
            $this->XUID = $data["XUID"];
            $this->name = $data["Name"];
            if($isNew){
                $this->Enabled = 1;
            } else {
                $this->Enabled = $data["Enabled"];            
            }
        }
    }
?>