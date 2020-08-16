<?php
   function XPToRank($XP){
        $Base = null;
        if($XP < 100){
            $Base = 1;
        } else if($XP < 1399) {
            $Base =  1 + floor($XP / 100);
        } else if($XP < 2000 && $XP >= 1399) {   
            $Base = 13 + floor(($XP - 1399) / 200);
        } else if($XP >= 2000) {
            $Base = 17 + floor(($XP - 2000) / 250);
            if($Base >= 50){
                $Base = 50;
            }
        }
        return $Base;
    }
    print(XPToRank(9000));
?>