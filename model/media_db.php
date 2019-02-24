<?php
// Copyright: Jeremy Anderson 2018
class MediaDB {
  public function getMedia() {
    $db = Database::getDB();
    $query = "SELECT *
              FROM media";
    $results = $db->query($query);
    $media = array();
    foreach ($results as $row) {
      $med = new Media($row['ID'], $row['title'], $row['year'], $row['source'], $row['description']);
      $media[] = $med;
    }
    return $media;
  }

}

class Media {
  private $id, $title, $year, $source, $description;
  
  public function __construct($id = 0, 
                              $title = '', 
                              $year = '',
                              $source = '',
                              $description = '') {
    $this->id = $id;
    $this->title = $title;
    $this->year = $year;
    $this->source = $source;
    $this->description = $description;
  }
  
  public function getID() { return $this->id; }
  public function getTitle() { return $this->title; }
  public function getYear() { return $this->year; }
  public function getSource() { return $this->source; }
  public function getDescription() { return $this->description; }
}
?>