<?php
// No mostrar notices ni warnings en la salida (que rompen el JSON)
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

class entryPoint {
    private $params;

    function __construct($info = null)
    {
        // Cargar el JSON que envía el frontend
        if (isset($_POST["info"])) {
            $this->params = json_decode($_POST["info"], true);
        } else {
            $raw = file_get_contents("php://input");
            $this->params = $raw ? json_decode($raw, true) : [];
        }

        if (!is_array($this->params)) {
            $this->params = [];
        }
    }

    function start()
    {
        // Iniciar la sesión solo si no hay una activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        require_once "dataBase.php";
        require_once "authorization.php";

        $class  = $this->params["class"]  ?? null;
        $method = $this->params["method"] ?? null;
        $data   = $this->params["data"]   ?? [];

        // endpoints públicos (sin sesión)
        $publicEndpoints = array(
            'users' => array('login'),
            'lang'  => array('langGet'),
        );

        $exec = null;

        try {
            if (!is_string($class) || !is_string($method)) {
                throw new Exception("Parámetros 'class' o 'method' inválidos");
            }

            require_once $class . ".php";

            $instance = new $class();

            // Si NO es endpoint público => validar sesión y permisos
            if (!(isset($publicEndpoints[$class]) && in_array($method, $publicEndpoints[$class], true))) {
                $auth = new Authorization();
                $user = $auth->resolveUser(['data' => $data]);
                $auth->assertUserConsistency($user, $data);
                $auth->authorize($class, $method, $user);
            }

            if (!method_exists($instance, $method)) {
                throw new Exception("Método {$class}::{$method} no existe");
            }

            $exec = $instance->$method($data);
            $resp = array("data" => $exec, "exception" => "");
        } catch (Throwable $e) { // <-- CLAVE: atrapa Exception, Error, TypeError, etc
            // Log a error_log para ver exactamente qué está fallando
            error_log("MENTRY ERROR: " . $e->getMessage() . " @ " . $e->getFile() . ":" . $e->getLine());
            $resp = array("data" => $exec, "exception" => $e->getMessage());
        }

        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($resp);
    }
}

// ya no hacemos echo al return de start (no devuelve nada)
$entry = new entryPoint($_POST);
$entry->start();
