<?php
define("UPLOAD_DIR", "book_forum/");

if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR . $name);
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    chmod(UPLOAD_DIR . $name, 0644);
$variable1='<li><a href="download.php?f=$name">Download File -$name</a></li>';
$handle=fopen("reference.txt","a");
fwrite($handle,'<li><a href="download.php?f=');
fwrite($handle,$name);
fwrite($handle,'">Download File -');
fwrite($handle,$name);
fwrite($handle,'</a></li>');
fwrite($handle,"\r\n");
fclose($handle);	
}
header ('Location: thankyou.php');
?>
















