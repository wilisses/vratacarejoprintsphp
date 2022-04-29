<?php
/* Change to the correct path if you copy this example! */
require __DIR__ . '/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 *
 * Use a WindowsPrintConnector with the share name to print.
 *
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 *
 *  echo "Hello World" > testfile
 *  copy testfile "\\%COMPUTERNAME%\Receipt Printer"
 *  del testfile
 */
try {
    @$ecf = $_GET['ecf'];
    @$pedido = $_GET['pedido'];

    date_default_timezone_set('America/Fortaleza');
    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    $datetime = strftime('%d/%m/%Y %H:%M');


    if ($pedido != null) {

        // Enter the share name for your USB printer here
        //$connector = null;
        include 'conexao.php';
        @$printeraddress = mysqli_fetch_array(mysqli_query($conn,"SELECT printeraddress FROM pdv WHERE ecf = $ecf"));
        $connector = new WindowsPrintConnector("smb:".$printeraddress['printeraddress']);

        /* Print a "Hello world" receipt" */
        $printer = new Printer($connector);

        include 'conexao.php';
        $sql = pg_query($con,
            "SELECT 
                f.nomefantasia  AS nomefantasia,
                ce.nome AS nomecliente,
                ce.telefone AS telefonecliente
            FROM 
                atacarejo.venda v 
            INNER JOIN
                loja l ON l.id = v.id_loja
            INNER JOIN
                fornecedor f ON f.id = l.id_fornecedor 
            INNER JOIN
                clienteeventual ce ON ce.id = v.id_clienteeventual
            INNER JOIN
                estado e ON e.id = f.id_estado
            INNER JOIN
                municipio m ON m.id = f.id_municipio 
            WHERE v.id = $pedido;"
        );
        $inf = pg_fetch_array($sql);
        $printer -> setTextSize(1, 1);
        $printer -> text($inf['nomefantasia']."\n");
        $printer -> text("CLIENTE: ".$inf['nomecliente']."\n");
        $printer -> text("TELEFONE: ".$inf['telefonecliente']."\n");
        $printer -> text("PEDIDO : ".$pedido."      DATA/HORA: ".$datetime."\n\n");
        $printer -> text("---------------------------------------------- \n");
        $printer -> text("          GUIA DE SEPARACAO DE PEDIDO          \n");
        $printer -> text("---------------------------------------------- \n\n");
        $printer -> text("# | COD | DESCRICAO | QTB.EMB | QTD | QTD.ATEN \n");

        $sql = pg_query($con,
            "SELECT
            v.id AS pedido,
            a.codigobarras AS ean,
            p.descricaoreduzida AS descricao,
            TO_CHAR(vi.qtdembalagem,'999G999G990D999') AS qtdemb,
            TO_CHAR(vi.quantidade,'999G999G990D999') AS qtd,
            '__________' AS qtdatendida
            FROM 
            atacarejo.vendaitem vi 
            INNER JOIN
            atacarejo.venda v ON v.id = vi.id_venda
            INNER JOIN 
            produto p ON p.id = vi.id_produto
            INNER JOIN
            produtoautomacao a ON a.id_produto = vi.id_produto
            WHERE v.id = $pedido;"
        );
            $line = 1;
            while($pedido = pg_fetch_array($sql)){
                $printer -> text(str_pad($line, 3, "0", STR_PAD_LEFT)." ");
                switch (strlen($pedido['ean'])) {
                    case 1:
                        $printer -> text($pedido['ean']."             ");
                        break;
                    case 2:
                        $printer -> text($pedido['ean']."            ");
                        break;
                    case 3:
                        $printer -> text($pedido['ean']."           ");
                        break;
                    case 4:
                        $printer -> text($pedido['ean']."          ");
                        break;
                    case 5:
                        $printer -> text($pedido['ean']."         ");
                        break;
                    case 6:
                        $printer -> text($pedido['ean']."        ");
                        break;
                    case 7:
                        $printer -> text($pedido['ean']."       ");
                        break;
                    case 8:
                        $printer -> text($pedido['ean']."      ");
                        break;
                    case 9:
                        $printer -> text($pedido['ean']."     ");
                        break;
                    case 10:
                        $printer -> text($pedido['ean']."    ");
                        break;
                    case 11:
                        $printer -> text($pedido['ean']."   ");
                        break;
                    case 12:
                        $printer -> text($pedido['ean']."  ");
                        break;
                    case 13:
                        $printer -> text($pedido['ean']." ");
                        break;
                    case 14:
                        $printer -> text($pedido['ean']."");
                }
                $printer -> text($pedido['descricao']."\n");
                $printer -> text("".$pedido['qtdemb']."");
                $printer -> text("".$pedido['qtd']."");
                $printer -> text("  ".$pedido['qtdatendida']."\n");

                $line++;

            }
        $printer -> cut();
        /* Close printer */
        $printer -> close();

        @session_start();
		$_SESSION["return"] = 'Imprimindo...';
?>
    <script language="JavaScript">window.location.href = "Dashboard.php";</script>
<?php      
    }
} catch (Exception $e) {
    @session_start();
    $_SESSION["return"] = "Couldn't print to this printer: " . $e -> getMessage() . "\n";
?>
    <script language="JavaScript">window.location.href = "Dashboard.php";</script>
<?php 
}


