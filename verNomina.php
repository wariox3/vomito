<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ver pago nomina</title>
        <style type="text/css">
            body{
                font-family: verdana;
                font-size: 13px;
            }
        </style>        
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
                include("conexion.php");

                $strSql = "SELECT sql_migracion_pago_nomina.* FROM sql_migracion_pago_nomina WHERE 1 LIMIT 30";
                $arNominas = $servidorJG->query($strSql);
                if ($arNominas->num_rows > 0) {
                    while($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><a href='verNominaDetalle2.php?codigo=" . $arNomina['codigo'] . "'>" . $arNomina['codigo'] . "</a></td>";
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

