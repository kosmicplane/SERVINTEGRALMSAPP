<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    // Manejo de solicitud OPTIONS (CORS pre-flight)
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit;
    }

    $itemFolder =  array_keys($_FILES)[0];
    $destination_path = "/home/izorlnspatmm/public_html/app/irsc/pics/".$itemFolder."/ini/";

    // CLEAR FOLDER
    $files = glob($destination_path."*");
    foreach ($files as $file) {
        if (is_file($file)) unlink($file);
    }

    // CREATE FILES
    $result = 0;
    for ($i = 0; $i < count($_FILES[$itemFolder]['name']); $i++) {
        $target_path = $destination_path . htmlentities(basename($_FILES[$itemFolder]['name'][$i]));
        if (@move_uploaded_file($_FILES[$itemFolder]['tmp_name'][$i], $target_path)) {
            $result = 1;
        }
    }

    // RETURN TO JS
    echo '<script language="javascript" type="text/javascript">window.top.window.loadFinish("'.$result.'");</script>';
?>
