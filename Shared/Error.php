<?php
    function ErrorOutAndExit($code, $message){
        die($message);
        #http_response_code($code);
        #header('message', $message);
        #exit;
    }
?>