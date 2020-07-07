<?php
    include "Shared/DBContext.php";
    include "Shared/Objects/Player/Player.php";
    include 'Shared/Objects/Server/Server.php';
    include 'Shared/Objects/Match/Match.php';
    include 'Shared/Objects/Playlist/Playlist.php';
    include 'Shared/Objects/Playlist/Variant.php';

    $start_time = microtime(true); 
    $Match = DBContext::getMatch("d234f310-74a3-443f-9898-46eacab33c6c");
    $Variant = DBContext::getVariantUUID($Match->Variant_UUID);
    $Players = DBContext::getMatchPlayer($Match->UUID);

    uasort($Players, function($item, $compare){
        return $item->EndGameIndex >= $compare->EndGameIndex;
    });

    $end_time = microtime(true); 
    $execution_time = ($end_time - $start_time); 
    echo " Execution time of script = ".$execution_time." sec"; 
    
    
    print("<pre>".print_r($Match,true)."</pre>");
    print("<pre>".print_r($Variant,true)."</pre>");
    print("<pre>".print_r($Players,true)."</pre>");
?>