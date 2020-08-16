<?php
    function StoreUpload($prefix = ""){
        $uploaddir = "../Uploads/";
        if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name'])){
            $name = $_FILES['file']['name'];
            if($prefix != "")
                $name = $prefix . "_" . $name;
            $type = $_FILES['file']['type'];
            $size = $_FILES['file']['size'];
            $tmp_name = $_FILES['file']['tmp_name'];
            if($type == 'application/json' || $type == 'text/xml' || $type == 'application/xml' || $type == 'application/octet-stream'){
                if($size != 0){
                    if(move_uploaded_file($tmp_name, $uploaddir.$name)){
                        return $uploaddir.$name;
                    } else{
                        ErrorOutAndExit('500', 'There was an issue saving the file on the remote server');
                    }
                } else {
                    ErrorOutAndExit('500', 'Empty file was sent.');
                }
            } else {
                ErrorOutAndExit('500', 'Invalid file type was uploaded.' . $type);
            }
        } else{
            ErrorOutAndExit('500', 'No file was detected.');
        }
    }
?>