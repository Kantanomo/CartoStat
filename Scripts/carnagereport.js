var PostGameCarnage = function PostGameCarnage(){
    var _this = this;
    this.scoreboard = document.querySelector('.scoreboard');
    this.actionbar = document.querySelector('.action-bar');
    this.spinLeft = null;
    this.spinRight = null;
    this.spinText = null;
    this.scorePanels = null;
    this.currentPanelIndex = 0;
    this.currentPanel = null;
    this.init();
};

PostGameCarnage.prototype.init = function(){
    var _this = this;
    this.spinLeft = this.actionbar.querySelector('.spin-left');
    this.spinRight = this.actionbar.querySelector('.spin-right');
    this.spinText = this.actionbar.querySelector('.spin-text');

    this.spinLeft.addEventListener('click', function(){
        _this.previousPanel();
    });

    this.spinRight.addEventListener('click', function(){
        _this.nextPanel();
    });
};

PostGameCarnage.prototype.loadPanels = function(){
    var _this = this;
    this.scorePanels = document.querySelectorAll('.scoreboard > div');
    this.scorePanels.forEach(function(panel){
        panel.querySelectorAll('.column.player').forEach(function(player){
            player.addEventListener('click', function(){
                _this.switchActive(player.querySelector('p').innerHTML);
                _this.switchVersus(player.querySelector('p').innerText);
            });
        });
       
    });
    this.changePanel(0);
    this.switchActive(window["Players"][Object.keys(window["Players"])[0]].Gamertag);
    this.switchVersus(window["Players"][Object.keys(window["Players"])[0]].Gamertag);
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

PostGameCarnage.prototype.switchActive = function(playerName){
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
    var selectedPlayer = window["Players"][playerName];
    var versusPanel = this.scoreboard.querySelector('.versus-stats');
    var rows = versusPanel.querySelectorAll('.score-row:not(.header)');
    for(var i = 0; i < rows.length; i++){
        rows[i].querySelector('.killed p').innerText = selectedPlayer["VersusData"][i][0];
        rows[i].querySelector('.killby p').innerText = selectedPlayer["VersusData"][i][1];
    }
};


document.addEventListener("DOMContentLoaded", function(){
    window["PostGameCarnage"] = new PostGameCarnage();
});