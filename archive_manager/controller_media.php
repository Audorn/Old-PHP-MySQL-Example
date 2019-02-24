<?php 
// Copyright: Jeremy Anderson 2018

switch ($action) {
  case 'list_media' :
    $media_db = new MediaDB();
    $media = array(new Media(0, 'TestTitle', 'TestYear', 'TestSource', 'TestDescription'));
    //$media = $media_db->getMedia();

    include('media_list.php');
    break;
  case 'show_add_media_form' :
    break;
  case 'add_media' :
    break;
  case 'show_edit_media_form' :
    break;
  case 'edit_media' :
    break;
  case 'show_delete_media_form' :
    break;
  case 'delete_media' :
    break;
  default :
    $error = 'action: '.$action.' not found in controller_media.php';
    include('../errors/error.php');
    break;
}
?>