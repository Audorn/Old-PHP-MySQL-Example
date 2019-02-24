<?php 
// Copyright: Jeremy Anderson 2018

switch ($action) {
  case 'list_quotes' :
    $quote_db = new QuoteDB();
    $quotes = $quote_db->getQuotes();

    include('quotes_list.php');
    break;
  case 'show_add_quote_form' :
    break;
  case 'add_quote' :
    break;
  case 'show_edit_quote_form' :
    break;
  case 'edit_quote' :
    break;
  case 'show_delete_quote_form' :
    break;
  case 'delete_quote' :
    break;
  default :
    $error = 'action: '.$action.' not found in controller_quote.php';
    include('../errors/error.php');
    break;
}
?>