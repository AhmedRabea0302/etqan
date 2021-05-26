<?php
    error_reporting(E_ALL & ~E_NOTICE);
    $fileName = $_FILES["file2"]["name"]; // The file name
    $fileTmpLoc = $_FILES["file2"]["tmp_name"]; // File in the PHP tmp folder
    $fileType = $_FILES["file2"]["type"]; // The type of file it is
    $fileSize = $_FILES["file2"]["size"]; // File size in bytes
    $fileErrorMsg = $_FILES["file2"]["error"]; // 0 for false... and 1 for true
    print_r($fileTmpLoc);

    if (!$fileTmpLoc) { // if file not chosen
        echo "ERROR: Please browse for a file before clicking the upload button.";
        exit();
    }
    if(move_uploaded_file($fileTmpLoc, "../test_uploads/$fileName")){
        echo "  تم تحميل $fileName بنجاح";
    } else {
        echo "فشل في تحميل الملف!";
    }

?>