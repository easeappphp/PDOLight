# PDOLight
> A very simple and safe PHP library to execute PDO based database queries. Methods are provided to prepare a SQL Statement &amp; it's execution separately as different methods (to facilitate caching of prepared statements) as well as together in a single method too.

### Why PDOLight?
Doing SQL Queries on MySQL/MariaDB in a simple and secure way, preventing SQL Injection is always an important thing. This library is kept simple so, queries can be written and values are provided as an associative array when making DB queries.

### Advantages
- Uses prepared statements
- MySQL/MariaDB Connection object supported at present
- Named parameters supported basically instead of question mark `"?"` placeholders
- While sanitizing inputs is always a good practice, values that are provided as input to `runPreparedQuery` or `executeQuery` methods serve the purpose by securely executing respective DB queries
- Have required checks to find database connection errors and to reconnect to the database when preparing db queries

### Getting started
With Composer, run

```sh
composer require easeappphp/pdolight:^1.0.7
```

Note that the `vendor` folder and the `vendor/autoload.php` script are generated by Composer; they are not part of PDOLight.

To include the library,

```php
<?php
require 'vendor/autoload.php';

use \EaseAppPHP\PDOLight\PDOLight;
```

In order to connect to the database, you need to initialize the `PDOLight` class, by passing your database credentials as parameters, in the following order (server hostname, username, password, database name, charset, port number, pdo default fetch mode):

```php
$dbHost = "localhost";
$dbUsername = "database_username";
$dbPassword = "database_password_value";
$dbName = "database_name";
$charset = "utf8mb4";
$port = "3306";
$pdoAttrDefaultFetchMode = \PDO::FETCH_ASSOC; //\PDO::FETCH_ASSOC or \PDO::FETCH_OBJ

$pdoConn = new PDOLight($dbHost, $dbUsername, $dbPassword, $dbName, $charset, $port, $pdoAttrDefaultFetchMode);
```

To execute a SQL query, while preparing and executing the statement in a single method, `executeQuery` method has to be called with SQL Query and corresponding values as associative array and the CRUD Operation Type as third parameter.

Note: Values of CRUD Operation Type include: insert | update | delete | selectSingle | selectMultiple

```php
$query = "SELECT * FROM `table_name`";
$values_array = array();

$queryResult = $pdoConn->executeQuery($query, $values_array, "selectMultiple");
	
```

To execute a SQL query, while preparing and executing the statement in two different methods, `prepareQuery` and `runPreparedQuery` methods has to be called one after another with SQL Query prepared using `prepareQuery` method and prepared statement along with corresponding values (as associative array) and the CRUD Operation Type input as third parameter has to be provided to `runPreparedQuery` to execute the query.

Note: Values of CRUD Operation Type include: insert | update | delete | selectSingle | selectMultiple

```php
$query = "SELECT * FROM `table_name`";
$values_array = array();

$preparedQuery = $pdoConn->prepareQuery($query);
	
$queryResult = $pdoConn->runPreparedQuery($preparedQuery, $values_array, "selectMultiple");
	
```

## License
This software is distributed under the [MIT](https://opensource.org/licenses/MIT) license. Please read [LICENSE](https://github.com/easeappphp/PDOLight/blob/main/LICENSE) for information on the software availability and distribution.
