<?php
    function NewServerRegistration($XUID, $Name, $AuthKey){
        $ip = "";
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $Params = array(
            "XUID" => $XUID,
            "Name" => $Name,
            "AuthKey" => $AuthKey,
            "IP" => $ip
        );
        ServerQueries::insertServer(new Server($Params, true));
    }
    function ServerLogin($AuthKey){
        if(ServerQueries::existsServerAuthKey($AuthKey)){
            $Server = ServerQueries::getServerAuthKey($AuthKey);
            
            $Config = include('../Shared/Config.php');
            $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
            $payload = json_encode(['XUID' => $Server->XUID, 'EXP' => time() + 300]);
            $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
            $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
            $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $Config["Secret"], false);
            $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
            echo $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        }
    }
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
    function GetJWTXUID($JWT){
        $parts = explode('.', $JWT);
        $payload = $parts[1];
        $pDecode = json_decode(Base64UrlDecode($payload));
        return $pDecode->XUID;
    }
    function Base64UrlEncode($String){
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($String));
    }
    function Base64UrlDecode($String){
        return base64_decode(str_replace(['-', '_', ''], ['+', '/', '='], $String));
    }
?>