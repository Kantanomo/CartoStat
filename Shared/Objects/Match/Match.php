<?php
    include '../Shared/Enum/WeaponType.php';
    class Match{
        public $UUID = null;
        public $VariantName = null;
        public $VariantType = null;
        public $ScenarionName = null;
        public $VaraintSettings = null;
        public $Server = null;
        public $Players = null;

        function __construct(){

        }
        function __construct1($variantName, $variantType, $variantSettings,
            $server, $players){
                $UUID = UUID::v4();
                $VariantName = $variantName;
                $VariantType = $variantType;
                $VaraintSettings = $variantSettings;
                $Server = $server;
                $Players = $players;
                
        }
        function __construct2($dataRow){
            $UUID = $dataRow["UUID"];
            $VariantName = $dataRow["VariantName"];
            $VariantType = $dataRow["VariantType"];
            $VariantSettings = $dataRow["VariantSettings"];
            $Server = DBContext::getServer($dataRow["Server"]);
            $Players = DBContext::getMatchPlayers($Server->XUID);
        }
    }
?>