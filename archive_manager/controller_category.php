<?php 
/** 
 * Short description.
 * PHP Version 7.2
 * 
 * @category Controller_Path
 * @package  Controller_Package
 * @author   J R Anderson <tjer101105@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.localhost/bta
 */

$category_db = new CategoryDB();
$categories = $category_db->getCategories();

switch ($action) {
case Action::list_categories :
    
    include 'categories_list.php';
    break;
case Action::view_category :
    $category_id = filter_input(INPUT_GET, VN::category_id, FILTER_VALIDATE_INT);
    $category = $category_db->getCategory($category_id);
    $ancestors = $category_db->getAncestors($category_id);
    $parent_names = prepareParentNames($ancestors);
  
    include 'category_view.php';
    break;
case Action::show_add_category_form :
    $category_ids = getCategoryIDs($categories, null, true);
    $category_names = getCategoryNames($categories, null, true);
    
    include 'category_add.php';
    break;
case Action::add_category :
    $button = filter_input(INPUT_POST, VN::button);
    if ($button == BV::Cancel) {
        header('Location: .?action='.Action::list_categories);
        break;
    } 

    $name = filter_input(INPUT_POST, VN::name, FILTER_DEFAULT);
    $parent_id = filter_input(INPUT_POST, VN::parent_id, FILTER_DEFAULT);
    $description = filter_input(INPUT_POST, VN::description, FILTER_DEFAULT);

    $input_invalid_name = empty($name) ? true : false;
    if ($input_invalid_name) {
        $category_ids = getCategoryIDs($categories, null, true);
        $category_names = getCategoryNames($categories, null, true);

        include 'category_add.php';
    } else {
        $category = new Category($name, $parent_id, $description);
      
        $category_db->addCategory($category);
      
        header('Location: .?action'.Action::list_categories);
    }
    break;
case Action::show_edit_category_form :
    $button = filter_input(INPUT_POST, VN::button);
    if ($button == BV::Back) {
        header('Location: .?action='.Action::list_categories);
        break;
    }

    $category_id = filter_input(INPUT_POST, VN::category_id, FILTER_VALIDATE_INT);
    $category = $category_db->getCategory($category_id);

    $ancestors = $category_db->getAncestors($category_id);
    $parent_names = prepareParentNames($ancestors);
  
    $category_ids = getCategoryIDs($categories, $category->getID(), true);
    $category_names = getCategoryNames($categories, $category->getName(), true);

    include 'category_edit.php';
    break;
case Action::edit_category :
    $button = filter_input(INPUT_POST, VN::button);
    if ($button == BV::Cancel) {
        header('Location: .?action='.Action::list_categories);
        break;
    }

    $category_id = filter_input(INPUT_POST, VN::category_id, FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, VN::name, FILTER_DEFAULT);
    $parent_id = filter_input(INPUT_POST, VN::parent_id, FILTER_DEFAULT);
    $description = filter_input(INPUT_POST, VN::description, FILTER_DEFAULT);

    $input_invalid_name = empty($name) ? true : false;
    if ($input_invalid_name) {
        $category = $category_db->getCategory($category_id);
        $name = $category->getName(); // reset name field.

        $ancestors = $category_db->getAncestors($category_id);
        $parent_names = prepareParentNames($ancestors);

        $category_ids = getCategoryIDs($categories, $category->getID(), true);
        $category_names = getCategoryNames($categories, $category->getName(), true);

        include 'category_edit.php';
    } else {
        $category = new Category($name, $parent_id, $description, $category_id);

        $category_db->editCategory($category);
      
        header('Location: .?action'.Action::list_categories);
    }
    break;
case Action::show_delete_category_form :
    $category_id = filter_input(INPUT_POST, VN::category_id, FILTER_VALIDATE_INT);
    $category = $category_db->getCategory($category_id);

    $ancestors = $category_db->getAncestors($category_id);
    $parent_names = prepareParentNames($ancestors);
  
    $parent = $ancestors[count($ancestors) - 1] ?? null;
    $children = $category_db->getChildren($category_id);
    $child_ids = getChildIDs($children);
    $child_names = getChildNames($children);

    include 'category_delete.php';
    break;
case Action::delete_category :
    $button = filter_input(INPUT_POST, VN::button);
    if ($button == BV::Cancel) {
        header('Location: .?action='.Action::list_categories);
        break;
    } 

    $category_id = filter_input(INPUT_POST, VN::category_id);

    // Prepare to Enforce Referential Integrity
    $category_ids = filter_input(INPUT_POST, VN::child_ids); // child categories.
    $children = prepareSerializedChildrenForUpdating($category_ids);

    // THE REST OF THE ENFORCEMENT

    // Call delete category function (it will handle the minutia).
    $category_db->deleteCategory($category_id, $children);

    header('Location: .?action='.Action::list_categories);
    break;
default :
    $error = 'action: '.$action.' not found in controller_category.php';
    include '../errors/error.php';
    break;
}

/**
 * THIS METHOD IS REDUNDANT!!!! MOVE TO INDEX.PHP
 * Prepare an ancestry list of names preceded by '<br>'-.
 * 
 * @param array $ancestors Categories whose names must be extracted.
 * 
 * @return string Concatenated list of names formatted for multi-line display.
 */
function prepareParentNames($ancestors) 
{
    $parent_names = '';
    foreach ($ancestors as $ancestor)
      $parent_names .= '<br>-'.$ancestor->getName();
  
    return $parent_names;
}

/**
 * Prepare a list of child_ids.
 * 
 * @param array $children Categories whose IDs must be extracted.
 * 
 * @return array IDs of the categories.
 */
function getChildIDs($children) 
{
    $child_ids = [];
    foreach ($children as $child)
      $child_ids[] = $child->getID();

    return $child_ids;
}

/**
 * Prepare a list of child_names.
 * 
 * @param array $children Categories whose Names must be extracted.
 * 
 * @return array Names of the categories.
 */
function getChildNames($children) 
{
    $child_names = [];
    foreach ($children as $child)
      $child_names[] = $child->getName();

    return $child_names;
}

/**
 * Unserializes and prepares a list of categories.
 * 
 * @param array $category_ids serialized array of categories.
 * 
 * @return array Unserialized and prepared for updating categories.
 */
function prepareSerializedChildrenForUpdating($category_ids) 
{
    $category_ids = unserialize($category_ids);
    $children = [];
    foreach ($category_ids as $category_id) {
        // '_' allows for category_id #'s to be used as variable names.
        $parent_id = filter_input(INPUT_POST, "_$category_id", FILTER_VALIDATE_INT);

        $children[] = new Category('', $parent_id, '', $category_id);
    }

    return $children;
}
?>