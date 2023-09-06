<?php

declare(strict_types=1);

namespace EaseAppPHP\PDOLight;

use \EaseAppPHP\PDOLight\Exceptions\PDOLightException;

/*
* Name: PDOLight
*
* Author: Raghuveer Dendukuri
*
* Version: 1.0.8
*
* Description: A very simple and safe PHP library to execute PDO based database queries. Methods are provided to prepare a SQL Statement & it's execution    
* separately as different methods (to facilitate caching of prepared statements) as well as together in a single method too.
*
* License: MIT
*
* @copyright 2020-2023 Raghuveer Dendukuri
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
		
		try {
			
			if (($pdoAttrDefaultFetchMode == \PDO::FETCH_ASSOC) || ($pdoAttrDefaultFetchMode == \PDO::FETCH_OBJ)) {
			
				$this->pdoAttrDefaultFetchMode = $pdoAttrDefaultFetchMode;
				
			} else {
				
				throw new PDOLightException('Invalid PDO Attribute Default Fetch Mode input.');
				
			}
			
			$this->connectDb();
			
		} catch (PDOLightException $e) {
			
			echo "\n PDOLightException - ", $e->getMessage(), (int)$e->getCode();
			
		}
		
    }
	
	public function connectDb() {
		
		//Data Source Name (for MySQL/MariaDB)
		$dsn = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=$this->charset;port=$this->port";
		
		$options = [
			\PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_EMULATE_PREPARES   => false,
			\PDO::ATTR_DEFAULT_FETCH_MODE => $this->pdoAttrDefaultFetchMode,
		];
		
		try {
			
			$this->connection = new \PDO($dsn, $this->dbUsername, $this->dbPassword, $options);
			
		} catch (PDOLightException $e) {
			
			echo "\n PDOLightException - ", $e->getMessage(), (int)$e->getCode();
			
		}
	}

	public function prepareQuery($query) {
		try {
			
			$stmt = $this->connection->prepare($query);
			
	    } catch (PDOLightException $e) {
			
			$this->connectDb();
			$stmt = $this->connection->prepare($query);
			
	    }
		
		return $stmt;
	}
	
	public function runPreparedQuery($preparedStmt, array $valuesArray, $crudOperationType) {
		
		try {
			
			if ($crudOperationType == "insertWithIntegerAsPrimaryKey") {
			
				if($preparedStmt->execute($valuesArray)) {
					
					return (int) $this->connection->lastInsertId();
					
				} else {
					
					return "";
					
				}
				
			} else if ($crudOperationType == "insertWithUUIDAsPrimaryKey") {
				
				if($preparedStmt->execute($valuesArray)) {
					
					return (string) $this->connection->lastInsertId();
					
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
				
				throw new PDOLightException('Invalid CRUD Operation Type input.');
				
			}
			
	    } catch (PDOLightException $e) {
			
			echo "\n PDOLightException - ", $e->getMessage(), (int)$e->getCode();
			
	    }
		
	}
	
	public function executeQuery($query, array $valuesArray, $crudOperationType) {
		
		try {
			
			$preparedStmt = $this->prepareQuery($query);
			
			if ($crudOperationType == "insertWithIntegerAsPrimaryKey") {
			
				if($preparedStmt->execute($valuesArray)) {
					
					return (int) $this->connection->lastInsertId();
					
				} else {
					
					return "";
					
				}
				
			} else if ($crudOperationType == "insertWithUUIDAsPrimaryKey") {
				
				if($preparedStmt->execute($valuesArray)) {
					
					return (string) $this->connection->lastInsertId();
					
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
				
				throw new PDOLightException('Invalid CRUD Operation Type input.');
				
			}
			
	    } catch (PDOLightException $e) {
			
			echo "\n PDOLightException - ", $e->getMessage(), (int)$e->getCode();
			
	    }
		
	}
	
}
?>