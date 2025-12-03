<?php
// No mostrar notices ni warnings en la salida (que rompen el JSON)
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

class entryPoint{
    private $params;

    function __construct($info)
    {
        if (isset($_POST["info"])) {
            $this->params = json_decode($_POST["info"], true);
        } else {
            $this->params = json_decode(file_get_contents("php://input"), true);
        }
    }
}
//$entry = new entryPoint($_POST);
//echo $entry->start();
?>
