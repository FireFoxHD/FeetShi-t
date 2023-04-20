<?php
    if(session_status() === PHP_SESSION_NONE) session_start();

    //https://www.w3schools.com/php/php_file_upload.asp
    if (isset($_POST['saveProduct'])){ 
        
        $target_dir = "../uploads/";
        $target_file = $target_dir.basename($_FILES["productImg"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["productImg"]["tmp_name"]);
        if($check === false) {
            setErrorMsg('errProductImg', 'File is not an image');
            $_SESSION['errors'] = true;
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            setErrorMsg('errProductImg', 'File is not an image');
            $_SESSION['errors'] = true;
        }

        // Check file size
        if ($_FILES["productImg"]["size"] > 500000) {
            setErrorMsg('errProductImg', "Sorry, your file is too large.");
            $_SESSION['errors'] = true;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            setErrorMsg('errProductImg', "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $_SESSION['errors'] = true;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == false) {
            setErrorMsg('errProductImg', "Sorry, your file was not uploaded.");
            $_SESSION['errors'] = true;
        
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["productImg"]["tmp_name"], $target_file)) {
                $_SESSION["productImagePath"] = htmlspecialchars(basename( $_FILES["productImg"]["name"]));
                $_SESSION['errProductImg'] = "";
                $_SESSION['imgPath'] = $target_file;
            } else {
                setErrorMsg('errProductImg', "Sorry, your file was not uploaded.");
                $_SESSION['errors'] = true;
            }
        }
    }
?>