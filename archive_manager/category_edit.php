<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<?php 

  $elements = [];
  $elements[] = ElementCompiler::createHidden(VN::action, Action::edit_category);
  $elements[] = ElementCompiler::createHidden(VN::category_id, $category_id);
  $elements[] = ElementCompiler::createLabel('ID: '.$category->getID());
  $elements[] = ElementCompiler::createBreak(2);
  $elements[] = ElementCompiler::createTextField
          ('Name:', VN::name, $category->getName(), true);
  $elements[] = ElementCompiler::createLabel('Ancestry: '.$parent_names, true);
  $elements[] = ElementCompiler::createBreak();
  $elements[] = ElementCompiler::createRadioButtonArray
          ('Parent:', VN::parent_id, $category_ids, $category_names, 
          $category->getParentID() ?? 0); // current parent.
  $elements[] = ElementCompiler::createBreak();
  $elements[] = ElementCompiler::createTextArea
          ('Description:', VN::description, $category->getDescription());
  $elements[] = ElementCompiler::createBreak(2);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Edit);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Cancel);
  $formHTML = FormCompiler::createForm($elements, FC::manager_entity_form);

  // Validation.
  $invalid_html = '';
  if ($input_invalid_name ?? false)
    $invalid_html .= '<h1 class="invalid_input">Please input a valid name.</h1>';
  
?>

<main>
  <h1>Archive Manager</h1>
  <?php
  if (!empty($invalid_html))
    echo $invalid_html;
  ?>

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