<div class="versus-stats" data-title="Player Vs. Player">
    <div class="score-row header">
        <div class="column header player">
            <p>Player</p>
        </div>
        <div class="column header killed">
            <p>Killed</p>
        </div>
        <div class="column header killby">
            <p>Killed By</p>
        </div>
    </div> 
    <?php foreach($Players as $Player):?>
    <?
        #if(isset($Variant->Settings["Team"])){
            if($Variant->Settings["Team"] == 1){
                $Color = Colors::teamColors[$Player->Team];
         #   } else {
          #      $Color = Colors::colors[$Player->PrimaryColor];    
           # }
        } else {
            $Color = Colors::colors[$Player->PrimaryColor];
        }
    ?>
        <div class = "score-row">
            <div class="column player <? echo $Color ?>" style="background-image:url(<? echo  $Player->emblemURL(); ?>);">
                <p><? echo $Player->Gamertag ?></p>
            </div>
            <div class="column killed <?php echo $Color ?>">
                <p></p>
            </div>
            <div class="column killby <?php echo $Color ?>">
                <p></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>