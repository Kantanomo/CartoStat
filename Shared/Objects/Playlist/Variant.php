<?php
    class Variant {
        public $UUID;
        public $Playlist_Checksum;
        public $Name;
        public $Type;
        public $Settings;
        function __construct($playlist_Checksum, $jsonData){
            $UUID = UUID::v4();
            $Playlist_Checksum = $playlist_Checksum;
            $Name = $jsonData["Name"];
            $Type = $jsonData["Type"];
            $Settings = $jsonData["Settings"]; 
        }
        function __construct1($dataRow){
            $UUID = $dataRow["UUID"];
            $Playlist_Checksum = $dataRow["Playlist_Checksum"];
            $Name = $dataRow["Name"];
            $Type = $dataRow["Type"];
            $Settings = $dataRow["Settings"];
        }
    }
?>