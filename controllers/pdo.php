<?php 

class Database extends Base{
	
	protected $_db_host;
	protected $_db_username;
	protected $_db_password;
	protected $_db_name;
	public $config;
	public $_db;
	
	function __construct() {
		if ($this->config = parse_ini_file("config.ini")) {

			$this->_db_host = $this->config['host'];
			$this->_db_username = $this->config['username'];
			$this->_db_password = $this->config['password'];
			$this->_db_name = $this->config['name'];
				
			try {
				$this->_db = new PDO('mysql:host='.$this->_db_host.';dbname='.$this->_db_name, $this->_db_username, $this->_db_password);
				$this->_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
				
			} catch (PDOException $e) {
				$_GET['error'] = "Error: ".$e;
			}
		}
	}

	public function writeIni($array) {
	
		$myfile = fopen("controllers/config.ini", "w") or die("Unable to open file!");
	
		foreach ($array as $key => $value) {
			
			$txt = $value;
			fwrite($myfile, $txt);
			
		}
		
		fclose($myfile);
	}
	
	public function arrayBinder(&$pdo, &$array) {
		foreach ($array as $key => $value) {
			$pdo->bindValue(':'.$key,$value);
		}
	}
	
	
	public function arrayBinderInt(&$pdo, &$array) {
		foreach ($array as $key => $value) {
			$pdo->bindValue(':'.$key, (int) $value, PDO::PARAM_INT);
		}
	}
	
}
