<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ver pago nomina</title>
    </head>
    <body>
        <h1>Ver pago nomina conceptos <?php echo $_GET['consecutivo']; ?></h1>
        
        <table border="1">

            <caption>Nominas detalle conceptos</caption>
            <thead>
                <tr>
                    <th>Conse</th>
                    <th>Descripcion</th>
                    <th>NroHora</th>
                    <th>VlrHora</th>
                    <th>Porcentaje</th>
                    <th>Deduccion</th>
                    <th>Salario</th>
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

                $strSql = "SELECT sql_migracion_pago_nomina_detalle_conceptos.* FROM sql_migracion_pago_nomina_detalle_conceptos WHERE consecutivo = '" . $_GET['consecutivo'] . "' LIMIT 10";
                $arNominas = $servidorJG->query($strSql);

                if ($arNominas->num_rows > 0) {
                    while($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $arNomina['conse'] . "</td>";
                        echo "<td>" . $arNomina['descripcion'] . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['nrohora'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['vlrhora'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['porcentaje'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['deduccion'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['salario'], 0, ',', '.') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $arNominas->close();
                set_time_limit(60);
                ?>                
            </tbody>
        </table>                
    </body>
</html>

