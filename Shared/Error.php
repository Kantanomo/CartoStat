<?php
    function ErrorOutAndExit($code, $message){
        http_response_code($code);
        header('message', $message);
        exit;
    }
?>