<?php
print_r($_GET)
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Content/index.css"/>
        <link rel="stylesheet" type="text/css" href="Content/fonts.css"/>
        <link rel="stylesheet" type="text/css" href="Content/flyout.css"/>
        <link rel="stylesheet" type="text/css" href='Content/middle.css'/>
        <link rel="stylesheet" type="text/css" href='Content/scoreboard.css'/>
        <link rel="stylesheet" type="text/css" href='Content/actionbar.css'/>
        <link rel="stylesheet" type="text/css" href='Content/playerdetails.css'/>
        <script src="Scripts/carnagereport.js"></script>
    </head>
    <body style="overflow-x:hidden">
        <?php include './Views/Background.php'; ?>
        <div class="content-container">
            <div class="flyout left">
                <div class="background">
                </div>
            </div>
            <div class="middle-content">
                <div class="action-bar">
                    <div class="spin-controls">
                        <div class="spin-left"></div>
                        <p class="spin-text"></p>
                        <div class="spin-right"></div>
                    </div>
                </div>
                <div class="scoreboard">
                    
                </div>
            </div>
            <div class="flyout right">
                <div class="background">
                    <div class="top-container">
                        <p><h1 data-elm="player-gamertag"> </h1></p>
                        <div class="detail-spinner">
                            <div class="spin-controls">
                                <div class="spin-left"></div>
                                <p class="spin-text">Medals</p>
                                <div class="spin-right"></div>
                            </div>
                        </div>     
                        <div class="rivalry">
                            <p><b>Dominated:</b></p>
                            <pre data-elm="player-dominated"></pre>
                            <p><b>Dominated By:</b></p>
                            <pre data-elm="player-dominatedby"></pre>
                        </div>
     
                    </div>
                    <div class="bottom-container">
                        <div class="medals is-active" data-title="Medals">
                            <div class="medal DoubleKill">
                            </div>
                            <div class="medal TripleKill">
                            </div>
                            <div class="medal Killtacular">
                            </div>
                            <div class="medal KillFrenzy">
                            </div>
                            <div class="medal Killtrocity">
                            </div>
                            <div class="medal Killamanjaro">
                            </div>
                            <div class="medal SniperKill">
                            </div>
                            <div class="medal RoadKill">
                            </div>
                            <div class="medal BoneCracker">
                            </div>
                            <div class="medal Assassin">
                            </div>
                            <div class="medal VehicleDestroyed">
                            </div>
                            <div class="medal CarJacking">
                            </div>
                            <div class="medal StickIt">
                            </div>
                            <div class="medal KillingSpree">
                            </div>
                            <div class="medal RunningRiot">
                            </div>
                            <div class="medal Rampage">
                            </div>
                            <div class="medal Berserker">
                            </div>
                            <div class="medal Overkill">
                            </div>
                            <div class="medal FlagTaken">
                            </div>
                            <div class="medal FlagCarrierKill">
                            </div>
                            <div class="medal FlagReturned">
                            </div>
                            <div class="medal BombPlanted">
                            </div>
                            <div class="medal BombCarrierKill">
                            </div>
                            <div class="medal BombReturned">
                            </div>
                        </div>
                        <div class="weapons" data-title="Weapons">
                            <div class="weapon PlasmaPistol">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon PlasmaRifle">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon BrutePlasmaRifle">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon Magnum">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon Needler">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon SmG">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon SentinelBeam">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon FuelRod">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon BattleRifle">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon BeamRifle">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon BruteShot">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon Carbine">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon RocketLauncher">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon Shotgun">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon SniperRifle">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon EnergySword">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon AssaultBomb">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon Flag">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                            <div class="weapon OddBall">
                                <div class="popout">
                                    <div class="image"></div>
                                    <p class="kills"></p>
                                    <p class="shotsfired"></p>
                                    <p class="shotshit"></p>
                                    <p class="accuracy"></p>
                                    <p class="headshots"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            var matchUUID = "<?php echo $_GET["UUID"]; ?>";
            var url = "http://localhost/Views/MatchScoreBoard.php?Match_UUID=" + matchUUID;
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    document.querySelector('.scoreboard').innerHTML = xhr.responseText;
                    eval(document.querySelector('.scoreboard script').innerText);
                    window["PostGameCarnage"].loadPanels();
                }
            }
            xhr.open('GET', url, true);
            xhr.send(null);
            var url2 = "http://localhost/Views/MatchDetails.php?Match_UUID=" + matchUUID;
            var xhr2 = new XMLHttpRequest();
            xhr2.onreadystatechange = function() {
                if (xhr2.readyState == XMLHttpRequest.DONE) {
                    document.querySelector('.flyout.left .background').innerHTML = xhr2.responseText;
                }
            }
            xhr2.open('GET', url2, true);
            xhr2.send(null);
        });

    </script>
</html>