<?php 
// Copyright: Jeremy Anderson 2018

switch ($action) {
  case 'list_books' :
    $book_db = new BookDB();
    $books = $book_db->getBooks();

    include('books_list.php');
    break;
  case 'show_add_book_form' :
    break;
  case 'add_book' :
    break;
  case 'show_edit_book_form' :
    break;
  case 'edit_book' :
    break;
  case 'show_delete_book_form' :
    break;
  case 'delete_book' :
    break;
  default :
    $error = 'action: '.$action.' not found in controller_book.php';
    include('../errors/error.php');
    break;
}
?>