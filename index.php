<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" type="image/x-icon" href="img/favicon.ico">

</head>
<body>
    <header>

    </header>
    <main>
    <section> 
            <div class="container"> 
                <div class="login">
                    
                    <img src="img/logotipo.png" class="img">
                    <form method="post" action="LgZB9723pp2t8cUsU5_d7Q.php">
                      <label>ECF</label> 
                      <select name="ecf" required="required">
                        <option value="" title="ECF"></option>
                        <?php 
                          include 'conexao.php';
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
                    session_start();
                    if(@$_SESSION["errosession"] != null){
                        echo "<div class='errosession'>".@$_SESSION["errosession"]."</div>";
                    ?>
                    <script language="JavaScript">
                        setTimeout(function() {window.location.href = "";}, 900);
                    </script>
                    <div id="escuro">
        
                    </div>
                    <?php 
                        unset($_SESSION["errosession"]); 
                        @session_destroy();
                    }
                ?>
            </div>
        </section>
    </main>
</body>
</html>