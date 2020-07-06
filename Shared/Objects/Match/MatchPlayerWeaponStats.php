<?php

    class MatchPlayerWeaponStats {
        public string $playerXUID;
        public string $identifier;
        public int $kills;
        public int $deaths;
        public int $suicides;
        public int $shotsFired;
        public int $shotsHit;
        public $accuracy;
        public int $headShots;
        public function __construct($playerXUID_, $identifier_, $kills_, $deaths_, $suicides_, $shotsFired_, $shotsHit_, $headShots_){
            $playerXUID = $playerXUID_;
            $identifier = $identifier_;
            $kills = $kills_;
            $deaths = $deaths_;
            $suicides = $suicides_;
            $shotsFired = $shotsFired_;
            $shotsHit = $shotsHit_;
            $headShots = $headShots_;
            $accuracy =  floatval($shotsHit) / floatval($shotsFired);
        }        
    }
?>