<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<?php 

  $elements = [];
  $elements[] = ElementCompiler::createHidden(VN::action, Action::show_edit_category_form);
  $elements[] = ElementCompiler::createHidden(VN::category_id, $category_id);
  $elements[] = ElementCompiler::createLabel('ID: '.$category->getID());
  $elements[] = ElementCompiler::createBreak(2);
  $elements[] = ElementCompiler::createLabel('Ancestry: '.$parent_names, true);
  $elements[] = ElementCompiler::createBreak();
  $elements[] = ElementCompiler::createTextArea
          ('Description:', VN::description, $category->getDescription(), true);
  $elements[] = ElementCompiler::createBreak(2);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Edit);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Back);
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