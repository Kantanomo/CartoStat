<?php
    include 'MatchPlayer.php';
    include 'MatchPlayerMedal.php';
    include 'MatchPlayerWeapon.php';
    class Match{
        public $UUID;
        public $Variant_UUID;
        public $Scenario;
        public function __construct() {
            $get_arguments       = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct2($variant_UUID, $scenario){
           $this->UUID = UUID::v4();
           $this->Variant_UUID = $variant_UUID;
           $this->Scenario = $scenario;
        }
        function __construct1($dataRow){
           $this->UUID = $dataRow["UUID"];
           $this->Variant_UUID = $dataRow["Variant_UUID"];
           $this->Scenario = $dataRow["Scenario"];
        }
    }
?>