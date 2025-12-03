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

    function start()
    {
        session_start();
        require_once "dataBase.php";
        require_once "authorization.php";
        require_once $this->params["class"].".php";

        $class = $this->params["class"];
        $instance = new $class();
        $method = $this->params["method"];

        $publicEndpoints = array(
            'users' => array('login'),
            'lang' => array('langGet'),
        );

        $exec = null;

        try
        {
            if (!(isset($publicEndpoints[$class]) && in_array($method, $publicEndpoints[$class], true))) {
                $auth = new Authorization();
                $user = $auth->resolveUser($this->params);
                $auth->assertUserConsistency($user, $this->params["data"] ?? []);
                $auth->authorize($class, $method, $user);
            }

            $exec = $instance->$method($this->params["data"]);
            $resp = array("data" => $exec, "exception" => "");
            return json_encode($resp);
        }
        catch (Exception $e)
        {
            $resp = array("data" => $exec, "exception" => $e->getMessage());
            return json_encode($resp);
        }
    }
}

$entry = new entryPoint($_POST);
echo $entry->start();
?>
