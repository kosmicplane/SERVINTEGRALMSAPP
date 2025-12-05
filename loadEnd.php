<?php
        if (session_status() === PHP_SESSION_NONE) {
                session_start();
        }

        $result = 0;

        function sanitize_path_segment($segment) {
                return preg_replace('/[^A-Za-z0-9_-]/', '', $segment);
        }

        function sanitize_filename($filename) {
                $cleanName = basename($filename);
                return preg_replace('/[^A-Za-z0-9._-]/', '_', $cleanName);
        }

        function respond_with_result($status, $message = '') {
                $safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
                echo '<script language="javascript" type="text/javascript">(function(){var cb=(window.top&&window.top.loadFinish)||null;if(typeof cb==="function"){cb('.json_encode($status).','.json_encode($safeMessage).');return;}document.write('.json_encode($safeMessage ?: $status).');})();</script>';
                exit;
        }

        if (empty($_SESSION['user'])) {
                respond_with_result('error', 'No hay sesión activa, por favor ingrese de nuevo.');
        }

        if (empty($_FILES) || !is_array($_FILES)) {
                respond_with_result('error', 'No se seleccionó ningún archivo.');
        }

        $itemKeys = array_keys($_FILES);

        if (!isset($itemKeys[0])) {
                respond_with_result('error', 'No se recibió información del archivo.');
        }

        $itemKey = $itemKeys[0];
        $fileInfo = $_FILES[$itemKey] ?? null;
        $itemFolder = sanitize_path_segment(str_replace(['[]'], '', $itemKey));

        if ($itemFolder === '') {
                respond_with_result('error', 'No se recibió el código de la orden.');
        }

        if (empty($fileInfo) || empty($fileInfo['name'])) {
                respond_with_result('error', 'No se seleccionó ningún archivo.');
        }

        $names = $fileInfo['name'];
        $tmpNames = $fileInfo['tmp_name'];
        $errors = $fileInfo['error'];
        $sizes = $fileInfo['size'];

        if (!is_array($names)) {
                $names = [$names];
                $tmpNames = [$tmpNames];
                $errors = [$errors];
                $sizes = [$sizes];
        }

        $destination_path = "/home/izorlnspatmm/public_html/app/irsc/pics/".$itemFolder."/end/";

                 // $destination_path = "/xampp/htdocs/www/servintegral/irsc/pics/".$itemFolder."/end/";

        if (!is_dir($destination_path) && !@mkdir($destination_path, 0755, true)) {
                respond_with_result('error', 'No fue posible preparar la carpeta de destino.');
        }

        $files = glob($destination_path."*"); foreach($files as $file){ if(is_file($file))unlink($file); }

        $allowedExt = ['jpg','jpeg','png'];
        $maxSize = 50 * 1024 * 1024;

        foreach ($names as $index => $name) {
                if ($errors[$index] !== UPLOAD_ERR_OK) {
                        respond_with_result('error', 'Error al cargar el archivo. Código: '.$errors[$index]);
                }

                if (empty($name)) {
                        respond_with_result('error', 'No se seleccionó ningún archivo.');
                }

                if (empty($tmpNames[$index]) || !is_uploaded_file($tmpNames[$index])) {
                        respond_with_result('error', 'No se pudo procesar el archivo cargado.');
                }

                if ($sizes[$index] <= 0 || $sizes[$index] > $maxSize) {
                        respond_with_result('error', 'El archivo supera el tamaño permitido (50MB).');
                }

                $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                if (!in_array($ext, $allowedExt, true)) {
                        respond_with_result('error', 'Tipo de archivo no permitido. Solo se aceptan imágenes JPG o PNG.');
                }

                $target_path =  $destination_path . htmlentities(sanitize_filename($name));
                if(@move_uploaded_file($tmpNames[$index], $target_path)){$result = 1;}else{respond_with_result('error', 'No fue posible guardar el archivo. Consulte con soporte.');}
        }
        respond_with_result('ok', 'Archivo cargado correctamente.');
?>
