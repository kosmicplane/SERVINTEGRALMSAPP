<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    // Manejo de solicitud OPTIONS (CORS pre-flight)
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        header('HTTP/1.1 200 OK');
        exit;
    }

    $result = 0;

    function sanitize_path_segment($segment) {
        return preg_replace('/[^A-Za-z0-9_-]/', '', $segment);
    }

    function sanitize_filename($filename) {
        $cleanName = basename($filename);
        return preg_replace('/[^A-Za-z0-9._-]/', '_', $cleanName);
    }

    function respond_with_result($result, $message = '') {
        $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        echo '<script language="javascript" type="text/javascript">(function(){var res="'.addslashes($result).'";var msg="'.addslashes($safeMessage).'";try{if(window.top&&window.top!==window&&window.top.document){var cb=window.top.loadFinish||(window.top.window&&window.top.window.loadFinish);if(typeof cb==="function"){cb(res);return;}}}catch(e){} if(msg){document.write(msg);}else{document.write(res);}})();</script>';
    }

    if (empty($_FILES) || !is_array($_FILES)) {
        respond_with_result(0, 'No files were uploaded.');
        return;
    }

    $itemKeys = array_keys($_FILES);
    $itemFolder = sanitize_path_segment($itemKeys[0]);

    if ($itemFolder === '' || empty($_FILES[$itemFolder]['name']) || !is_array($_FILES[$itemFolder]['name'])) {
        respond_with_result(0, 'No files were uploaded.');
        return;
    }

    $destination_path = "/home/izorlnspatmm/public_html/app/irsc/pics/".$itemFolder."/ini/";

    // CLEAR FOLDER
    $files = glob($destination_path."*");
    foreach ($files as $file) {
        if (is_file($file)) unlink($file);
    }

    // CREATE FILES
    $result = 0;
    for ($i = 0; $i < count($_FILES[$itemFolder]['name']); $i++) {
        $target_path = $destination_path . htmlentities(sanitize_filename($_FILES[$itemFolder]['name'][$i]));
        if (@move_uploaded_file($_FILES[$itemFolder]['tmp_name'][$i], $target_path)) {
            $result = 1;
        }
    }

    // RETURN TO JS
    respond_with_result($result, $result ? '' : 'Upload failed.');
?>
