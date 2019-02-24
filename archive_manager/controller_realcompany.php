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

$realcompany_db = new RealCompanyDB();
$realcompanies = $realcompany_db->getRealCompanies();

switch ($action) {
case 'list_realcompanies' :

    include 'realcompanies_list.php';
    break;
case 'view_realcompany' :
    $realcompany_id = filter_input(INPUT_GET, VN::realcompany_id, FILTER_VALIDATE_INT);
    $realcompany = $realcompany_db->getRealCompany($realcompany_id);

    $category_id = $realcompany_db->getParentCategoryID($realcompany_id);
    $category_heirarchy = getCategoryHeirarchy($category_id);
    $category_names = prepareCategoryHeirarchyNames($category_heirarchy);

    include 'realcompany_view.php';
    break;
case 'show_add_realcompany_form' :
    $category_db = new CategoryDB();
    $categories = $category_db->getCategories();
    $category_ids = getCategoryIDs($categories, null, true);
    $category_names = getCategoryNames($categories, null, true);
    
    include 'realcompany_add.php';
    break;
case Action::add_realcompany :
    $button = filter_input(INPUT_POST, VN::button);
    if ($button == BV::Cancel) {
        header('Location: .?action'.Action::list_realcompanies);
        break;
    } 

    $name = filter_input(INPUT_POST, VN::name, FILTER_DEFAULT);
    $description = filter_input(INPUT_POST, VN::description, FILTER_DEFAULT);

    $input_invalid_name = empty($name) ? true : false;
    if ($input_invalid_name) {
        $category_db = new CategoryDB();
        $categories = $category_db->getCategories();
        $category_ids = getCategoryIDs($categories, null, true);
        $category_names = getCategoryNames($categories, null, true);

        include 'realcompany_add.php';
    } else {
        $realcompany = new RealCompany($name, $description);
      
        // Create a function that adds an entry to the realcompany_categories table
        // for each selected category and follows its ancestry, adding an entry if one
        // isn't already present.

        $realcompany_db->addRealCompany($realcompany); // handles minutia
      
        header('Location: .?action'.Action::list_realcompanies);
    }
    break;
case 'show_edit_realcompany_form' :
    $button = filter_input(INPUT_POST, VN::button);
    if ($button == BV::Back) {
        header('Location: .?action='.Action::list_realcompanies);
        break;
    }
    $error = 'attempted to edit a real company.';
    include '../errors/error.php';
    break;
case 'edit_realcompany' :
    break;
case 'show_delete_realcompany_form' :
    $error = 'attempted to delete a real company.';
    include '../errors/error.php';
    break;
case 'delete_realcompany' :
    break;
default :
    $error = 'action: '.$action.' not found in controller_realcompany.php';
    include '../errors/error.php';
    break;
}

/**
 * Prepare an ancestry list of categories, beginning with $category_id's.
 * 
 * @param int $category_id ID of starting category.
 * 
 * @return array Category objects in heirarchical order.
 */
function getCategoryHeirarchy($category_id) 
{
    $category_db = new CategoryDB();
    $category = $category_db->getCategory($category_id);
    $category_heirarchy = $category_db->getAncestors($category->getID());
    array_push($category_heirarchy, $category);

    return $category_heirarchy;
}

/**
 * Prepare an ancestry list of names preceded by '<br>'-.
 * 
 * @param array $category_heirarchy Categories whose names must be extracted.
 * 
 * @return string Concatenated list of names formatted for multi-line display.
 */
function prepareCategoryHeirarchyNames($category_heirarchy) 
{
    $category_names = '';
    foreach ($category_heirarchy as $category)
        $category_names .= '<br>-'.$category->getName();
    
    return $category_names;
}

?>