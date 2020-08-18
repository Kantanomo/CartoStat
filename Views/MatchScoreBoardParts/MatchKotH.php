<?php
?>
<?php if($Variant->Settings["Team Play"] == 1){
    
    $teamScores = array();
    foreach($Players as $Player){
        //Have to convert the Score to an int of total seconds.
        $a = explode(":", str_pad($Player->Score, 5, "0", STR_PAD_LEFT));
        $Score = ($a[0] * 60) + $a[1];
        //Hack to make it strings heh.
        $teamScores[$Player->Team] += $Score;
    }
    uasort($teamScores, function($item, $compare){
        return $item <= $compare;
    });
?>

<div class="team-stats" data-title="Team Stats">
    <div class="score-row header">
        <div class="column header team">
            <p>Team</p>
        </div>
        <div class="column header place">
            <p>Place</p>
        </div>
        <div class="column header score">
            <p>Score</p>
        </div>
    </div>
    <?php foreach($teamScores as $key => $value):?>
    <?php 
        $Color = Colors::teamColors[$key];
    ?>
        <div class = "score-row">
            <div class="column team <?php echo $Color ?>">
                <p>
                    <?php
                        switch($key){
                            case 0:
                                echo "Red Team";
                            break;
                            case 1:
                                echo "Blue Team";
                            break;
                            case 2: 
                                echo "Yellow Team";
                            break;
                            case 3:
                                echo "Green Team";
                            break;
                            case 4:
                                echo "Purple Team";
                            break;
                            case 5:
                                echo "Orange Team";
                            break;
                            case 6:
                                echo "Brown Team";
                            break;
                            case 7:
                                echo "Pink Team";
                            break;
                            case 255:
                                echo "Observer Team";
                            break;
                        }
                    ?>
                </p>
            </div>
            <div class="column place <?php echo $Color ?>">
                <p>
                    <?php
                        $place = array_search($key,array_keys($teamScores)) + 1;
                        if($place == 1) {$place .= "st";}
                        else if($place == 2){$place .= "nd";}
                        else if($place == 3){$place .= "rd";}
                        else {$place .= "th";}
                        echo $place;
                    ?>
                </p>
            </div>
            <div class="column score <?php echo $Color ?>">
                <p>
                    <?php
                        $Score = gmdate("i:s", $value * 2);
                        $Score = ltrim($Score, "0");
                        echo $Score;
                    ?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php } ?>
<div class="player-stats" data-title="Player Stats">
    <div class="score-row header">
        <div class="column header player">
            <p>Player</p>
        </div>
        <div class="column header place">
            <p>Place</p>
        </div>
        <div class="column header kingskilled">
            <p>Kings Killed</p>
        </div>
        <div class="column header kingkills">
            <p>Kills From</p>
        </div>
        <div class="column header score">
            <p>Score</p>
        </div>
    </div> 
    <?php foreach($Players as $Player):?>
    <?
        #if(isset($Variant->Settings["Team"])){
            if($Variant->Settings["Team Play"] == 1){
                $Color = Colors::teamColors[$Player->Team];
         #   } else {
          #      $Color = Colors::colors[$Player->PrimaryColor];    
           # }
        } else {
            $Color = array_keys(Colors::colors)[$Player->PrimaryColor];
        }
    ?>
        <div class = "score-row">
            <div class="column player <? echo $Color ?>" style="background-image:url(<? echo  $Player->emblemURL(); ?>);">
                <p><? echo $Player->Gamertag ?></p>
            </div>
            <div class="column place <?php echo $Color ?>">
                <p><? echo $Player->Place ?></p>
            </div>
            <div class="column kingskilled <?php echo $Color ?>">
                <p><? echo $Player->KingKilledKings; ?></p>
            </div>
            <div class="column kingkills <?php echo $Color ?>">
                <p><? echo $Player->KingKillsAsKing; ?></p>
            </div>
            <div class="column score <?php echo $Color ?>">
                <p><? echo $Player->Score; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>