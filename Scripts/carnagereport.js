var PostGameCarnage = function PostGameCarnage(){
    var _this = this;
    this.scoreboard = document.querySelector('.scoreboard');
    this.actionbar = document.querySelector('.action-bar');
    this.spinLeft = null;
    this.spinRight = null;
    this.spinText = null;
    this.detailbar = document.querySelector('.detail-spinner');
    this.detailSpinLeft = null;
    this.detailSpinRight = null;
    this.detailSpinText = null;
    this.medalsPanel = document.querySelector('.bottom-container .medals');
    this.weaponsPanel = document.querySelector('.bottom-container .weapons');
    this.scorePanels = null;
    this.currentPanelIndex = 0;
    this.currentPanel = null;
    this.currentDetail = "Medals";
    this.details = null;
    this.players = null;
    this.init();
};

PostGameCarnage.prototype.init = function(){
    var _this = this;
    this.spinLeft = this.actionbar.querySelector('.spin-left');
    this.spinRight = this.actionbar.querySelector('.spin-right');
    this.spinText = this.actionbar.querySelector('.spin-text');
    this.detailSpinLeft = this.detailbar.querySelector('.spin-left');
    this.detailSpinRight = this.detailbar.querySelector('.spin-right');
    this.detailSpinText = this.detailbar.querySelector('.spin-text');

    this.spinLeft.addEventListener('click', function(){
        _this.previousPanel();
    });

    this.spinRight.addEventListener('click', function(){
        _this.nextPanel();
    });

    this.detailSpinLeft.addEventListener('click', function(){
        _this.switchDetail();
    });

    this.detailSpinRight.addEventListener('click', function(){
        _this.switchDetail();
    });

    this.details = {
        "Gamertag" : document.querySelector('[data-elm="player-gamertag"]'),
        "Dominated": document.querySelector('[data-elm="player-dominated"]'),
        "DominatedBy": document.querySelector('[data-elm="player-dominatedby"]'),
        "Medals": {
            "DoubleKill": document.querySelector('.flyout.right .doublekill'),
            "TripleKill": document.querySelector('.flyout.right .triplekill'),
            "Killtacular": document.querySelector('.flyout.right .Killtacular'),
            "KillFrenzy": document.querySelector('.flyout.right .KillFrenzy'),
            "Killtrocity": document.querySelector('.flyout.right .Killtrocity'),
            "Killamanjaro": document.querySelector('.flyout.right .Killamanjaro'),
            "SniperKill": document.querySelector('.flyout.right .SniperKill'),
            "RoadKill": document.querySelector('.flyout.right .RoadKill'),
            "BoneCracker": document.querySelector('.flyout.right .BoneCracker'),
            "Assassin": document.querySelector('.flyout.right .Assassin'),
            "VehicleDestroyed": document.querySelector('.flyout.right .VehicleDestroyed'),
            "CarJacking": document.querySelector('.flyout.right .CarJacking'),
            "StickIt": document.querySelector('.flyout.right .StickIt'),
            "KillingSpree": document.querySelector('.flyout.right .KillingSpree'),
            "RunningRiot": document.querySelector('.flyout.right .RunningRiot'),
            "Rampage": document.querySelector('.flyout.right .Rampage'),
            "Berserker": document.querySelector('.flyout.right .Berserker'),
            "Overkill": document.querySelector('.flyout.right .Overkill'),
            "FlagTaken": document.querySelector('.flyout.right .FlagTaken'),
            "FlagCarrierKill": document.querySelector('.flyout.right .FlagCarrierKill'),
            "FlagReturned": document.querySelector('.flyout.right .FlagReturned'),
            "BombPlanted": document.querySelector('.flyout.right .BombPlanted'),
            "BombCarrierKill": document.querySelector('.flyout.right .BombCarrierKill'),
            "BombReturned": document.querySelector('.flyout.right .BombReturned'),
        },
        "Weapons": {
            "PlasmaPistol": document.querySelector('.flyout.right .PlasmaPistol'),
            "PlasmaRifle": document.querySelector('.flyout.right .PlasmaRifle'),
            "BrutePlasmaRifle": document.querySelector('.flyout.right .BrutePlasmaRifle'),
            "Magnum": document.querySelector('.flyout.right .Magnum'),
            "Needler": document.querySelector('.flyout.right .Needler'),
            "SubMachineGun": document.querySelector('.flyout.right .SmG'),
            "SentinalBeam": document.querySelector('.flyout.right .SentinelBeam'),
            "FuelRodCannon": document.querySelector('.flyout.right .FuelRod'),
            "BattleRifle": document.querySelector('.flyout.right .BattleRifle'),
            "BeamRifle": document.querySelector('.flyout.right .BeamRifle'),
            "Bruteshot": document.querySelector('.flyout.right .BruteShot'),
            "Carbine": document.querySelector('.flyout.right .Carbine'),
            "RocketLauncher": document.querySelector('.flyout.right .RocketLauncher'),
            "Shotgun": document.querySelector('.flyout.right .Shotgun'),
            "SniperRifle": document.querySelector('.flyout.right .SniperRifle'),
            "EnergySword": document.querySelector('.flyout.right .EnergySword'),
            "AssaultBomb": document.querySelector('.flyout.right .AssaultBomb'),
            "CTFFlag": document.querySelector('.flyout.right .Flag'),
            "OddballSkull": document.querySelector('.flyout.right .OddBall')
        }
    };
};

