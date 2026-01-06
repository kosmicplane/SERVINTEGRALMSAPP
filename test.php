<?php
require_once('wp-load.php');
if (function_exists('wp')) {
    echo "wp() está cargada correctamente ✅";
} else {
    echo "❌ wp() no está disponible.";
}
