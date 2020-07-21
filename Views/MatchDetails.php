<?php
    include "../Shared/DBContext.php";
    include "../Shared/Objects/Player/Player.php";
    include '../Shared/Objects/Server/Server.php';
    include '../Shared/Objects/Match/Match.php';
    include '../Shared/Objects/Playlist/Playlist.php';
    include '../Shared/Objects/Playlist/Variant.php';
    include '../Shared/Enum/Colors.php';
    include '../Shared/Enum/ScenarioCache.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if(!isset($_GET["Match_UUID"])){
        die("No Match Provided");
    } else if(!DBContext::matchExists($_GET["Match_UUID"])){
        die("Invalid Match Provided");
    }
    $Match_UUID = $_GET["Match_UUID"];
    $DataArray = array();
    $Match = DBContext::getMatch($Match_UUID);
    $ServerMatch = DBContext::getServerMatch($Match_UUID);
    $Server = DBContext::getServer($ServerMatch->Server_XUID);
    $Variant = DBContext::getVariantUUID($Match->Variant_UUID);
    $Playlist = DBContext::getPlaylist($Variant->Playlist_Checksum);
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