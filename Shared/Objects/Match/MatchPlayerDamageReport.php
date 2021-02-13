<?php
    class MatchPlayerDamageReport{
        public $ID;
        public $MatchPlayer_UUID;
        public $Type;
        public $Kills;
        public $Deaths;
        public $Betrayals;
        public $Suicides;
        public $ShotsFired;
        public $ShotsHit;
        public $Headshots;

        public $TotalKills;
        public $Accuracy;
        public function __construct() {
            $get_arguments       = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct3($MatchPlayer_UUID, $Type, $DamageReport){
            $this->MatchPlayer_UUID = $MatchPlayer_UUID;
            //Add one because MYSQL adds a default enum case of ''
            $this->Type = $Type + 1;
            $this->Kills = $DamageReport[0];
            $this->Deaths = $DamageReport[1];
            $this->Betrayals = $DamageReport[2];
            $this->Suicides = $DamageReport[3];
            $this->ShotsFired = $DamageReport[4];
            $this->ShotsHit = $DamageReport[5];
            $this->Headshots = $DamageReport[6];
            
        }
        function __construct1($dataRow){
            $this->ID = $dataRow["ID"];
            $this->MatchPlayerUUID = $dataRow["MatchPlayer_UUID"];
            $this->Kills = $dataRow["Kills"];
            $this->Deaths = $dataRow["Deaths"];
            $this->Betrayals = $dataRow["Betrayals"];
            $this->Suicides = $dataRow["Suicides"];
            $this->ShotsFired = $dataRow["ShotsFired"];
            $this->ShotsHit = $dataRow["ShotsHit"];
            $this->Headshots = $dataRow["Headshots"];

            $this->TotalKills = $this->Kills + $this->Headshots;
            $Acc = 0;
            if($this->ShotsFired != "0" && $this->ShotsHit != "0")
                $Acc = round($this->ShotsHit / $this->ShotsFired, 2) * 100;
            $this->Accuracy = $Acc;
        }
    }
?>