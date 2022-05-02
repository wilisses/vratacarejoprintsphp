<?php  
  @session_start();
  unset($_SESSION["ecf"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VRAtacarejoPrints</title>

    <link rel="stylesheet" type="text/css" href="style.css">
	  <link rel="icon" type="image/x-icon" href="img/VRAtacado.ico">

</head>
<body>
    <header>

    </header>
    <main>
    <section> 
            <div class="container"> 
                <div class="login">
                  <img src="img/logotipo.png" class="img">
                  <form method="post" action="">
                    <label>ECF</label> 
                    <select name="ecf" required="required">
                      <option value="" title="ECF"></option>
                      <?php 
                        include 'conexao/mysql.php';
                        @$sql = mysqli_query($conn,"SELECT ecf FROM pdv" );
                        while(@$ecf = mysqli_fetch_array($sql)){ ?>
                          <option value="<?php echo $ecf['ecf'] ?>" title="ECF"><?php echo $ecf['ecf'] ?></option>
                      <?php } ?>
                    </select>
                    <input type="submit" value="Entrar" class="button">
                  </form>
                </div>
            </div>
        </section> 
        <section>          
            <div class="escuro-return">
                <?php
                if (@$_POST['ecf']!= null) {
                  @$_SESSION["ecf"] = $_POST['ecf'];  
                ?>
                  <script language="JavaScript">window.location.href = "Dashboard.php";</script>
                <?php 
                }
                  
                ?>
            </div>
        </section>
    </main>
</body>
</html>