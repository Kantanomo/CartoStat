<?php
        include "./Shared/DBContext.php";
        include "./Shared/DB/PlayerQueries.php";
        include "./Shared/Objects/Player/Player.php";
        include './Shared/Objects/Server/Server.php';
        include './Shared/Objects/Match/Match.php';
        include './Shared/Objects/Playlist/Playlist.php';
        include './Shared/Objects/Playlist/Variant.php';
        include './Shared/Enum/Colors.php';
        include './Shared/Enum/ScenarioCache.php';
        $Player = PlayerQueries::getPlayer("1234561000159307");
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Content/index.css"/>
        <link rel="stylesheet" type="text/css" href="Content/fonts.css"/>
        <link rel="stylesheet" type="text/css" href='Content/profile.css'/>
    </head>
    <body style="overflow-x:hidden">
        <?php include './Views/Background.php'; ?>
        <div class="profile-header">
            <div class="header-actions">
                <a href="#">Home</a>
            </div>
            <p class="header-gamertag"><? echo $Player->Gamertag ?></p>
        </div>

        <div class="profile-container">
            <div class="column profile-details">
                <div class="top-row">
                    <div class="profile-emblem">
                        <img src="<? echo $Player->emblemURL() ?>"/>
                    </div>
                    <div class="profile-detail">
                        <p>Matches Played:</p>
                        <pre>
                    </div>
                </div>
                <div class="bottom-row">

                </div>
            </div>
            <div class="column"></div>
            <div class="column"></div>
        </div>
    </body>
</html>