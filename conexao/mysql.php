<?php
  // Mysql

  $host =  "localhost";
  $root = "root";
  $senha = "";
  $db =  "vratacarejoprints";

  @$conn = mysqli_connect($host,$root,$senha)or die("<b>error na conexão con</b>");
  @$int =  mysqli_select_db($conn,$db)or die("<b>error na conexão int</b>");
  
 ?>