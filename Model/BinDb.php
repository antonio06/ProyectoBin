<?php
// Clase para la conexión a la base de datos
/**
 * Description of BinDb
 *
 * @author Antonio Contreras Román
 */
class BinDb {
    private static $server = 'localhost';
    private static $db = 'actividadesbin';
    private static $user = 'root';
    private static $password = 'root';
    
//    private static $server = 'crsanti.es';
//    private static $db = 'actividadesbin';
//    private static $user = 'antonio';
//    private static $password = 'antonio';
    /**
     * Este método se encargará de conectarnos a la base de datos actividades.
     * @param string $server nombre del servidor.
     * @param string $db nombre de la base de datos.
     * @param string $user nombre de usuario en la base de datos (root).
     * @param string $password contraseña del usuario en la base de datos (root).
     * @return string  si todo a sido correcto se conecta a la base de datos,
     * en caso contrario nos devuelve un mensaje de error.
     */
    public static function connectDB() {
        try {
            $connection = new PDO("mysql:host=" . self::$server . ";dbname=" . self::$db . ";charset=utf8", self::$user, self::$password);
        } catch (PDOException $e) {
            echo "No se ha podido establecer conexión con el servidor de bases de datos.<br>";
            die("Error: " . $e->getMessage());
        }

        return $connection;
    }
}
