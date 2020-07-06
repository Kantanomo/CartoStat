<?php
    class Server {
        public $XUID;
        public $Enabled;
        public $Name;
        function __construct($jsonData){
            $XUID = $jsonData["XUID"];
            $Name = $jsonData["Name"];
        }
        function __construct1($dataRow){
            $XUID = $dataRow["XUID"];
            $name = $dataRow["Name"];
            $Enabled = $dataRow["Enabled"];            
        }
    }
?>