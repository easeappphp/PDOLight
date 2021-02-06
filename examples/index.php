<?php 

require '../vendor/autoload.php';

use EaseAppPHP\PDOLight\PDOLight;

$dbHost = "127.0.0.1";
$dbUsername = "db_username";
$dbPassword = "db_password";
$dbName = "db_name";
$charset = "utf8mb4";
$port = "3306";
$pdoAttrDefaultFetchMode = \PDO::FETCH_ASSOC; //\PDO::FETCH_ASSOC or \PDO::FETCH_OBJ

$pdoConn = new PDOLight($dbHost, $dbUsername, $dbPassword, $dbName, $charset, $port, $pdoAttrDefaultFetchMode);

//Insert Query (insertWithIntegerAsPrimaryKey)
$query = "INSERT INTO `table_name`(`firstname`, `lastname`) VALUES (:firstname,:lastname)";

$values_array = array();
$values_array = array(':firstname' => 'Raghu',':lastname' => 'Dendukuri');


//$preparedQuery = $pdoConn->prepareQuery($query);
//$queryResult = $pdoConn->runPreparedQuery($preparedQuery, $values_array, "insertWithIntegerAsPrimaryKey");

//$queryResult = $pdoConn->executeQuery($query, $values_array, "insertWithIntegerAsPrimaryKey");

echo "===============================================================================================================================================";

//Update Query
$query = "UPDATE `table_name` SET `name`=:name WHERE `id`=:id";

$values_array = array();
$values_array = array(':name' => 'Raghuveer',':id' => 20);

//$preparedQuery = $pdoConn->prepareQuery($query);
//$queryResult = $pdoConn->runPreparedQuery($preparedQuery, $values_array, "update");

//$queryResult = $pdoConn->executeQuery($query, $values_array, "update");

echo "===============================================================================================================================================";

//Select Query
$query = "SELECT * FROM `table_name` WHERE `id`=:id";

$values_array = array();
$values_array = array(':id' => 100);

//$preparedQuery = $pdoConn->prepareQuery($query);
//$queryResult = $pdoConn->runPreparedQuery($preparedQuery, $values_array, "selectSingle");

//$queryResult = $pdoConn->executeQuery($query, $values_array, "selectSingle");

echo "===============================================================================================================================================";

//Select All Query
$query = "SELECT * FROM `table_name`";

$values_array = array();

//$preparedQuery = $pdoConn->prepareQuery($query);
//$queryResult = $pdoConn->runPreparedQuery($preparedQuery, $values_array, "selectMultiple");

//$queryResult = $pdoConn->executeQuery($query, $values_array, "selectMultiple");

echo "===============================================================================================================================================";

//Delete Query
$query = "DELETE FROM `table_name` WHERE `id`=:id";

$values_array = array();
$values_array = array(':id' => 18);

//$preparedQuery = $pdoConn->prepareQuery($query);
//$queryResult = $pdoConn->runPreparedQuery($preparedQuery, $values_array, "delete");

//$queryResult = $pdoConn->executeQuery($query, $values_array, "delete");

echo "===============================================================================================================================================";


echo "<pre>";
print_r($queryResult);


?>