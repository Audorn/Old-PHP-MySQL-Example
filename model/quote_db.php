<?php
// Copyright: Jeremy Anderson 2018
class QuoteDB {
  public function getQuotes() {
    $db = Database::getDB();
    $query = "SELECT *
              FROM quotes";
    $results = $db->query($query);
    $quotes = array();
    foreach ($results as $row) {
      $quote = new Quote($row['ID'], $row['quote'], $row['reasoning']);
      $quotes[] = $quote;
    }
    return $quotes;
  }
  
}

class Quote {
  private $id, $quote, $reasoning;
  
  public function __construct($id = 0, $quote = '', $reasoning = '') 
  {
    $this->id = $id;
    $this->quote = $quote;
    $this->reasoning = $reasoning;
  }
  
  public function getID() { return $this->id; }
  public function getQuote() { return $this->quote; }
  public function getReasoning() { return $this->reasoning; }
}
?>