<?php
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="Content/index.css"/>
        <link rel="stylesheet" type="text/css" href="Content/fonts.css"/>
        <link rel="stylesheet" type="text/css" href="Content/flyout.css"/>
        <link rel="stylesheet" type="text/css" href='Content/middle.css'/>
        <link rel="stylesheet" type="text/css" href='Content/scoreboard.css'/>
    </head>
    <body style="overflow:hidden">
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
            <!--<div class="flyout left">
                <div class="background">
                </div>
            </div>-->
            <div class="middle-content">
                <div class="action-bar">

                </div>
                <div class="scoreboard">
                    
                </div>
            </div>
            <div class="flyout right">
                <div class="background">
                </div>
            </div>
        </div>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            var url = "http://localhost/Views/MatchDetails.php?Match_UUID=d234f310-74a3-443f-9898-46eacab33c6c";
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    document.querySelector('.scoreboard').innerHTML = xhr.responseText;
                }
            }
            xhr.open('GET', url, true);
            xhr.send(null);
        });

    </script>
</html>