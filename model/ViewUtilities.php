<?php
// Copyright: Jeremy Anderson 2018
abstract class FormCompiler {
  // Accepts an array of strings, which will be 
  // concatenated into form tags and returned.
  public function CreateForm($elements, $formClass = FC::manager_list_form) {
    $html = '<form action="." method="post" class="'.$formClass.'">';
    foreach ($elements as $element) {
      $html .= $element;
    }
    $html .= '</form>';
    return $html;
  }
}

abstract class ElementCompiler {
  public function createSpace($num = 1) 
  {
    $html = '&nbsp;';
    for ($i = 1; $i < $num; $i++)
      $html .= '&nbsp';
    return $html;
  }
  public function createBreak($num = 1)
  {
    $html = '<br>';
    for ($i = 1; $i < $num; $i++)
      $html .= '<br>';
    return $html;
  }
  public function createHidden($varName, $value) 
  {
    $html = '<input type="hidden" name="'.$varName.'" value="'.$value.'">';
    return $html;
  }
  public function createHiddenArray($varName, $values) 
  {
    $serializedValues = serialize($values);
    $encodedValues = htmlspecialchars($serializedValues);
    $html = '<input type="hidden" name="'.$varName.'" value="'.$encodedValues.'">';
    return $html;
  }
  public function createLabel($label, $isLong = FALSE)
  {
    $html = '<label'.(($isLong) ? ' class="long_label"' : '').'>'.$label.'</label>';
    return $html;
  }
  public function createTextField($label, $varName, $varValue = '', $isRequired = FALSE) 
  {
    $html = '<label>'.$label.'</label><input type="text" name="'.$varName.'" value="'.$varValue.'">';
    if ($isRequired)
      $html .= '<label class="required_field">&nbsp;*Required</label>';
    $html .= '<br>';
    return $html;
  }
  public function createTextArea($label, $varName, $varValue = '', $isDisabled = FALSE, $isRequired = FALSE) 
  {
    $html = '<label>'.$label.'</label><textarea name="'.$varName.'"';
    $html .= $isDisabled ? 'disabled' : '';
    $html .= '>'.$varValue.'</textarea>';
    if ($isRequired)
      $html .= '<label class="requiredField">&nbsp;*Required</label>';
    $html .= '<br>';
    return $html;
  }
  // $label: displayed text above the table
  // $headers: array of strings that will be table headers.
  // $texts: single or multi-dimensional array, 1st dimension must match headers.
  public function createTable($label, $headers, $texts) 
  {
    $html = '<label class="long_label">'.$label.'</label><table><tr>';
    for ($i = 0; $i < count($headers); $i++)
      $html .= '<th>'.$headers[$i].'</th>';

    $html .= '</tr><tr>';
    
    $rows = 1;
    if (count($headers) > 1) {
      foreach ($texts as $texColumn) {
        $rows = $rows >= count($texColumn) ? $rows : count($texColumn);
      }
    } else {
      $rows = count($texts);
    }
    
    for ($i = 0; $i < $rows; $i++) {
      for ($j = 0; $j < count($headers); $j++) 
        $html .= '<td>'.(count($headers) == 1 ? $texts[$i] ?? '' : $texts[$j][$i] ?? '').'</td>';
      $html.= '</tr>';
    }
    $html .= '</table>';
    return $html;
  }
  public function createSelect($label, $varName, $varValues, $texts) 
  {
    $html = '<label>'.$label.'</label><select name="'.$varName.'">';

    $html .= '<option value=""></option>'; // Empty for no category.
    for ($i = 0; $i < count($varValues); $i++)
      $html .= '<option value="'.$varValues[$i].'">'.$texts[$i].'</option>';
    $html .= '</select><br>';

    return $html;
  }
  public function createButton($varName, $text) 
  {
    $html = '<input type="submit" class="button" name="'.$varName.'" value ="'.$text.'">';
    return $html;
  }
  public function createCheckboxArray($label, $varName, $varValues, $texts, $maxPerRow = 4) 
  {
    $html = '<label class="long_label"><b>'.$label.'</b></label><table class="checkboxArray" style="width: 1000px"><tr>';
    for ($i = 0; $i < count($varValues); $i++) {
      if ($i != 0 && ($i % $maxPerRow) == 0)
        $html .= '</tr><tr>';
      $html .= '<td><input type="checkbox" name="'.$varName.'[]" value="'.$varValues[$i].'">'.
              $texts[$i].'</td>';
    }
    $html .= '</tr></table>';
    return $html;
  }
  public function createRadioButtonArray($label, $varName, $varValues, $texts, $varValueSelected = NULL, $maxPerRow = 4) 
  {
    $html = '<label class="long_label"><b>'.$label.'</b></label><table class="checkbox_array" style="width: 100%"><tr>';
    for ($i = 0; $i < count($varValues); $i++) {
      if ($i != 0 && ($i % $maxPerRow) == 0)
        $html .= '</tr><tr>';
      $html .= '<td><input type="radio" name="'.$varName.'" value="'.$varValues[$i]
      .($varValueSelected == $varValues[$i] ? '" checked="checked' : '')
      .'">'.$texts[$i].'</td>';
    }
    $html .= '</tr></table>';
    return $html;
  }

