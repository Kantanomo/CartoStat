<?php

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
        <div class="background-container">
            <div id="background-top"></div>
            <div id="background-bottom"></div>
            <div class="animated-bg first"></div>
            <div class="animated-bg second"></div>
            <div class="animated-bg third"></div>
            <div class="animated-bg fourth"></div>
            <div class="animated-bg fifth"></div>
            <div class="animated-bg sixth"></div>
            <div class="animated-bg seventh"></div>
            <div class="animated-bg eigth"></div>
            <div class="animated-bg ninth"></div>
            <div class="animated-bg tenth"></div>
        </div>
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
                        <p><h1 data-elm="player-gamertag">Kantanomo</h1></p>
                        <pre></pre>
                        <p><b>Dominated:</b></p>
                        <pre data-elm="player-dominated">Adolf</pre>
                        <p><b>Dominated By:</b></p>
                        <pre data-elm="player-dominatedby">Hitler</pre>
                    </div>
                    <div class="bottom-container">
                        <div class="medals">
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
                        <div class="weapons is-active">
                            <div class="weapon PlasmaPistol"></div>
                            <div class="weapon PlasmaRifle"></div>
                            <div class="weapon BrutePlasmaRifle"></div>
                            <div class="weapon Magnum"></div>
                            <div class="weapon Needler"></div>

                            <div class="weapon SmG"></div>
                            <div class="weapon SentinelBeam"></div>
                            <div class="weapon FuelRod"></div>


                            <div class="weapon BattleRifle"></div>
                            <div class="weapon BeamRifle"></div>
                            
                            <div class="weapon BruteShot"></div>
                            <div class="weapon Carbine"></div>
                            
                           
                            
                            

                            <div class="weapon RocketLauncher"></div>
                            <div class="weapon Shotgun"></div>
                            
                            <div class="weapon SniperRifle"></div>
                            <div class="weapon EnergySword"></div>

                            <div class="weapon AssaultBomb" style="margin-left: 50px;"></div>
                            <div class="weapon Flag"></div>
                            <div class="weapon OddBall"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            var url = "http://localhost/Views/MatchScoreBoard.php?Match_UUID=47ff2567-5e78-4c4f-9a97-a5795583402d";
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
            var url2 = "http://localhost/Views/MatchDetails.php?Match_UUID=47ff2567-5e78-4c4f-9a97-a5795583402d";
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