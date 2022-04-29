<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"
    />
    <title>VRAtacarejoPrints</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="icon" type="image/x-icon" href="assets/VRAtualizador.ico">
  </head>
  <body>
    <div class="conexao"><?php include 'conexao.php';?></div>
    <header>
      <div class="container">
        <div class="head">
          <a href="">
            <div class="logo">
              <i>VRAtacarejoPrints</i>
            </div>
          </a>
          
        </div>
      </div>
    </header>
    <main>
      <section>
        <div class="container">
          <div class="form">
            <form method="post" action="">
              <label class="form-label"> Pedido </label>
              <div class="form-group">
                <input type="search" name="search" id="search" class="form-search" size="10" maxlength="10" placeholder="Ex.: 19" required="required"/>
                <input type="submit" value="Buscar" class="form-submit"/>
              </div>
            </form>
            <button id="settings-on" onclick="settings_on('settings_on')">
            <i class="fa fa-cog" aria-hidden="true"></i>
          </button>
          <button id="settings-off" onclick="settings_off('settings_off')">
            <i class="fa fa-cog" aria-hidden="true"></i>
          </button>
          <script type="text/javascript">
            function settings_on(Mostrar){
              if (Mostrar == 'settings_on') {
                document.getElementById("settings").style.display = "block";
                document.getElementById("settings-on").style.display = "none";
                document.getElementById("settings-off").style.display = "block";
              }
            }
            function settings_off(Ocultar){
              if (Ocultar == 'settings_off') {
                document.getElementById("settings").style.display = "none";
                document.getElementById("settings-on").style.display = "block";
                document.getElementById("settings-off").style.display = "none";
              }
            }
          </script>
          <div id="settings" >
            <div class="head-settings">
              <div class="settings-title">Configuração</div>
            </div>
            <div class="container">
              <?php 
                @$dbname = $_POST['dbname'];
                @$host = $_POST['host'];
                @$port = $_POST['port'];
                @$user = $_POST['user'];
                @$password = $_POST['password'];
                @$submit = $_POST['submit'];

                if ($submit == "Salvar"){
                  @$sql=mysqli_query($conn ,
                    "UPDATE databaseconfiguration SET 
                      dbname = '$dbname',
                      host = '$host',
                      port = '$port',
                      user = '$user',
                      password = '$password'         
                    WHERE id = 1"
                  );
                  @session_start();
                  $_SESSION["return"] = 'Salvo com sucesso!';     
                }

                $linha = 1;
                @$sql = mysqli_query($conn,"SELECT * FROM databaseconfiguration WHERE id = 1");
                @$settings = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM databaseconfiguration WHERE id = 1"));
              ?>
              <form method="post" action="" class="settings-form">
                <label class="form-label">Nome DB</label>
              <br/>
                <input type="text" name="dbname" class="form-settings" value="<?php echo $settings['dbname'] ?>">
              <br/>
                <label class="form-label">IP DB</label>
              <br/>
                <input type="text" name="host" class="form-settings" value="<?php echo $settings['host'] ?>">
              <br/>
                <label class="form-label">Porta</label>
              <br/>
                <input type="text" name="port" class="form-settings" value="<?php echo $settings['port'] ?>">
              <br/>
                <label class="form-label">Usuário</label>
              <br/>
                <input type="text" name="user" class="form-settings" value="<?php echo $settings['user'] ?>">
              <br/>
                <label class="form-label">Senha</label>
              <br/>
                <input type="password" name="password" class="form-settings" value="<?php echo $settings['password'] ?>">
              <br/>
                <input type="submit" name="submit" value="Salvar" class="form-submit"/>
              </form>
            </div>
          </div>
        </div>
      </section>
      <section>
        <div class="container">
          <div class="div-table">
            <table class="table">
              <tr>
                <th class="th">
                  EAN
                </th>
                <th class="th">
                  DESCRIÇÂO
                </th>
                <th class="th">
                  QTD.EMB
                </th>
                <th class="th">
                  QTD
                </th>
                <th class="th">
                  QTD.ATENDIDA
                </th>
              </tr>
              <?php
                 
                @$search = $_POST['search'];
                if ($search != null) {
                @$sql = pg_query($con,
                  "SELECT
                    v.id AS pedido,
                    a.codigobarras AS ean,
                    p.descricaoreduzida AS descricao,
                    vi.qtdembalagem AS qtdemb,
                    vi.quantidade AS qtd,
                    '__________' AS qtdatendida
                  FROM 
                    atacarejo.vendaitem vi 
                  INNER JOIN
                    atacarejo.venda v ON v.id = vi.id_venda
                  INNER JOIN 
                    produto p ON p.id = vi.id_produto
                  INNER JOIN
                    produtoautomacao a ON a.id_produto = vi.id_produto
                  WHERE v.id = $search;"
                );
                  while(@$pedido = pg_fetch_array($sql)){
                      ?>
                    
              <tr>
                <td class="td">
                  <?php echo $pedido['ean'];?>
                </td>
                <td class="td">
                  <?php echo $pedido['descricao'];?>
                </td>
                <td class="td">
                  <?php echo str_replace(['.'],',', $pedido['qtdemb']);?>
                </td>
                <td class="td">
                  <?php echo str_replace(['.'],',', $pedido['qtd']);?>
                </td>
                <td class="td">
                  <?php echo $pedido['qtdatendida'];?>
                </td>
              </tr> 
              <?php }} ?>
            </table>
          </div>
          <div class="prints-button">
                <a href="prints.php?pedido=<?php echo $search;?>" class="print">
                  <i class="fa fa-print" aria-hidden="true"></i> Imprimir
                </a>
              </div>
        </div>
        <div class="escuro-return">
                <?php 
                    @session_start();
                    if(@$_SESSION["return"] != null){
                        echo "<div class='return'>".@$_SESSION["return"]."</div>";
                    ?>
                    <script language="JavaScript">
                        setTimeout(function() {window.location.href = "";}, 1000);
                    </script>
                    <?php 
                        unset($_SESSION["return"]); 
                        @session_destroy();
                    }
                ?>
            </div>
      </section>
    </main>
  </body>
</html>
