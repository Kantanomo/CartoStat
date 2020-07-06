<?php
    include '../Shared/Enum/WeaponType.php';
    class Match{
        public $UUID;
        public $Variant_UUID;
        public $Scenario;
        function __construct(){

        }
        function __construct1($variant_UUID, $scenario){
            $UUID = UUID::v4();
            $Variant_UUID = $variant_UUID;
            $Scenario = $scenario;
        }
        function __construct2($dataRow){
            $UUID = $dataRow["UUID"];
            $Variant_UUID = $dataRow["Variant_UUID"];
            $Scenario = $dataRow["Scenario"];
        }
    }
?>