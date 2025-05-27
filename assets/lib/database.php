
<?php
class database {
	public $dbh;
	public function connect($config) {
			$pdo = "mysql:host=%s;dbname=%s";
			try {
					$this->dbh=new PDO(
					sprintf($pdo,$config["mysql"]["host"], $config["mysql"]["name"]),
					$config["mysql"]["username"],
					$config["mysql"]["password"]);
					$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		}
			catch(PDOException $e){
				die($e->getMessage());
		}

	}

}

?>