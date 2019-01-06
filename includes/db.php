<?php

$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "Jeremi3125";
$db['db_name'] = "cms";

foreach ($db as $key => $value) {
  // code of a function making constants!
  define(mb_strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if($connection){
  //echo "Database connection established!";
}else{
  die("Database connection failed");
}


?>
