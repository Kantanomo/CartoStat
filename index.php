<?php
        include_once "./Shared/DBContext.php";
        include_once "./Shared/DB/PlayerQueries.php";
        include_once "./Shared/DB/MatchQueries.php";
        include_once "./Shared/DB/ServerQueries.php";
        include_once "./Shared/DB/PlaylistQueries.php";
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
            <p class="header-gamertag"><? echo $Player->Gamertag; ?></p>
        </div>

        <div class="profile-container">
            <div class="column profile-details">
                <div class="top-row">
                    <div class="profile-emblem">
                        <img src="<? echo $Player->emblemURL(); ?>"/>
                    </div>
                    <div class="profile-detail">
                        <p>Matches Played:</p>
                        <pre><? echo $Player->getMatchCount(); ?></pre>
                        <p>Win Loss:</p>
                        <pre>10 - 30 (33%)</pre>
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