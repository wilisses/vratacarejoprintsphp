<?php
  // Mysql

  include "mysql.php";

  $sql = mysqli_query($conn,"SELECT * FROM databaseconfiguration");
  @$connection = mysqli_fetch_array($sql);


  // Postgres
  @$con = pg_connect("host= ".$connection['host']." port=".$connection['port']." dbname=".$connection['dbname']." user=".$connection['user']." password=".$connection['password']."");
  @$LOJA = 1;


?>