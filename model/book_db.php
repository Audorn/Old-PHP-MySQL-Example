<?php
// Copyright: Jeremy Anderson 2018
class BookDB {
  public function getBooks() {
    $db = Database::getDB();
    $query = "SELECT *
              FROM books";
    $results = $db->query($query);
    $books = array();
    foreach ($results as $row) {
      $book = new Book($row['ID'], $row['title'], $row['year'], $row['version']);
      $books[] = $book;
    }
    return $books;
  }
  
}

class Book {
  private $id, $cover_image_id, $back_image_id,
          $title, $description,
          $version, $year, $pages;
  
  public function __construct($id = 0, $title = '', $year = '', $version = '') 
  {
    $this->id = $id;
    $this->title = $title;
    $this->year = $year;
    $this->version = $version;
    $this->cover_image_id = '';
    $this->back_image_id = '';
    $this->description = '';
    $this->pages = '';
  }
  
  public function getID() { return $this->id; }
  public function getCoverImageID() { return $this->cover_image_id; }
  public function getBackImageID() { return $this->back_image_id; }
  public function getTitle() { return $this->title; }
  public function getDescription() { return $this->description; }
  public function getVersion() { return $this->version; }
  public function getYear() { return $this->year; }
  public function getPages() { return $this->pages; }
}
?>