  // $label: displayed text above the multi-radio-button array table.
  // $groupNames: array of names - one for each radio button group.
  // $varNames: array of valid variable names - one per <td></td>.
  // $varValues: array of values for the variables.
  // $texts: displayed text after earch individual radio button.
  // $varValuesSelected: array of current settings for each $varNames.
  // Each $varValue will be assigned once to every $varName.
  // Each $text will be assigned once to each $varValue.
  public function createMultiRadioButtonArray($label, $groupNames, $varNames, $varValues, $texts, $varValuesSelected = NULL, $areNumbers = true, $maxPerRow = 4) 
  {
    if (is_null($varValuesSelected)) {
      $varValuesSelected = [];
      foreach ($varNames as $varName) {
        $varValuesSelected[] = $varValues[0]; // Set the default to the first value.
      }
    }
    if (count($varNames) != count($varValuesSelected)) {
      $error = 'First dimension of $varNames and $varValuesSelected are not equal.';
      include('../errors/error.php');
      return;
    }

    $html = '<label class="long_label"><b>'.$label.'</b></label><table class="checkbox_array"><tr>';
    for ($i = 0; $i < count($varNames); $i++) {
      if ($i != 0 && ($i % $maxPerRow) == 0)
        $html .= '</tr><tr>';
      
      $html .= '<td>'.createRadioButtonGroup($groupNames[$i], 
        $areNumbers ? '_'.$varNames[$i] : $varNames[$i], $varValues, $texts, $varValuesSelected[$i]).'</td>';
    }
    $html .= '</tr></table>';

    return $html;
  }

  // $label: displayed text above the multi-checkbox array table. 
  // $varNames: array valid variable names - all in each <td></td>.  
  // $varValues: array of values for the variables.
  // $texts: displayed text after each set of checkboxes.
  // $varValuesChecked: multi-dimensional array, containing the $varValues
  //                   selected for each $varName.
  // Each $varValue will be assigned once to every varName.
  // Each $text will be assigned to the last checkbox of each group.
  public function createMultiCheckboxArray($label, $varNames, $varValues, $texts, $varValuesChecked = NULL, $maxPerRow = 4) 
  {
    if (count($varNames) != count($varValuesChecked)) {
      $error = 'First dimension of $varNames and $varValuesChecked is not equal.';
      include('../errors/error.php');
      return;
    }
    
    $html = '<label class="long_label"><b>'.$label.'</b></label><table class="checkbox_array"><tr>';
    for ($i = 0; $i < count($varValues); $i++) { 
      if ($i != 0 && ($i % $maxPerRow) == 0)    
        $html .= '</tr><tr>';
      
      $isChecked = array();
      foreach ($varValuesChecked as $checkedValues) 
        $isChecked[] = isValueChecked($varValues[$i], $checkedValues);
      $html .= '<td>'.createCheckboxGroup($varNames, $varValues[$i], $texts[$i], $isChecked).'</td>';
    }
    $html .= '</tr></table>';

    return $html;
  }
}

function createRadioButtonGroup($groupName, $varName, $varValues, $texts, $varValueSelected) {
  $html = '<label>'.$groupName.'</label><br>';
  for ($i = 0; $i < count($varValues); $i++) {
    $html .= '<input type="radio" name="'.$varName.'" value="'.$varValues[$i]
    .($varValueSelected == $varValues[$i] ? '" checked="checked' : '')
    .'">'.$texts[$i].'<br>';
  }

  return $html;
}
// checkbox array preparation.
function isValueChecked($varValue, $checkedValues) {
  foreach ($checkedValues as $checkedValue) {
    if ($varValue == $checkedValue)
      return true;
  }
  return false;
}
function createCheckboxGroup($varNames, $varValue, $text, $isChecked) {
  $html = '';
  for ($i = 0; $i < count($varNames); $i++) {
    $html .= '<input type="checkbox" name="'.$varNames[$i].'[]" value="'.$varValue.'"';
    $html .= $isChecked[$i] ? ' checked="checked"' : '';
    $html .= '>';
  }
  $html .= '&nbsp;'.$text;
  
  return $html;
}

// Valid button labels/values.
abstract class BV {
  const Back = 'Back';
  const Cancel = 'Cancel';
  const Add = 'Add';
  const Edit = 'Edit';
  const Delete = 'Delete';
}

// Valid form classes.
abstract class FC {
  const manager_list_form = 'manager_list_form';
  const manager_entity_form = 'manager_entity_form';
}
?>