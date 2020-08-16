<?php
    const emblemURI = "http://halo.bungie.net/Stats/emblem.ashx?s=120&0=%s&1=%s&2=%s&3=%s&fi=%s&bi=%s&fl=%s";
    $PrimaryColor = $_GET["P"];
    $SecondaryColor = $_GET["S"];
    $PrimaryEmblem = $_GET["EP"];
    $SecondaryEmblem = $_GET["ES"];
    $EmblemBackground = $_GET["EB"];
    $EmblemForeground = $_GET["EF"];
    $EmblemToggle = $_GET["ET"];
    $image_path = $_SERVER['DOCUMENT_ROOT'] . '/Emblem/Cache/';
    $image_filename = $PrimaryColor . $SecondaryColor . $PrimaryEmblem . $SecondaryEmblem . $EmblemForeground . $EmblemBackground . $EmblemToggle . ".png";
    if(!file_exists($image_path.$image_filename)){
        $URI = sprintf(
            emblemURI,
            $PrimaryColor,
            $SecondaryColor,
            $PrimaryEmblem,
            $SecondaryEmblem,
            $EmblemForeground,
            $EmblemBackground,
            $EmblemToggle
        );
        $image_to_fetch = file_get_contents($URI);
        $local_image_file = fopen($image_path.$image_filename, 'w+');
        chmod($image_path.$image_filename,0755);
        fwrite($local_image_file, $image_to_fetch);
        fclose($local_image_file);
        $oimg = imagecreatefromjpeg('Cache/' . $image_filename);
        $oimgx = imagesx($oimg);
        $oimgy = imagesy($oimg);
        $nx = $oimgx * 1.5;
        $ny = $oimgy * 1.5;
        $nimage = imagecreatetruecolor($nx, $ny);
        imagecopyresampled($nimage, $oimg, 0, 0, 0, 0, $ny, $nx, $oimgx, $oimgy);
        imagepng($nimage, $image_path.$image_filename);
    }
    $img = imagecreatefrompng('Cache/'.$image_filename);
    header('Content-type: image/png');
    imagepng($img);
?>