<?php
    class MatchPlayerMedal {
        public $MatchPlayer_UUID;
        public $DoubleKill;
        public $TripleKill;
        public $Killtacular;
        public $KillFrenzy;
        public $Killamanjaro;
        public $SniperKill;
        public $RoadKill;
        public $BoneCracker;
        public $Assassin;
        public $VehicleDestroyed;
        public $CarJacking;
        public $StickIt;
        public $KillingSpree;
        public $RunningRiot;
        public $Rampage;
        public $Berserker;
        public $Overkill;
        public $FlagTaken;
        public $FlagCarrierKill;
        public $FlagReturned;
        public $BombPlanted;
        public $BombCarrierKill;
        public $BombReturned;
        public $Unused1 = 0;
        public $Unused2 = 0;
        public $Unused3 = 0;
        public $Unused4 = 0;
        public $Unused5 = 0;
        public $Unused6 = 0;
        public $Unused7 = 0;
        public $Unused8 = 0;
        public function __construct() {
            $get_arguments       = func_get_args();
            $number_of_arguments = func_num_args();
            if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
                call_user_func_array(array($this, $method_name), $get_arguments);
            }
        }
        function __construct2($matchPlayer_UUID, $jsonData){
           $this->MatchPlayer_UUID = $matchPlayer_UUID;
           $this->DoubleKill = $jsonData[0];
           $this->TripleKill = $jsonData[1];
           $this->Killtacular = $jsonData[2];
           $this->KillFrenzy = $jsonData[3];
           $this->Killtrocity = $jsonData[4];
           $this->Killamanjaro = $jsonData[5];
           $this->SniperKill = $jsonData[6];
           $this->RoadKill = $jsonData[7];
           $this->BoneCracker = $jsonData[8];
           $this->Assassin = $jsonData[9];
           $this->VehicleDestroyed = $jsonData[10];
           $this->CarJacking = $jsonData[11];
           $this->StickIt = $jsonData[12];
           $this->KillingSpree = $jsonData[13];
           $this->RunningRiot = $jsonData[14];
           $this->Rampage = $jsonData[15];
           $this->Berserker = $jsonData[16];
           $this->Overkill = $jsonData[17];
           $this->FlagTaken = $jsonData[18];
           $this->FlagCarrierKill = $jsonData[19];
           $this->FlagReturned = $jsonData[20];
           $this->BombPlanted = $jsonData[21];
           $this->BombCarrierKill = $jsonData[22];
           $this->BombReturned = $jsonData[23];
           #$this->Unused1 = $jsonData[24];
           #$this->Unused2 = $jsonData[25];
           #$this->Unused3 = $jsonData[26];
           #$this->Unused4 = $jsonData[27];
           #$this->Unused5 = $jsonData[28];
           #$this->Unused6 = $jsonData[29];
           #$this->Unused7 = $jsonData[30];
           #$this->Unused8 = $jsonData[31];
        }
        function __construct1($dataRow){
           $this->MatchPlayer_UUID = $dataRow[0];
           $this->DoubleKill = $dataRow[1];
           $this->TripleKill = $dataRow[2];
           $this->Killtacular = $dataRow[3];
           $this->KillFrenzy = $dataRow[4];
           $this->Killtrocity = $dataRow[5];
           $this->Killamanjaro = $dataRow[6];
           $this->SniperKill = $dataRow[7];
           $this->RoadKill = $dataRow[8];
           $this->BoneCracker = $dataRow[9];
           $this->Assassin = $dataRow[10];
           $this->VehicleDestroyed = $dataRow[11];
           $this->CarJacking = $dataRow[12];
           $this->StickIt = $dataRow[13];
           $this->KillingSpree = $dataRow[14];
           $this->RunningRiot = $dataRow[15];
           $this->Rampage = $dataRow[16];
           $this->Berserker = $dataRow[17];
           $this->Overkill = $dataRow[18];
           $this->FlagTaken = $dataRow[19];
           $this->FlagCarrierKill = $dataRow[20];
           $this->FlagReturned = $dataRow[21];
           $this->BombPlanted = $dataRow[22];
           $this->BombCarrierKill = $dataRow[23];
           $this->BombReturned = $dataRow[24];
           #$this->Unused1 = $dataRow[25];
           #$this->Unused2 = $dataRow[26];
           #$this->Unused3 = $dataRow[27];
           #$this->Unused4 = $dataRow[28];
           #$this->Unused5 = $dataRow[29];
           #$this->Unused6 = $dataRow[30];
           #$this->Unused7 = $dataRow[31];
           #$this->Unused8 = $dataRow[32];
        }
        function totalMedals(){
            return (
                $this->DoubleKill +
                $this->TripleKill +
                $this->Killtacular +
                $this->KillFrenzy +
                $this->Killtrocity +
                $this->Killamanjaro +
                $this->SniperKill +
                $this->RoadKill +
                $this->BoneCracker +
                $this->Assassin +
                $this->VehicleDestroyed +
                $this->CarJacking +
                $this->StickIt +
                $this->KillingSpree +
                $this->RunningRiot +
                $this->Rampage +
                $this->Berserker +
                $this->Overkill +
                $this->FlagTaken +
                $this->FlagCarrierKill +
                $this->FlagReturned +
                $this->BombPlanted +
                $this->BombCarrierKill +
                $this->BombReturned);
        }
        function topMedals(){
            $arr = array(
                #"DoubleKill" => $this->DoubleKill,
               # "TripleKill" => $this->TripleKill,
                #"Killtacular" => $this->Killtacular,
               # "KillFrenzy" => $this->KillFrenzy,
               # "Killtrocity" => $this->Killtrocity,
              #  "Killamanjaro" => $this->Killamanjaro,
                "SniperKill" => $this->SniperKill,
                "RoadKill" => $this->RoadKill,
                "BoneCracker" => $this->BoneCracker,
                "Assassin" => $this->Assassin,
                "VehicleDestroyed" => $this->VehicleDestroyed,
                "CarJacking" => $this->CarJacking,
                "StickIt" => $this->StickIt,
                #"KillingSpree" => $this->KillingSpree,
                #"RunningRiot" => $this->RunningRiot,
                #"Rampage" => $this->Rampage,
                #"Berserker" => $this->Berserker,
                #"Overkill" => $this->Overkill,
                "FlagTaken" => $this->FlagTaken,
                "FlagCarrierKill" => $this->FlagCarrierKill,
                "FlagReturned" => $this->FlagReturned,
                "BombPlanted" => $this->BombPlanted,
                "BombCarrierKill" => $this->BombCarrierKill,
                "BombReturned" => $this->BombReturned
            );
            foreach ($arr as $key => $value) {
                if($value == 0){
                    unset($arr[$key]);
                }
            }
            uasort($arr, function($item, $compare){
                return $item <= $compare;
            });
            if($this->Killamanjaro > 0){
                $arr = array("Killamanjaro" => $this->Killamanjaro) + $arr;
            } else if($this->Killtrocity > 0) {
                $arr = array("Killtrocity" => $this->Killtrocity) + $arr;
            } else if($this->KillFrenzy > 0){
                $arr = array("KillFrenzy" => $this->KillFrenzy) + $arr;
            } else if($this->Killtacular > 0){
                $arr = array("Killtacular" => $this->Killtacular) + $arr;
            } else if($this->TripleKill > 0){
                $arr = array("TripleKill" => $this->TripleKill) + $arr;
            } else if($this->DoubleKill > 0){
                $arr = array("DoubleKill" => $this->DoubleKill) + $arr;
            }

            if($this->Overkill > 0){
                $arr = array("Overkill" => $this->Overkill) + $arr;
            } else if($this->Berserker > 0){
                $arr = array("Berserker" => $this->Berserker) + $arr;
            } else if($this->Rampage > 0){
                $arr = array("Rampage" => $this->Rampage) + $arr;
            }  else if($this->RunningRiot > 0){
                $arr = array("RunningRiot" => $this->RunningRiot) + $arr;
            } else if($this->KillingSpree > 0){
                $arr = array("KillingSpree" => $this->KillingSpree) + $arr;
            }
            
            return array_slice($arr, 0, 7);
        }
    }
?>