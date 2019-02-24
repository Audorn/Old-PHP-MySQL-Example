<?php
// Copyright: Jeremy Anderson 2018
class RealPersonDB {
  public function getRealPersons() {
    $db = Database::getDB();
    $query = "SELECT *
              FROM realpersons";
    $results = $db->query($query);
    $realpersons = array();
    foreach ($results as $row) {
      $realperson = new RealPerson($row['ID'], $row['name']);
      $realpersons[] = $realperson;
    }
    return $realpersons;
  }
  
}

class RealPerson {
  private $id,
          $name;
  
  public function __construct($id = 0, 
                              $name = '') {
    $this->id = $id;
    $this->name = $name;
  }
  
  public function getID() { return $this->id; }
  public function getName() { return $this->name; }
}
?>