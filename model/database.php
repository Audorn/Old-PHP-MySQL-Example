<?php
// Copyright: Jeremy Anderson 2018
class Database {
  private static $dsn = 'mysql:host=localhost;dbname=battletech';
	private static $username = 'jr_admin';
	private static $password = 'pa55word';
  private static $db;
  
  private function __construct() {}
  
  public static function getDB() {
    if (!isset(self::$db)) {
      try {
        self::$db = new PDO(self::$dsn, self::$username, self::$password);
      } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
      }
    }
    return self::$db;
  }
}
?>