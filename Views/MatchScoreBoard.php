<?php
    include "../Shared/DBContext.php";
    include "../Shared/DB/PlayerQueries.php";
    include "../Shared/DB/ServerQueries.php";
    include "../Shared/DB/MatchQueries.php";
    include "../Shared/DB/PlaylistQueries.php";
    include '../Shared/Enum/Colors.php';
    include '../Shared/Enum/ScenarioCache.php';

    if(!isset($_GET["Match_UUID"])){
        die("No Match Provided");
    } else if(!MatchQueries::matchExists($_GET["Match_UUID"])){
        die("Invalid Match Provided");
    }
    $Match_UUID = $_GET["Match_UUID"];
    $DataArray = array();
    $Match = MatchQueries::getMatch($Match_UUID);
    $ServerMatch = ServerQueries::getServerMatch($Match_UUID);
    $Server = ServerQueries::getServer($ServerMatch->Server_XUID);
    $Variant = PlaylistQueries::getVariantUUID($Match->Variant_UUID);
    $Playlist = PlaylistQueries::getPlaylist($Variant->Playlist_Checksum);
    $Players = MatchQueries::getMatchPlayer($Match_UUID);
    uasort($Players, function($item, $compare){
        return $item->EndGameIndex >= $compare->EndGameIndex;
    });
    switch($Variant->Type){
        case "Capture the Flag":
            includeWithVariables("MatchScoreBoardParts/MatchCTF.php", array("Players" => $Players, "Variant" => $Variant), true); 
        break;
        case "Slayer":
           includeWithVariables("MatchScoreBoardParts/MatchSlayer.php", array("Players" => $Players, "Variant" => $Variant), true);
        break;
        case "Oddball":
            includeWithVariables("MatchScoreBoardParts/MatchOddball.php", array("Players" => $Players, "Variant" => $Variant), true);
        break;
        case "King of the Hill":
            includeWithVariables("MatchScoreBoardParts/MatchKotH.php", array("Players" => $Players, "Variant" => $Variant), true);
        break;
        case "Juggernaut":
            includeWithVariables("MatchScoreBoardParts/MatchJuggernaut.php", array("Players" => $Players, "Variant" => $Variant), true);
        break;
        case "Territories":
            includeWithVariables("MatchScoreBoardParts/MatchTerr.php", array("Players" => $Players, "Variant" => $Variant), true);
        break;
        case "Assault":
            includeWithVariables("MatchScoreBoardParts/MatchAssault.php", array("Players" => $Players, "Variant" => $Variant), true);
        break;
    }
    includeWithVariables("MatchScoreBoardParts/MatchKills.php", array("Players" => $Players, "Variant" => $Variant), true);
    includeWithVariables("MatchScoreBoardParts/MatchVersus.php", array("Players" => $Players, "Variant" => $Variant), true);
    includeWithVariables("MatchScoreBoardParts/MatchMedals.php", array("Players" => $Players, "Variant" => $Variant), true);
    includeWithVariables("MatchScoreBoardParts/MatchWeapons.php", array("Players" => $Players, "Variant" => $Variant), true);

    #Function to render the view with a model passed to it, comparable to MVC RenderViewAsPartial();
    function includeWithVariables($filePath, $variables = array(), $print = true)
    {
        $output = NULL;
        if(file_exists($filePath)){
            extract($variables);
            ob_start();
            include $filePath;
            $output = ob_get_clean();
        }
        if ($print) {
            print $output;
        }
        return $output;

    }
?>
<script>
        window["Players"] = {
            <?php foreach($Players as $Player): ?>
                "<?php echo $Player->Gamertag ?>":
                    (function(){
                        return JSON.parse('<? print(json_encode($Player)); ?>');
                    })(),
            <?php endforeach;?>
        };
</script>