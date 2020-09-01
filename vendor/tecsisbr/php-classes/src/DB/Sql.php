<?php 

namespace Tecsis\DB;

class Sql {

	const HOSTNAME = "192.185.212.99"; // Endereço/Nome do Servidor localhost
	//const HOSTNAME = "127.0.0.1"; // Endereço/Nome do Servidor localhost
	const USERNAME = "tecisn93_user"; // Usuário HOSTGATOR
	//const USERNAME = "root"; // Usuário localhost
	const PASSWORD = "ramien20"; // Senha do usuário HOSTGATOR
	//const PASSWORD = ""; // Meu banco de dados criado na conexão localhost não possui senha
	const DBNAME = "tecisn93_db"; // Nome do Banco de Dados HOSTGATOR
	//const DBNAME = "db_ecommerce"; // Nome do Banco de Dados localhost

	private $conn;

	public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=".Sql::DBNAME.";host=".Sql::HOSTNAME, 
			Sql::USERNAME,
			Sql::PASSWORD
		);

	}

	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {
			
			$this->bindParam($statement, $key, $value);

		}

	}

	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);

	}

}

 ?>