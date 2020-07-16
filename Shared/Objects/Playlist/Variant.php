<?php
    class Variant {
        public $UUID;
        public $Playlist_Checksum;
        public $Name;
        public $Type;
        public $Settings;
        public function __construct() {
            $get_arguments       = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct2($playlist_Checksum, $jsonData){
            $this->UUID = UUID::v4();
            $this->Playlist_Checksum = $playlist_Checksum;
            $this->Name = $jsonData["Name"];
            $this->Type = $jsonData["Type"];
            $this->Settings = $jsonData["Settings"]; 
        }
        function __construct1($dataRow){
            $this->UUID = $dataRow["UUID"];
            $this->Playlist_Checksum = $dataRow["Playlist_Checksum"];
            $this->Name = $dataRow["Name"];
            $this->Type = $dataRow["Type"];
            $this->Settings = json_decode($dataRow["Settings"], true);
        }
    }
?>