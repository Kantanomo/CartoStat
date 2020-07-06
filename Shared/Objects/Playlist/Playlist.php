<?php
    class Playlist {
        public $UUID;
        public $Checksum;
        public $Name;
        public $FileName;
        function __construct($jsonData){
            $UUID = UUID::v4();
            $Checksum = $jsonData["UUID"];
            $Name = $jsonData["Name"];
            $FileName = $jsonData["FileName"];            
        }
        function __construct1($dataRow){
            $UUID = $dataRow["UUID"];
            $Checksum = $dataRow["Checksum"];
            $Name = $dataRow["Name"];
            $FileName = $dataRow["FileName"];
        }
    }
?>