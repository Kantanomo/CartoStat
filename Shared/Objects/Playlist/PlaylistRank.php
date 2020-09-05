<?php
    class PlaylistRank{
        public $UUID = null;
        public $Playlist = null;
        public $XUID = null;
        public $XP = null;
        public $Rank = null;

        public function __construct() {
            $get_arguments       = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct1($datarow){
            $this->UUID = $datarow["UUID"];
            $this->Playlist = $datarow["Playlist_Checksum"];
            $this->XP = $datarow["XP"];
            $this->Rank = $datarow["Rank"];
        }
        function __construct2($Playlist_Checksum, $XUID){
            $this->UUID = UUID::v4();
            $this->Playlist = $Playlist_Checksum;
            $this->XUID = $XUID;
            $this->XP = 0;
            $this->Rank = "0";
        }
    }
?>