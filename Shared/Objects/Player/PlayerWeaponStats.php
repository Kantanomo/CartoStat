<?php
    class WeaponStatsIdentifers{
        const Magnum = 0x4DD2CC;
        const Plasma_Pistol = 0x4DD2dc;
        const Needler = 0x4DD2ec;
        const SMG = 0x4DD2fc;
        const Plasma_Rifle = 0x4DD30c;
        const Battle_Rifle = 0x4DD31c;
        const Carbine = 0x4DD32c;
        const Shotgun = 0x4DD33c;
        const Sniper_Rifle = 0x4DD34c;
        const Beam_Rifle = 0x4DD35c;
        const Brute_Plasma_Rifle = 0x4DD36c;
        const Rocket = 0x4DD37c;
        const Fuel_Rod = 0x4DD38C;
        const Bruteshot = 0x4DD39c;
        const Sentinal_Beam = 0x4DD3bc;
        const Energy_Sword = 0x4DD3dc;
        const Frag_grenade = 0x4DD3EC;
        const Plasma_Grenade = 0x4DD3FC;
        const Flag = 0x4DD40c;
        const Bomb = 0x4DD41c;
        const Ball = 0x4DD42c;
        const Large_H_Turret = 0x4DD43c;
        const Large_C_Turret = 0x4DD44c;
        const Banshee = 0x4DD45c;
        const Ghost = 0x4DD46c;
        const Scorpion_Bullet = 0x4DD4448c;
        const Spectre_Turret = 0x4DD4ac;
        const Warthog_Turrent = 0x4DD4cc;
        const Wraith_Mortar = 0x4DD4dc;
        const Scorpion_Shell = 0x4DD4ec;
    }

    class PlayerWeaponStats {
        public string $playerXUID;
        public string $identifier;
        public int $kills;
        public int $deaths;
        public int $suicides;
        public int $shotsFired;
        public int $shotsHit;
        public $accuracy;
        public int $headShots;
        
        public function __construct($playerXUID, $identifier){
            return DBContext::getPlayerWeaponStats($playerXUID, $identifier);
        }
        public function __construct1($playerXUID_, $identifier_, $kills_, $deaths_, $suicides_, $shotsFired_, $shotsHit_, $headShots_){
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
        public function __construct2($datarow){
            $playerXUID = $datarow["playerXUID"];
            $identifier = $datarow["identifier"];
            $kills = $datarow["kills"];
            $deaths = $datarow["deaths"];
            $suicides = $datarow["suicides"];
            $shotsFired = $datarow["shotsFired"];
            $shotsHit = $datarow["shotsHit"];
            $accuracy = $datarow["accuracy"];
            $headShots = $datarow["headShots"];
        }
    }
?>