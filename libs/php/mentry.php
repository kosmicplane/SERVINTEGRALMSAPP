<?php
// No mostrar notices ni warnings en la salida (que rompen el JSON)
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

class entryPoint {
    private $params;

    function __construct($info = null)
    {
        if (isset($_POST["info"])) {
            $this->params = json_decode($_POST["info"], true);
        } else {
            $this->params = json_decode(file_get_contents("php://input"), true);
        }
    }

    function start()
    {
        // Iniciar la sesión solo si no hay una activa
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $resp = array("data" => null, "exception" => "");

        try {
            if (!is_array($this->params) || empty($this->params["class"]) || empty($this->params["method"])) {
                throw new Exception('Parámetros incompletos en la solicitud');
            }

            $class  = $this->params["class"];
            $method = $this->params["method"];

            $filePath = __DIR__ . "/{$class}.php";
            if (!file_exists($filePath)) {
                throw new Exception("Clase solicitada inválida");
            }

            require_once "dataBase.php";
            require_once "authorization.php";
            require_once $filePath;

            if (!class_exists($class) || !method_exists($class, $method)) {
                throw new Exception("Método solicitado inválido");
            }

            $instance = new $class();

            // Endpoints públicos (no requieren sesión / autorización previa)
            $publicEndpoints = array(
                'users' => array('login'),
                'lang'  => array('langGet'),
            );

            // Si NO es un endpoint público, se valida usuario/permiso
            if (!(isset($publicEndpoints[$class]) && in_array($method, $publicEndpoints[$class], true))) {
                $auth = new Authorization();
                $user = $auth->resolveUser($this->params);
                $auth->assertUserConsistency($user, $this->params["data"] ?? []);
                $auth->authorize($class, $method, $user);
            }

            $payload = $this->params["data"] ?? array();
            $resp["data"] = $instance->$method($payload);
        } catch (Exception $e) {
            $resp["exception"] = $e->getMessage();
            error_log('Entrada fallida en mentry: ' . $e->getMessage());
        } catch (Throwable $e) {
            $resp["exception"] = "Error al procesar la solicitud";
            error_log('Entrada fallida en mentry: ' . $e->getMessage());
        }

        header('Content-Type: application/json');
        return json_encode($resp);
    }
}

$entry = new entryPoint($_POST);
echo $entry->start();
?>
