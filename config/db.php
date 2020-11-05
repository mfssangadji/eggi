<?php
error_reporting(0);
class Project {
    const DB_SERVER = "localhost";
    const DB_USER   = "root";
    const DB_PASS   = "";
    const DB_NAME   = "s11_eggi";

    public $pdo;
    function __construct(){
        self::connect();
    }

    function connect(){
        $conn = "";
        try{
            $conn = new PDO("mysql:host=".self::DB_SERVER."; dbname=".self::DB_NAME."", self::DB_USER, self::DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('error: '.$e->getMessage());
        }
        return $this->pdo = $conn;
    }
}

$db = new Project;

function select($table, $field, $id){
	global $db;
	$sql = $db->pdo->prepare("select * from tbl_".$table." WHERE id_".$table." = '".$id."'");
	$sql->execute();
	$r   = $sql->fetch();
	return $r[$field];
}
?>