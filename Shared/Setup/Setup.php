<?php
    include '../Error.php';
    $Config = include('../Config.php');
    
    $DB = new PDO(
        "mysql:host=" . $Config["Host"] . ";dbname=" . $Config["DB"],
        $Config["Username"],
        $Config["Password"]
    );

    $Order = [
        "Playlist",
        "Variant",
        "Player",
        "PlaylistRank",
        "PlayerMedals",
        "PlayerWeapon",
        "Match",
        "MatchPlayer",
        "MatchPlayerMedals",
        "MatchPlayerWeapon",
        "Server",
        "ServerMatch",
        "Triggers"
    ];

    foreach($Order as $value){
        $query = file_get_contents('./SQL/' . $value . '.sql');
        $request = $DB->prepare($query);
        if($request->execute()){
            echo "Created $value Table<br/>";
        } else {
            die(print_r($DB->errorInfo()));
        }
    }
?>