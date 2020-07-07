<?php
    class Playlist {
        public $UUID;
        public $Checksum;
        public $Name;
        public $FileName;
        
        function __construct($data, $isNew){
            if($isNew){
                $this->UUID = UUID::v4();
            } else {
                $this->UUID = $data["UUID"];
            }
            $this->Checksum = $data["Checksum"];
            $this->Name = $data["Name"];
            $this->FileName = $data["FileName"];   
        }
    }
?>