<?php 
// Copyright: Jeremy Anderson 2018
require('../model/database.php');
require('../model/ModelUtilities.php');
require('../model/ControllerUtilities.php');
require('../model/ViewUtilities.php');

// Mandatory databases
require('../model/category_db.php');

// get the action.
$action = filter_input(INPUT_POST, 'action') ??
          filter_input(INPUT_GET, 'action') ??
          'list_categories';

// prepare page data and call appropriate page.
// action may be plural or singular, so suffix left off.
if (preg_match('/categor/', $action)) {
  include('controller_category.php');
} 
else if (preg_match('/compan/', $action)) {
  include('../model/realcompany_db.php');
  include('controller_realcompany.php');
}
else if (preg_match('/person/', $action)) {
  include('../model/realperson_db.php');
  include('controller_realperson.php');
}
else if (preg_match('/book/', $action)) {
  include('../model/book_db.php');
  include('controller_book.php');
}
else if (preg_match('/media/', $action)) {
  include('../model/media_db.php');
  include('controller_media.php');
}
else if (preg_match('/quote/', $action)) {
  include('../model/quote_db.php');
  include('controller_quote.php');
}
else if (preg_match('/image/', $action)) {
  include('../model/image_db.php');
  include('controller_image.php');
}

function getCategoryIDs($categories, $exclude_id = NULL, $insertEmpty = false) 
{
  $category_ids = [];
  if ($insertEmpty)
    $category_ids[] = NULL;
  foreach ($categories as $category) {
    if (!is_null($exclude_id) && $category->getID() == $exclude_id)
      continue;
    $category_ids[] = $category->getID();
  }
  return $category_ids;
}
function getCategoryNames($categories, $exclude_name = NULL, $insertEmpty = false)
{
  $category_names = [];
  if ($insertEmpty)
    $category_names[] = 'None';
  foreach ($categories as $category) {
    if (!is_null($exclude_name) && $category->getName() == $exclude_name) {
      continue;
    }
    $category_names[] = $category->getName();
  }
  return $category_names;  
}

?>