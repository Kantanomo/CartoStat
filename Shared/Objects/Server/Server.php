<?php
    class Server {
        public $XUID;
        public $Enabled;
        public $RanksEnabled;
        public $Name;
        public $IP;
        public $AuthKey;
        function __construct($data, $isNew){
            $this->XUID = $data["XUID"];
            $this->Name = $data["Name"];
            $this->IP = $data["IP"];
            $this->AuthKey = $data["AuthKey"];
            if($isNew){
                $this->Enabled = 0;
                $this->RanksEnabled = 0;
            } else {
                $this->Enabled = $data["Enabled"];            
                $this->RanksEnabled = $data["RanksEnabled"];
            }
        }
    }
?>