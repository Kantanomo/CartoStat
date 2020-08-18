<?php
    include '../Shared/Enum/Colors.php';

    $PC = $_GET["P"];
    $SC = $_GET["S"];
    $PE = $_GET["EP"];
    $PS = $_GET["ES"];
    $EB = $_GET["EB"];
    $EF = $_GET["EF"];
    $ET = $_GET["ET"];

    $EmblemWidth = 256;
    $EmblemHeight = 256;
    $PrimaryReplace = array(255,255,0);
    $SecondaryReplace = array(0,0,255);
    
    $ForegroundParts = ""; 

    function SwapColor($image, $originalColor, $color){
        //Pull Colors from arrays
        $r = $color[0];
        $g = $color[1];
        $b = $color[2];
        $or = $originalColor[0];
        $og = $originalColor[1];
        $ob = $originalColor[2];
        //Transverse image by each row
        for($x = 0; $x < imagesx($image); $x++){
            for($y = 0; $y < imagesx($image); $y++){
                $pixel = imagecolorat($image, $x, $y);
                $pa = ($pixel & 0x7F000000) >> 24;
                $pr = ($pixel >> 16) & 0xFF;
                $pg = ($pixel >> 8) & 0xFF;
                $pb = $pixel & 0xFF;

                //Allocate new color using the alpha of the current pixel
                $newColor = imagecolorallocatealpha($image, $r, $g, $b, $pa);
                if($pr == $or & $pg == $og & $pb == $ob){
                    imagesetpixel($image, $x, $y, $newColor);
                }
            }
        }
    }
    function SwapTransparent($image, $color , $reverse){
        $r = $color[0];
        $g = $color[1];
        $b = $color[2];
        $newColor = imagecolorallocate($image, $r, $g, $b);
        for($x = 0; $x < imagesx($image); $x++){
            for($y = 0; $y < imagesx($image); $y++){
                $pixel = imagecolorat($image, $x, $y);
                $pa = ($pixel & 0x7F000000) >> 24;
                //Allocate new color using the alpha of the current pixel
                if($reverse == false){
                    if($pa == 127){
                        imagesetpixel($image, $x, $y, $newColor);
                    }
                } else {
                    if($pa != 127){
                        imagesetpixel($image, $x, $y, $newColor);
                    }
                }
            }
        }
    }
    //Fix for merging images with transparency
    function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $cut = imagecreatetruecolor($src_w, $src_h);
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
    }

    function CreateForeground($index, $toggle, $primaryColor, $secondaryColor){
        $output = imagecreatetruecolor($GLOBALS["EmblemWidth"], $GLOBALS["EmblemHeight"]);
        $background = imagecolorallocate($output , 0, 0, 0);
        imageAlphaBlending($output, true);
        imageantialias($output, true);
        imagesavealpha($output, true);
        if($toggle == false){
            $foregroundOne = imagecreatefrompng("foreground_parts/" . $index . "_0.png");
            
            imagecolortransparent($foregroundOne, $background);
            imageAlphaBlending($foregroundOne, false);
            imageantialias($foregroundOne, true);
            imagesavealpha($foregroundOne, true);
            //SwapColor($foregroundOne, $GLOBALS["PrimaryReplace"], $primaryColor);
            SwapTransparent($foregroundOne, $primaryColor, true);
            imagecopymerge_alpha($output, $foregroundOne, 0, 0, 0, 0, 256, 256, 100);
        }
        $foregroundTwo = imagecreatefrompng("foreground_parts/" . $index . "_1.png");
        imagecolortransparent($foregroundTwo, $background);
        imagesavealpha($foregroundTwo, true);
        imageantialias($foregroundTwo, true);
        //SwapColor($foregroundTwo, $GLOBALS["SecondaryReplace"], $secondaryColor);
        SwapTransparent($foregroundTwo, $secondaryColor, true);
        imagecopymerge_alpha($output, $foregroundTwo, 0, 0, 0, 0, 256, 256, 100);
        imagecolortransparent($output, $background);
        return $output;
    }
    function CreateBackGround($index, $primaryColor, $secondaryColor){
        if($index == 0){
            $output = imagecreatetruecolor($GLOBALS["EmblemWidth"], $GLOBALS["EmblemHeight"]);
            $newColor = imagecolorallocate($output, $primaryColor[0], $primaryColor[1], $primaryColor[2]);
            imagefill($output, 0, 0, $newColor);
            return $output;
        } else if($index == 4){

        } else if ($index == 5){

        } else {
            $backgroundOne = imagecreatefrompng("background_l/" . $index . ".png");
            $background = imagecolorallocate($backgroundOne , 0, 0, 0);
            imagecolortransparent($backgroundOne, $background);   
            imageantialias($backgroundOne, true);
            imageAlphaBlending($backgroundOne, false);
            imagesavealpha($backgroundOne, true);
            SwapTransparent($backgroundOne, $primaryColor, true);
            SwapTransparent($backgroundOne, $secondaryColor, false);
            return $backgroundOne;
        }
    }
    $image_path = $_SERVER['DOCUMENT_ROOT'] . '/Emblem/Cache/';
    $image_filename = $PC . $SC . $PE . $PS . $EF . $EB . $ET . ".png";
    if(!file_exists($image_path.$image_filename)){
        $background = CreateBackGround($EB, Colors::colors[array_keys(Colors::colors)[$SC]], Colors::colors[array_keys(Colors::colors)[$PE]]);
        $foreground = CreateForeground ($EF, $ET, Colors::colors[array_keys(Colors::colors)[$PE]], Colors::colors[array_keys(Colors::colors)[$PS]]);
        $emblem = imagecreatetruecolor($EmblemWidth, $EmblemHeight);
        imageantialias($emblem, true);
        imagecopymerge_alpha($emblem, $background, 0,0,0,0, $EmblemWidth, $EmblemHeight, 100);
        imagecopymerge_alpha($emblem, $foreground, 0,0,0,0, $EmblemWidth, $EmblemHeight, 100);
        imagepng($emblem, $image_path.$image_filename);
    }
    $e = imagecreatefrompng($image_path.$image_filename);
    header('Content-type: image/png');
    imagepng($e);
?>