<?php
include 'excel_reader.php';       // include the class
$excel = new PhpExcelReader;      // creates object instance of the class
$excel->read('excel_file.xls');   // reads and stores the excel file data

// Test to see the excel data stored in $sheets property
echo '<pre>';
var_export($excel->sheets);

echo '</pre>';

echo '<pre>';
print_r($excel->sheets);

echo '</pre>';
