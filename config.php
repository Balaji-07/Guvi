<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'Balaji1234');
   define('DB_DATABASE', 'guvi');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   if(!$db)
   {
      die("Connection Failed.." . mysqli_connect_error());
   }
?>