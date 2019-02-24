<?php
// Copyright: Jeremy Anderson 2018
class ImageDB {
  public function getImages() {
    $db = Database::getDB();
    $query = "SELECT *
              FROM images";
    $results = $db->query($query);
    $images = array();
    foreach ($results as $row) {
      $image = new Image($row['ID'], $row['filename'], $row['description']);
      $images[] = $image;
    }
    return $images;
  }
  
}

class Image {
  private $id,
          $filename,
          $description;
  
  public function __construct($id = 0, $filename = '', $description = '') 
  {
    $this->id = $id;
    $this->filename = $filename;
    $this->description = $description;
  }
  
  public function getID() { return $this->id; }
  public function getFilename() { return $this->filename; }
  public function getDescription() { return $this->description; }
}
?>