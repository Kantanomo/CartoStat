<div class="kill-stats" data-title="Kills">
    <div class="score-row header">
        <div class="column header player">
            <p>Player</p>
        </div>
        <div class="column header kills">
            <p>Kills</p>
        </div>
        <div class="column header assists">
            <p>Assists</p>
        </div>
        <div class="column header deaths">
            <p>Deaths</p>
        </div>
        <div class="column header suicides">
            <p>Suicides</p>
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
            <div class="column kills <?php echo $Color ?>">
                <p><? echo $Player->Kills ?></p>
            </div>
            <div class="column assists <?php echo $Color ?>">
                <p><? echo $Player->Assists; ?></p>
            </div>
            <div class="column deaths <?php echo $Color ?>">
                <p><? echo $Player->Deaths ?></p>
            </div>
            <div class="column suicides <?php echo $Color ?>">
                <p><? echo $Player->Suicides ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>