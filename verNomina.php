<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ver pago nomina</title>
    </head>
    <body>
        <h1>Ver pago nomina</h1>
        <table border="1">

            <caption>Nominas</caption>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Desde</th>
                    <th>Hasta</th>
                    <th>Centro costo</th>
                    <th>NroNominas</th>
                    <th>Pagado</th>
                    <th>Neto</th>                    
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <td colspan="3">Informacion nominas</td>
                </tr>
            </tfoot>

            <tbody>                
                <?php
                set_time_limit(0);
                $servidorBrasa = new mysqli("192.168.10.152", "jgmysql", "yuij. 487.", "bdbrasa");
                if ($servidorBrasa->connect_error) {
                    die("Connection failed: " . $servidorBrasa->connect_error);
                } 

                $servidorJG = new mysqli("192.168.10.26", "jgmysql", "$4cc3t0/.", "jgefectivo");
                if ($servidorJG->connect_error) {
                    die("Connection failed: " . $ervidorJG->connect_error);
                }

                $strSql = "SELECT sql_migracion_pago_nomina.* FROM sql_migracion_pago_nomina WHERE 1 LIMIT 20";
                $arNominas = $servidorJG->query($strSql);

                if ($arNominas->num_rows > 0) {
                    while($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='verNominaDetalle.php?codigo=" . $arNomina['codigo'] . "'>" . $arNomina['codigo'] . "</a></td>";
                        echo "<td>" . $arNomina['desde'] . "</td>";
                        echo "<td>" . $arNomina['hasta'] . "</td>";
                        echo "<td>" . $arNomina['zona'] . "</td>";
                        echo "<td>" . $arNomina['NroNominas'] . "</td>";   
                        echo "<td style='text-align: right'>" . number_format($arNomina['pagado'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['neto'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $arNominas->close();
                set_time_limit(60);
                ?>                
            </tbody>
        </table> <br /><br />
        <a href="index.php">Volver</a>
        
    </body>
</html>

