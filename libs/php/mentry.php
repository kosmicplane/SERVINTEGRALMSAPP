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
            require_once "dataBase.php";
            require_once "authorization.php";
            if (!is_array($this->params)) {
                throw new Exception('Solicitud inválida');
            }

            $class  = $this->params["class"] ?? null;
            $method = $this->params["method"] ?? null;

            if (!$class || !$method) {
                throw new Exception('No se especificó el destino de la solicitud');
            }

            $targetFile = $class . ".php";
            if (!file_exists($targetFile)) {
                throw new Exception('Recurso no disponible');
            }

            require_once $targetFile;

            if (!class_exists($class)) {
                throw new Exception('Clase de destino no encontrada');
            }

            $instance = new $class();

            if (!method_exists($instance, $method)) {
                throw new Exception('Método solicitado no disponible');
            }

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

            $data = $this->params["data"] ?? array();
            $resp["data"] = $instance->$method($data);
        } catch (Exception $e) {
            $resp["exception"] = $e->getMessage();
            error_log('Entrada fallida en mentry: ' . $e->getMessage());
        } catch (Throwable $e) {
            $resp["exception"] = $e->getMessage();
            error_log('Entrada fallida en mentry: ' . $e->getMessage());
        }

        header('Content-Type: application/json');
        return json_encode($resp);
    }
}

$entry = new entryPoint($_POST);
echo $entry->start();
?>