PostGameCarnage.prototype.loadPanels = function(){
    var _this = this;
    this.scorePanels = document.querySelectorAll('.scoreboard > div');
    this.players = window["Players"];

    this.scorePanels.forEach(function(panel){
        panel.querySelectorAll('.column.player').forEach(function(player){
            player.addEventListener('click', function(){
                _this.switchActivePlayer(player.querySelector('p').innerHTML);
                _this.switchVersus(player.querySelector('p').innerText);
                _this.switchPlayerDetails(player.querySelector('p').innerText);
            });
        });
       
    });
    this.changePanel(0);
    this.switchActivePlayer(window["Players"][Object.keys(window["Players"])[0]].Gamertag);
    this.switchVersus(window["Players"][Object.keys(window["Players"])[0]].Gamertag);
    this.switchPlayerDetails(window["Players"][Object.keys(window["Players"])[0]].Gamertag);
};

PostGameCarnage.prototype.changePanel = function(panelIndex){
    this.scorePanels[this.currentPanelIndex].classList.remove("is-active");
    this.scorePanels[panelIndex].classList.add("is-active");
    this.spinText.innerHTML = this.scorePanels[panelIndex].getAttribute('data-title');
    this.currentPanelIndex = panelIndex;
    this.currentPanel = this.scorePanels[panelIndex];
};

PostGameCarnage.prototype.nextPanel = function(){
    if(this.currentPanelIndex == this.scorePanels.length - 1)
        this.changePanel(0);
    else
        this.changePanel(this.currentPanelIndex + 1);
};

PostGameCarnage.prototype.previousPanel = function(){
    if(this.currentPanelIndex - 1 < 0)
        this.changePanel(this.scorePanels.length - 1);
    else
        this.changePanel(this.currentPanelIndex - 1);
};

PostGameCarnage.prototype.switchDetail = function(detailIndex){
    if(this.currentDetail == "Medals"){
        this.medalsPanel.classList.remove('is-active');
        this.weaponsPanel.classList.add('is-active');
        this.currentDetail = "Weapons";
        this.detailSpinText.innerText = "Weapons";
    } else if(this.currentDetail == "Weapons"){
        this.medalsPanel.classList.add('is-active');
        this.weaponsPanel.classList.remove('is-active');
        this.currentDetail = "Medals";
        this.detailSpinText.innerText = "Medals";
    }
}


