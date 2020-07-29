<?php
?>
<div class="player-stats" data-title="Player Stats">
    <div class="score-row header">
        <div class="column header player">
            <p>Player</p>
        </div>
        <div class="column header place">
            <p>Place</p>
        </div>
        <div class="column header jugskilled">
            <p>Jugs Kills</p>
        </div>
        <div class="column header killsasjug">
            <p>Kills as Jug</p>
        </div>
        <div class="column header score">
            <p>Score</p>
        </div>
    </div> 
    <?php foreach($Players as $Player):?>
    <?
        if($Variant->Settings["Team"] == 1){
            $Color = Colors::teamColors[$Player->Team];
        } else {
            $Color = Colors::colors[$Player->PrimaryColor];
        }
    ?>
        <div class = "score-row">
            <div class="column player <? echo $Color ?>" style="background-image:url(<? echo  $Player->emblemURL(); ?>);">
                <p><? echo $Player->Gamertag ?></p>
            </div>
            <div class="column place <?php echo $Color ?>">
                <p><? echo $Player->Place ?></p>
            </div>
            <div class="column jugskilled <?php echo $Color ?>">
                <p><? echo $Player->JuggKilledJuggs; ?></p>
            </div>
            <div class="column killsasjug <?php echo $Color ?>">
                <p><? echo $Player->JuggKillsAsJugg; ?></p>
            </div>
            <div class="column score <?php echo $Color ?>">
                <p><? echo $Player->Score; ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>