<div class="weapon-stats" data-title="Hit Stats">
    <div class="score-row header">
        <div class="column header player">
            <p>Player</p>
        </div>
        <div class="column header hit">
            <p>Shots Hit</p>
        </div>
        <div class="column header fired">
            <p>Shots Fired</p>
        </div>
        <div class="column header percent">
            <p>Hit %</p>
        </div>
        <div class="column header headshot">
            <p>Head Shots</p>
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
            <div class="column hit <?php echo $Color ?>">
                <p><? echo $Player->ShotsHit ?></p>
            </div>
            <div class="column fired <?php echo $Color ?>">
                <p><? echo $Player->ShotsFired ?></p>
            </div>
            <div class="column percent <?php echo $Color ?>">
                <p><? echo $Player->Accuracy ?>%</p>
            </div>
            <div class="column headshot <?php echo $Color ?>">
                <p><? echo $Player->HeadShots ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>