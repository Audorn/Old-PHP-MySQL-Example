<?php
// Copyright: Jeremy Anderson 2018
class CategoryDB {
  public function getCategories() 
  {
    $db = Database::getDB();
    $query = "";
    $query = "SELECT *
              FROM categories
              ORDER BY categories.name ASC";
    $results = $db->query($query);
    $categories = array();
    foreach ($results as $row) {
      $category = new Category($row['name'], $row['parentID'], $row['description'], $row['ID']);
      $categories[] = $category;
    }
    return $categories;
  }
  
  public function getCategory($category_id) 
  {
    $db = Database::getDB();
    $query = "SELECT *
              FROM categories
              WHERE ID = '$category_id'";
    $statement = $db->query($query);
    $row = $statement->fetch();
    $category = new Category($row['name'], $row['parentID'], $row['description'], $row['ID']);
    
    return $category;
  }
  
  public function getAncestors($category_id) 
  {
    $category = $this->getCategory($category_id); // Get the subject.

    $ancestors = [];
    $category_id = $category->getParentID(); // Get first parentID.
    while ($category_id > 0) {
      $category = $this->getCategory($category_id); // Get the parent.
      $category_id = $category->getParentID(); // Get the next parent's ID.
      $ancestors[] = $category; // Store the parent.
    }

    return array_reverse($ancestors);
  }
  public function getChildren($category_id) 
  {
    $db = Database::getDB();
    $query = "SELECT *
              FROM categories
              WHERE parentID = '$category_id'
              ORDER BY categories.name ASC";
    $results = $db->query($query);
    $categories = array();
    foreach ($results as $row) {
      $category = new Category($row['name'], $row['parentID'], $row['description'], $row['ID']);
      $categories[] = $category;
    }
    return $categories;
  }

  public function addCategory($category) 
  {
    $db = Database::getDB();
    
    $name = $category->getName();
    $parent_id = $category->getParentID();
    $description = $category->getDescription();
    
    $query = "INSERT INTO categories
                (name, parentID, description)
              VALUES
                ('$name', '$parent_id', '$description')";
    $db->exec($query);
    //$id = $db->lastInsertID();
  }

  public function deleteCategory($category_id, $children) 
  {
    $db = Database::getDB();

    $query = "DELETE FROM categories
              WHERE ID = '$category_id'";
    $db->exec($query);

    // Enforce Referential Integrity
    foreach ($children as $child)
      $this->changeCategoryParentID($child->getID(), $child->getParentID());

    // THE REST OF THE ENFORCEMENT
  }

  public function editCategory($category) 
  {
    $db = Database::getDB();

    $name = $category->getName();
    $parent_id = $category->getParentID();
    $description = $category->getDescription();
    $id = $category->getID();

    $query = "UPDATE categories
              SET name = '$name',
                  parentID = '$parent_id',
                  description = '$description'
              WHERE ID = '$id'";
    $db->exec($query);
  }

  // Internals.
  private function changeCategoryParentID($category_id, $parent_id) 
  {
    $db = Database::getDB();

    $query = "UPDATE categories
              SET parentID = '$parent_id'
              WHERE ID = '$category_id'";
    $db->exec($query);
  }
}

class Category {
  private $id, $name, $description;
  private $parent_id;
  
  public function __construct
    ($name = '', $parent_id = 0, $description = '', $id = 0) 
  {
    $this->id = $id;
    $this->name = $name;
    $this->description = $description;
    $this->parent_id = $parent_id;
  }
  
  public function getID() { return $this->id; }
  public function getName() { return $this->name; }
  public function getDescription() { return $this->description; }
  public function getParentID() { return $this->parent_id; }
}
?>