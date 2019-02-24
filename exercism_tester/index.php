<?php
 /**
  * Index File Doc Comment
  * PHP version 7.2
  * 
  * @category  Index
  * @package   Exercism_Tester
  * @author    Jeremy Anderson <tjer101105@gmail.com>
  * @copyright 2018 Jeremy
  * @license   GNU General Public License version 2 or later; see LICENSE
  * @link      http://link.com
  */

  require "pig-latin.php";

// Run all the tests here.

$input = "school is fun";

echo 'Input: ' . $input . '<br>';
echo 'Tranlated: ' . translate($input);
