<?php class Model
{
    private static $instancia = null;
    private $conexion;

    private $host = 'localhost';
    private $db   = 'ecommerce_db';
    private $user = 'practica_user';
    private $pass = '';
    private $charset = 'utf8mb4';

    private function __construct()
    {

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->conexion = new PDO($dsn, $this->user, $this->pass, $options);
            
        } catch (PDOException $e) {
            throw new Exception("No se pudo conectar a la base de datos: " . $e->getMessage());
        }
    }

    public static function getInstancia()
    {
        if (self::$instancia == null) {
            self::$instancia = new Model();
        }

        return self::$instancia;
    }

    public function getConexion()
    {
        return $this->conexion;
    }

    public function cerrarConexion()
    {
        $this->conexion = null;
    }
}
