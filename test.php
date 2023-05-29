<?php

$keyword = "aaa";
$table_name ="aa_table";

$sql = "SELECT * FROM $table_name WHERE title LIKE $keyword"; 

print($sql)