<?php
?>
<div class="medal-stats" data-title="Medals">
    <div class="score-row header">
        <div class="column header player">
            <p>Player</p>
        </div>
        <div class="column header count">
            <p>Total Medals</p>
        </div>
        <div class="column header medals">
            <p>Medals</p>
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
        $medals = $Player->MedalData->topMedals();
        $medalElm = "";
        foreach($medals as $key => $medal){
            $medalElm .= '<i class="postMedal ' . $key . '"></i>';
        }
    ?>
        <div class = "score-row">
            <div class="column player <? echo $Color ?>" style="background-image:url(<? echo  $Player->emblemURL(); ?>">
                <p><? echo $Player->Gamertag ?></p>
            </div>
            <div class="column count <?php echo $Color ?>">
                <div><? echo $Player->MedalData->totalMedals(); ?></div>
            </div>
            <div class="column medals <?php echo $Color ?>">
                <div><? echo $medalElm ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>