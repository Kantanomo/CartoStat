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
?>

<div class="top-container">
    <div class="match-map <? echo $Match->Scenario ?>">
        <p class="title"><?php echo ScenarioCache::Names[$Match->Scenario] ?></p>
    </div>
    <div class="match-times">
        <p><b>Played on:</b></p>
        <pre><? echo date_format($Match->Timestamp, 'd/m/Y h:iA'); ?></pre>
        <p><b>Time Ingame:</b></p>
        <pre>30:20</pre>
    </div>
</div>
<div class="bottom-container">
    <p><b>Variant:</b> <? echo $Variant->Name ?></p>
    <p><b>Playlist:</b> 
        <a href="/DownloadPlaylist.php?Checksum=<? echo $Playlist->Checksum ?>">
            <? echo $Playlist->FileName ?>
        </a>
    </p>
    <hr/>
    <? foreach($Variant->Settings as $Setting => $Value): ?>
        <div class="match-setting">
            <b><? echo $Setting ?></b>
            <p><? echo $Value ?></b>
        </div>
    <? endforeach; ?>
</div>