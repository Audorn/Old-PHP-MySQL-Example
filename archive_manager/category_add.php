<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<?php 
  $elements = [];
  $elements[] = ElementCompiler::createHidden(VN::action, Action::add_category);
  $elements[] = ElementCompiler::createRadioButtonArray
          ('Parent:', VN::parent_id, $category_ids, $category_names, 0);
  $elements[] = ElementCompiler::createTextField
          ('Name:', VN::name, $name ?? '', true);
  $elements[] = ElementCompiler::createTextArea
          ('Description:', VN::description, $description ?? '');
  $elements[] = ElementCompiler::createBreak(2);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Cancel);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Add);
  $formHTML = FormCompiler::createForm($elements);

//  $elements[] = ElementCompiler::createMultiCheckboxArray
//          ('Parent/Child Category Relationships', [VN::parent_ids, VN::child_ids],
//           $category_ids, $category_names, [$parent_ids ?? ['0'], $child_ids ?? ['0']]);

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
  <h2>Categories</h2>
  <?php 
  echo $formHTML; 
  ?>
</main>

<?php include('../view/footer.php'); ?>