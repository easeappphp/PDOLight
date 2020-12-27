<?php

/*
* Name: PDOLight
*
* Author: Raghuveer Dendukuri
*
* Version: 0.0.1
*
* Description: A very simple and safe PHP library to execute PDO based database queries. Methods are provided to prepare a SQL Statement & it's execution    
* separately as different methods (to facilitate caching of prepared statements) as well as together in a single method too.
*
* License: MIT
*
* @copyright 2020 Raghuveer Dendukuri
*/
class PDOLight {
	private $dbHost;
	private $dbUsername;
	private $dbPassword;
	private $dbName;
	private $charset;
	private $port;
	private $dbConnection;
	private $pdoAttrDefaultFetchMode;

	public function __construct($dbHost, $dbUsername, $dbPassword, $dbName, $charset, $port, $pdoAttrDefaultFetchMode) {
		// Assign the parameters values to the object properties
		$this->dbHost = $dbHost;
		$this->dbUsername = $dbUsername;
		$this->dbPassword = $dbPassword;
		$this->dbName = $dbName;
		$this->charset = $charset;
		$this->port = $port;
		
		if (($pdoAttrDefaultFetchMode == \PDO::FETCH_ASSOC) || ($pdoAttrDefaultFetchMode == \PDO::FETCH_OBJ)) {
			
			$this->pdoAttrDefaultFetchMode = $pdoAttrDefaultFetchMode;
			
		} else {
			
			throw new Exception('Invalid PDO Attribute Default Fetch Mode input.');
			
		}
		
		//Data Source Name (for MySQL/MariaDB)
		$dsn = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=$this->charset;port=$this->port";
		
		$options = [
			\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_EMULATE_PREPARES   => false,
			\PDO::ATTR_DEFAULT_FETCH_MODE => $this->pdoAttrDefaultFetchMode,
		];
		
		try {
			$this->connection = new PDO($dsn, $this->dbUsername, $this->dbPassword, $options);
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	}

	public function prepareQuery($query) {
		$stmt = $this->connection->prepare($query);
		return $stmt;
	}
	
	public function runPreparedQuery($preparedStmt, array $valuesArray, $crudOperationType) {
		
		if ($crudOperationType == "insert") {
			
			if($preparedStmt->execute($valuesArray)) {
				
				return $this->connection->lastInsertId();
				
			} else {
				
				return "";
				
			}
			
		} else if ($crudOperationType == "update") {
			
			if($preparedStmt->execute($valuesArray)) {
			    
				return true;
				
			} else {
				
				return false;
				
			}
			
			
		} else if ($crudOperationType == "delete") {
			
			if($preparedStmt->execute($valuesArray)) {
			   
			    return true;
			   
			} else {
				
				return false;
				
			}
			
		} else if ($crudOperationType == "selectSingle") {
			
			$preparedStmt->execute($valuesArray);
			
			if($preparedStmt->rowCount() > 0) {
				
				return $preparedStmt->fetch();

			} else {
				
				return [];
				
			}
			
		} else if ($crudOperationType == "selectMultiple") {
			
			$preparedStmt->execute($valuesArray);
			
			if($preparedStmt->rowCount() > 0) {
				
				return $preparedStmt->fetchAll();
				
			} else {
				
				return [];
				
			}
			
		} else {
			
			throw new Exception('Invalid CRUD Operation Type input.');
			
		}
		
	}
	
	public function executeQuery($query, array $valuesArray, $crudOperationType) {	
		
		$preparedStmt = $this->connection->prepare($query);
		
		if ($crudOperationType == "insert") {
			
			if($preparedStmt->execute($valuesArray)) {
				
				return $this->connection->lastInsertId();
				
			} else {
				
				return "";
				
			}
			
		} else if ($crudOperationType == "update") {
			
			if($preparedStmt->execute($valuesArray)) {
			    
				return true;
				
			} else {
				
				return false;
				
			}
			
			
		} else if ($crudOperationType == "delete") {
			
			if($preparedStmt->execute($valuesArray)) {
			   
			    return true;
			   
			} else {
				
				return false;
				
			}
			
		} else if ($crudOperationType == "selectSingle") {
			
			$preparedStmt->execute($valuesArray);
			
			if($preparedStmt->rowCount() > 0) {
				
				return $preparedStmt->fetch();

			} else {
				
				return [];
				
			}
			
		} else if ($crudOperationType == "selectMultiple") {
			
			$preparedStmt->execute($valuesArray);
			
			if($preparedStmt->rowCount() > 0) {
				
				return $preparedStmt->fetchAll();
				
			} else {
				
				return [];
				
			}
			
		} else {
			
			throw new Exception('Invalid CRUD Operation Type input.');
			
		}
		
	}
	
}
?>