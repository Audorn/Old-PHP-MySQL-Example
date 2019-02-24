<?php
// Copyright: Jeremy Anderson 2018
class RealCompanyDB {
  public function getRealCompanies() 
  {
    $db = Database::getDB();
    $query = "SELECT *
              FROM realcompanies";
    $results = $db->query($query);
    $realcompanies = array();
    foreach ($results as $row) {
      $realcompany = new RealCompany($row['name'], $row['description'], $row['ID']);
      $realcompanies[] = $realcompany;
    }
    return $realcompanies;
  }

  public function getRealCompany($realcompany_id) 
  {
    $db = Database::getDB();
    $query = "SELECT *
              FROM realcompanies
              WHERE ID = '$realcompany_id'";
    $statement = $db->query($query);
    $row = $statement->fetch();
    $realcompany = new RealCompany($row['name'], $row['description'], $row['ID']);
    
    return $realcompany;
  }

  public function getParentCategoryID($realcompany_id) 
  {
    $db = Database::getDB();
    $query = "SELECT *
              FROM realcompanies_categories
              WHERE realCompanyID = '$realcompany_id'";
    $statement = $db->query($query);
    $row = $statement->fetch();
    $category_id = $row['categoryID'];

    return $category_id;
  }

  public function addRealCompany($realcompany) 
  {
    $db = Database::getDB();
    
    $name = $realcompany->getName();
    $description = $realcompany->getDescription();
    
    $query = "INSERT INTO realcompanies
                (name, description)
              VALUES
                ('$name', '$description')";
    $db->exec($query);
  }

}

class RealCompany {
  private $id, $name, $description;
  
  public function __construct
    ($name = '', $description = '', $id = 0) 
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
  }
  
  public function getID() { return $this->id; }
  public function getName() { return $this->name; }
  public function getDescription() { return $this->description; }
}
?>