<?php
    include '../Error.php';
    $Config = include('../Config.php');
    
    $DB = new PDO(
        "mysql:host=" . $Config["Host"] . ";dbname=" . $Config["DB"],
        $Config["Username"],
        $Config["Password"]
    );
    $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $DB->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
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
        "MatchPlayerDamageReport",
        //"MatchPlayerWeapon",
        "Server",
        "ServerMatch",
        "Triggers"
    ];

    foreach($Order as $value){
        try {
            $query = file_get_contents('./SQL/' . $value . '.sql');
            $request = $DB->prepare($query);
            if($request->execute()){
                echo "Created $value Table<br/>";
            }
        } catch (exception $e){
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
    }
?>