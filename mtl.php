<?php
    $Primary;
    $Secondary;
    $Block = "Content\\models\\Master Chief\\objects\\characters\\masterchief\\bitmaps\\";
    if(!isset($_GET["p"]) && !isset($_GET["s"])){
        $Block .= "masterchief.png";
    } else {
        $Block .= $_GET["p"] . "_" . $_GET["s"] . ".png";
    }
    print( "# Blender MTL File: 'None'\n
    # Material Count: 4\n
    \n
    newmtl None\n
    Ns 500\n
    Ka 0.8 0.8 0.8\n
    Kd 0.8 0.8 0.8\n
    Ks 0.8 0.8 0.8\n
    d 1\n
    illum 2\n
    
    newmtl masterchief\n
    Ns 18.000005\n
    Ka 1.000000 1.000000 0.000000\n
    Kd 0.588000 0.588000 0.588000\n
    Ks 0.000000 0.000000 0.000000\n
    Ke 0.000000 0.000000 0.000000\n
    Ni 1.450000\n
    d 1.000000\n
    illum 1\n
    map_Kd " . $Block . "\n
    map_bump Content\\models\\Master Chief\\objects\\characters\\masterchief\\bitmaps\\masterchief_bump.png\n
    \n
    \n
    newmtl masterchief_visor\n
    Ns 18.000005\n
    Ka 1.000000 1.000000 1.000000\n
    Kd 0.588000 0.588000 0.588000\n
    Ks 0.000000 0.000000 0.000000\n
    Ke 0.000000 0.000000 0.000000\n
    Ni 1.450000\n
    d 1.000000\n
    illum 1\n
    map_Kd Content\\models\\Master Chief\\objects\\bitmaps\\reflection_maps\\mirror_surface.png\n
    \n
    newmtl mc_emblem\n
    Ns 18.000005\n
    Ka 1.000000 1.000000 1.000000\n
    Kd 0.588000 0.588000 0.588000\n
    Ks 0.000000 0.000000 0.000000\n
    Ke 0.000000 0.000000 0.000000\n
    Ni 1.450000\n
    d 1.000000\n
    illum 1\n
    map_Kd " . $Block);
?>