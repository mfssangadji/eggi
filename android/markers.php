<?php 
	error_reporting(0);
	class Project {
	    const DB_SERVER = "localhost";
	    const DB_USER   = "root";
	    const DB_PASS   = "";
	    const DB_NAME   = "s11_udin";

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

	$query = $db->pdo->prepare("SELECT * FROM tbl_pendaki, tbl_kelompok, tbl_pendakian
								where tbl_pendaki.id_kelompok = tbl_kelompok.id_kelompok
								AND tbl_kelompok.id_kelompok = tbl_pendakian.id_kelompok
								AND tbl_pendaki.status_pendakian = '1' ORDER BY 1 ASC");
	$query->execute();
	
	$json = '{"pendaki": [';
	while ($row = $query->fetch()){
		$char ='"';

		$json .= 
		'{
			"id_pendaki":"'.str_replace($char,'`',strip_tags($row['id_pendaki'])).'", 
			"status_pendaki":"'.str_replace($char,'`',strip_tags($row['status_pendaki'] == 1 ? "Ketua" : "Anggota"))." ".str_replace($char,'`',strip_tags($row['nama_kelompok'])).'",
			"nip":"'.str_replace($char,'`',strip_tags("NIK: ".$row['nik'])).'",
			"nama_lengkap":"'.str_replace($char,'`',strip_tags("Nama Lengkap: ".$row['nama_lengkap'])).'",
			"lintangx":"'.str_replace($char,'`',strip_tags("Lintang: ".$row['lintang'])).'",
			"bujurx":"'.str_replace($char,'`',strip_tags("Bujur: ".$row['bujur'])).'",
			"lintang":"'.str_replace($char,'`',strip_tags($row['lintang'])).'",
			"bujur":"'.str_replace($char,'`',strip_tags($row['bujur'])).'"
		},';
	}

	$json = substr($json,0,strlen($json)-1);

	$json .= ']}';
	echo $json;
?>