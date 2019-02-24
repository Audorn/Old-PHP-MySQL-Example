<?php 
// Copyright: Jeremy Anderson 2018

switch ($action) {
  case 'list_images' :
    $image_db = new ImageDB();
    $images = $image_db->getImages();

    include('images_list.php');
    break;
  case 'show_add_image_form' :
    break;
  case 'add_image' :
    break;
  case 'show_edit_image_form' :
    break;
  case 'edit_image' :
    break;
  case 'show_delete_image_form' :
    break;
  case 'delete_image' :
    break;
  default :
    $error = 'action: '.$action.' not found in controller_image.php';
    include('../errors/error.php');
    break;
}
?>