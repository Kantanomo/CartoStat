<?php
    function RGBtoHSL( $r, $g, $b ) {
        $r /= 255;
        $g /= 255;
        $b /= 255;
        $max = max( $r, $g, $b );
        $min = min( $r, $g, $b );
        $l = ( $max + $min ) / 2;
        $d = $max - $min;
        if( $d == 0 ){
            $h = $s = 0;
        } else {
            $s = $d / ( 1 - abs( 2 * $l - 1 ) );
            switch( $max ){
                case $r:
                    $h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
                    if ($b > $g) {
                        $h += 360;
                    }
                    break;
                case $g:
                    $h = 60 * ( ( $b - $r ) / $d + 2 );
                    break;
                case $b:
                    $h = 60 * ( ( $r - $g ) / $d + 4 );
                    break;
            }
        }
        return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
    }

    function HSLtoRGB( $h, $s, $l ){
        $c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
        $x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
        $m = $l - ( $c / 2 );
        if ( $h < 60 ) {
            $r = $c;
            $g = $x;
            $b = 0;
        } else if ( $h < 120 ) {
            $r = $x;
            $g = $c;
            $b = 0;
        } else if ( $h < 180 ) {
            $r = 0;
            $g = $c;
            $b = $x;
        } else if ( $h < 240 ) {
            $r = 0;
            $g = $x;
            $b = $c;
        } else if ( $h < 300 ) {
            $r = $x;
            $g = 0;
            $b = $c;
        } else {
            $r = $c;
            $g = 0;
            $b = $x;
        }
        $r = ( $r + $m ) * 255;
        $g = ( $g + $m ) * 255;
        $b = ( $b + $m  ) * 255;
        return array( floor( $r ), floor( $g ), floor( $b ) );
    }












    $primaryBase = array(0, 0, 254);
    $secondaryBase = array(0, 0, 0);

    $playerPrimary = array(255,0,0);
    $playerSecondary = array(255,0,255);
    $emblemPrimary = array(0, 255, 0);
    $emblemSecondary = array(0, 0, 255);


    $backgroundImage = imagecreatefrompng("background_l/1.png");
    #imageAlphaBlending($backgroundImage, true);
    #imageSaveAlpha($backgroundImage, true);

    $sx = imagesx($backgroundImage);
    $sy = imagesy($backgroundImage);
    $newPlayerPrimary = imagecolorallocate($backgroundImage, $playerPrimary[0], $playerPrimary[1], $playerPrimary[2]); 
    $newPlayerSecondary = imagecolorallocate($backgroundImage, $playerSecondary[0], $playerSecondary[1], $playerSecondary[2]); 
    for ($x = 0; $x < $sx; $x++)
    {
        for ($y = 0; $y < $sy; $y++)
        {
            $c = imagecolorat($backgroundImage, $x, $y);
            $r = ($c >> 16) & 0xFF;
            $g = ($c >> 8) & 0xFF;
            $b = $c & 0xFF;
            
            if($r == $primaryBase[0] & $g == $primaryBase[1] & $b == $primaryBase[2]){
                imagesetpixel($backgroundImage, $x, $y, $newPlayerPrimary);
            }
            if($r == $secondaryBase[0] & $g == $secondaryBase[1] & $b == $secondaryBase[2]){
                imagesetpixel($backgroundImage, $x, $y, $newPlayerSecondary);
            }
        }
    }

    #$foregroundImage = 
    #$out = imagecreatetruecolor(imagesx($foregroundImage), imagesy($foregroundImage));

    $primaryEmblemColor = [240, 240, 15];
    $primaryEmblemColorAbsoluteError = [230, 230, 100];
    $primaryEmblemReplacementColor = [0, 255, 0];
    $secondaryEmblemColor = [15, 15, 240];
    $secondaryEmblemColorAbsoluteError = [100, 100, 230];
    $secondaryEmblemReplacementColor = [0, 0, 255];
    
    $im = imagecreatefrompng("foreground_l/5.png");
    $out = imagecreatetruecolor(imagesx($im), imagesy($im));
    $transColor = imagecolorallocatealpha($out, 0, 0, 0, 127);
    imagecolortransparent ($out, 0);
    for ($x = 0; $x < imagesx($im); $x++) {
        for ($y = 0; $y < imagesy($im); $y++) {
            $pixel = imagecolorat($im, $x, $y);
    
            $red = ($pixel >> 16) & 0xFF;
            $green = ($pixel >> 8) & 0xFF;
            $blue = $pixel & 0xFF;
            $alpha = ($pixel & 0x7F000000) >> 24;
    
            if ((($red  >= $primaryEmblemColor[0] - $primaryEmblemColorAbsoluteError[0]) && ($primaryEmblemColor[0] + $primaryEmblemColorAbsoluteError[0]) >= $red) &&
                (($green  >= $primaryEmblemColor[1] - $primaryEmblemColorAbsoluteError[1]) && ($primaryEmblemColor[1] + $primaryEmblemColorAbsoluteError[1]) >= $green) &&
                (($blue  >= $primaryEmblemColor[2] - $primaryEmblemColorAbsoluteError[2]) && ($primaryEmblemColor[2] + $primaryEmblemColorAbsoluteError[2]) >= $blue)){
                $red = $primaryEmblemReplacementColor[0];
                $green= $primaryEmblemReplacementColor[1];
                $blue = $primaryEmblemReplacementColor[2];
            }

            if ((($red  >= $secondaryEmblemColor[0] - $secondaryEmblemColorAbsoluteError[0]) && ($secondaryEmblemColor[0] + $secondaryEmblemColorAbsoluteError[0]) >= $red) &&
            (($green  >= $secondaryEmblemColor[1] - $secondaryEmblemColorAbsoluteError[1]) && ($secondaryEmblemColor[1] + $secondaryEmblemColorAbsoluteError[1]) >= $green) &&
            (($blue  >= $secondaryEmblemColor[2] - $secondaryEmblemColorAbsoluteError[2]) && ($secondaryEmblemColor[2] + $secondaryEmblemColorAbsoluteError[2]) >= $blue)){
                $red = $secondaryEmblemReplacementColor[0];
                $green= $secondaryEmblemReplacementColor[1];
                $blue = $secondaryEmblemReplacementColor[2];
            }

    
            if ($alpha == 127) {
                imagesetpixel($out, $x, $y, $transColor);
            }
            else {
                imagesetpixel($out, $x, $y, imagecolorallocatealpha($out, $red, $green, $blue, $alpha));
            }
        }
    }
    imagesavealpha($out, TRUE);
    imagecopymerge($backgroundImage, $out, 0, 0, 0, 0, 256, 256, 100);
    header('Content-type: image/png');
    imagepng($backgroundImage);

    /*imageAlphaBlending($foregroundImage, true);
    imageSaveAlpha($foregroundImage, true);
    //imagecolortransparent ($foregroundImage, 0);
    $sx = imagesx($foregroundImage);
    $sy = imagesy($foregroundImage);
    $newEmblemPrimary = imagecolorallocate($foregroundImage, $emblemPrimary[0], $emblemPrimary[1], $emblemPrimary[2]); 
    $newEmblemSecondary = imagecolorallocate($foregroundImage, $emblemSecondary[0], $emblemSecondary[1], $emblemSecondary[2]); 
    $transparent = imagecolorallocatealpha($foregroundImage, 0, 0, 0 ,0);
    #$black = imagecolorclosest($foregroundImage,0,0,0);
    #yellowE = imagecolorclosest($foregroundImage, 240, 240, 15);
    #imagecolorset($foregroundImage,$black,0,0,0,0);
    #imagecolorset($foregroundImage,$yellowE,$emblemSecondary[0],$emblemSecondary[1],$emblemSecondary[2],100);
    for ($x = 0; $x < $sx; $x++)
    {
        for ($y = 0; $y < $sy; $y++)
        {
            $c = imagecolorat($foregroundImage, $x, $y);
            $r = ($c >> 16) & 0xFF;
            $g = ($c >> 8) & 0xFF;
            $b = $c & 0xFF;
            if($r == 240 & $g == 240 & $b == 15){
                imagesetpixel($foregroundImage, $x, $y, $newEmblemPrimary);
            }
            if($r == $secondaryBase[0] & $g == $secondaryBase[1] & $b == $secondaryBase[2]){
                imagesetpixel($foregroundImage, $x, $y, $newEmblemSecondary);
            }
            if($r == 0 & $g == 0 & $b == 0){
                imagesetpixel($foregroundImage, $x, $y, $transparent);
            }
        }
    }
    */
    #imagecopymerge($backgroundImage, $foregroundImage, 0, 0, 0, 0, 128, 128, 100);

    
    #header('Content-Type: image/bmp');
    #imagebmp($backgroundImage);
?>