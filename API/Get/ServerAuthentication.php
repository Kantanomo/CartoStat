<?php
    function VerifyJWT($JWT){
        $parts = explode('.', $JWT);
        if(count($parts) != 3){
            return false;
        }
        $dir = dirname(__FILE__);
        $Config = include($dir . "../../../Shared/Config.php");
        $header = $parts[0];
        $payload = $parts[1];
        $signature = $parts[2];        
        $compareSignature = hash_hmac('sha256', $header . "." . $payload, $Config["Secret"], false);
        $compare = Base64UrlEncode($compareSignature);
       
        if($signature != $compare)
            return false;

        $pDecode = json_decode(Base64UrlDecode($payload));
        if($pDecode->EXP < time())
            return false;

        return true;
    }

    function Base64UrlEncode($String){
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($String));
    }
    function Base64UrlDecode($String){
        return base64_decode(str_replace(['-', '_', ''], ['+', '/', '='], $String));
    }
?>