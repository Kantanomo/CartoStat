<?php
?>
<div class="slayer-stats">
    <div class="score-row">
        <div class="column header player">
            <p>Player</p>
        </div>
        <div class="column header place">
            <p>Place</p>
        </div>
        <div class="column header life">
            <p>Avg. Life</p>
        </div>
        <div class="column header spree">
            <p>Best Spree</p>
        </div>
        <div class="column header score">
            <p>Score</p>
        </div>
    </div> 
    <?php foreach($Players as $Player):?>
    <?
        $Color = Colors::colors[$Player->PrimaryColor];
    ?>
        <div class = "score-row">
            <div class="column player <? echo $Color ?>" style="background-image:url(<? echo  $Player->emblemURL(); ?>">
                <p><? echo $Player->Gamertag ?></p>
            </div>
            <div class="column place <?php echo $Color ?>">
                <p><? echo $Player->Place ?></p>
            </div>
            <div class="column life <?php echo $Color ?>">
                <p><? echo $Player->AverageLife(); ?></p>
            </div>
            <div class="column spree <?php echo $Color ?>">
                <p><? echo $Player->BestSpree ?></p>
            </div>
            <div class="column score <?php echo $Color ?>">
                <p><? echo $Player->Score ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>