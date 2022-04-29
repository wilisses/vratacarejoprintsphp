<?php
  @session_start();
  if (@$_SESSION["ecf"] == null) {  
?>
  <script language="JavaScript">window.location.href = "index.php";</script>
<?php    
}
  // Mysql

  $host =  "localhost";
  $root = "root";
  $senha = "";
  $db =  "vratacarejoprints";

  @$conn = mysqli_connect($host,$root,$senha)or die("<b>error na conexão con</b>");
  @$int =  mysqli_select_db($conn,$db)or die("<b>error na conexão int</b>");


  $sql = mysqli_query($conn,"SELECT * FROM databaseconfiguration ");
  @$connection = mysqli_fetch_array($sql);


  // Postgres
  @$con = pg_connect("host= ".$connection['host']." port=".$connection['port']." dbname=".$connection['dbname']." user=".$connection['user']." password=".$connection['password']."");
  $LOJA = 1;

?>