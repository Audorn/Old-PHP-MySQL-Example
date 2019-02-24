<?php 
// Copyright: Jeremy Anderson 2018

switch ($action) {
  case 'list_realpersons' :
    $realperson_db = new RealPersonDB();
    $realpersons = $realperson_db->getRealPersons();

    include('realpersons_list.php');
    break;
  case 'show_add_realperson_form' :
    break;
  case 'add_realperson' :
    break;
  case 'show_edit_realperson_form' :
    break;
  case 'edit_realperson' :
    break;
  case 'show_delete_realperson_form' :
    break;
  case 'delete_realperson' :
    break;
  default :
    $error = 'action: '.$action.' not found in controller_realperson.php';
    include('../errors/error.php');
    break;
}
?>