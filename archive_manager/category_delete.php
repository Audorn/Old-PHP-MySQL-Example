<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<?php 

  $elements = [];
  $elements[] = ElementCompiler::createHidden(VN::action, Action::delete_category);
  $elements[] = ElementCompiler::createHidden(VN::category_id, $category_id);
  $elements[] = ElementCompiler::createHidden
          (VN::child_ids, htmlspecialchars(serialize($child_ids)));
  $elements[] = ElementCompiler::createLabel('ID: '.$category->getID());
  $elements[] = ElementCompiler::createBreak(2);
  $elements[] = ElementCompiler::createLabel('Ancestry: '.$parent_names, true);
  $elements[] = ElementCompiler::createBreak();
  $elements[] = ElementCompiler::createMultiRadioButtonArray
          ('Child Links: ', $child_names, $child_ids,
            [0,       !is_null($parent) ? $parent->getID()    : 0],
            ['None',  !is_null($parent) ? $parent->getName()  : 'None']);
  $elements[] = ElementCompiler::createTextArea
          ('Description:', VN::description, $category->getDescription(), true);
  $elements[] = ElementCompiler::createBreak(2);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Delete);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Cancel);
  $formHTML = FormCompiler::createForm($elements, FC::manager_entity_form);
?>

<main>
  <h1>Archive Manager</h1>
  
  <aside>
    <h2>Navigation</h2>
    <?php include('../view/manager_navigation.php'); ?>
  </aside>
  
  <section>
    <h2><?php echo $category->getName(); ?></h2>
    <?php 
    echo $formHTML;
    ?>
  </section>
</main>

<?php include('../view/footer.php'); ?>