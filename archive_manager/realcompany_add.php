<!-- Copyright: Jeremy Anderson 2018 -->
<?php include('../view/header.php'); ?>
<?php 
  $elements = [];
  $elements[] = ElementCompiler::createHidden(VN::action, Action::add_realcompany);
  $elements[] = ElementCompiler::createCheckboxArray
        ('Parent Categories:', VN::parent_id, $category_ids, $category_names);
  $elements[] = ElementCompiler::createTextField
          ('Name:', VN::name, $name ?? '', true);
  $elements[] = ElementCompiler::createTextArea
          ('Description:', VN::description, $description ?? '');
  $elements[] = ElementCompiler::createBreak(2);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Cancel);
  $elements[] = ElementCompiler::createButton(VN::button, BV::Add);
  $formHTML = FormCompiler::createForm($elements);

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
  <h2>Real Companies</h2>
  <?php 
  echo $formHTML; 
  ?>
</main>

<?php include('../view/footer.php'); ?>