PostGameCarnage.prototype.switchActivePlayer = function(playerName){
    this.scorePanels.forEach(function(panel){
        panel.querySelectorAll('.column.player').forEach(function(player){
            player.parentElement.classList.remove('is-active');
        });
        panel.querySelectorAll('.column.player p').forEach(function(player){
            if(player.innerText == playerName)
                player.parentElement.parentElement.classList.add('is-active');
        });
    });
};

PostGameCarnage.prototype.switchVersus = function(playerName){
    var selectedPlayer = this.players[playerName];
    var versusPanel = this.scoreboard.querySelector('.versus-stats');
    var rows = versusPanel.querySelectorAll('.score-row:not(.header)');
    for(var i = 0; i < rows.length; i++){
        rows[i].querySelector('.killed p').innerText = selectedPlayer["VersusData"][i][0];
        rows[i].querySelector('.killby p').innerText = selectedPlayer["VersusData"][i][1];
    }
};

PostGameCarnage.prototype.switchPlayerDetails = function(playerName){
    var selectedPlayer = this.players[playerName];
    this.details["Gamertag"].innerText = playerName;

    var DominatedIndex = null;
    var DominatedVal = 1; //Has to be above 0
    for(var key in selectedPlayer["VersusData"]){
        if(selectedPlayer["VersusData"][key][0] > DominatedVal){
            DominatedVal = selectedPlayer["VersusData"][key][0];
            DominatedIndex = key;
        }
    }
    this.details["Dominated"].innerText = (DominatedIndex !== null) ?
        this.getPlayerByEndGameIndex(DominatedIndex).Gamertag : " ";

    var DominatedByIndex = null;
    var DominatedByVal = 1; //Has to be above 0
    for(var key in selectedPlayer["VersusData"]){
        if(selectedPlayer["VersusData"][key][1] > DominatedByVal){
            DominatedByVal = selectedPlayer["VersusData"][key][0];
            DominatedByIndex = key;
        }
    }
    this.details["DominatedBy"].innerText = (DominatedIndex !== null) ?
        this.getPlayerByEndGameIndex(DominatedByIndex).Gamertag : " ";

    for(var key in selectedPlayer["MedalData"]){
        if(Object.keys(this.details["Medals"]).indexOf(key) !== -1){
            this.details["Medals"][key].innerText = selectedPlayer["MedalData"][key];
        }
    }
    for(var key in this.details["Weapons"]){
        this.details["Weapons"][key].querySelector('.Kills').innerText = "Kills: " + (parseInt(selectedPlayer["WeaponData"][key + "Kills"]) + parseInt(selectedPlayer["WeaponData"][key + "Headshot"]));
        this.details["Weapons"][key].querySelector('.shotsfired').innerText = "Shots Fired: " + selectedPlayer["WeaponData"][key + "ShotsFired"];
        this.details["Weapons"][key].querySelector('.shotshit').innerText = "Shots Hit: " + selectedPlayer["WeaponData"][key + "ShotsHit"];
        var acc = (parseInt(selectedPlayer["WeaponData"][key + "ShotsHit"]) / parseInt(selectedPlayer["WeaponData"][key + "ShotsFired"]));
        if(acc == Infinity || acc == NaN)
            acc = 0;
        this.details["Weapons"][key].querySelector('.accuracy').innerText = "Accuracy: " + acc + "%";
        this.details["Weapons"][key].querySelector('.headshots').innerText = "Headshots: " + parseInt(selectedPlayer["WeaponData"][key + "Headshot"]);
    }
};

PostGameCarnage.prototype.getPlayerByEndGameIndex = function(endGameIndex){
    for(var key in this.players){
        if(this.players[key].EndGameIndex == endGameIndex){
            return this.players[key];
        }
    }
}

document.addEventListener("DOMContentLoaded", function(){
    window["PostGameCarnage"] = new PostGameCarnage();
});