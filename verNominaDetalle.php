<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ver pago nomina</title>
    </head>
    <body>
        <h1>Ver pago nomina <?php echo $_GET['codigo']; ?></h1>
        
        <table border="1">

            <caption>Nominas detalle</caption>
            <thead>
                <tr>
                    <th>Cosecutivo</th>
                    <th>Identificacion</th>
                    <th>Empleado</th> 
                    <th>Desde</th>
                    <th>Hasta</th> 
                    <th>Pagado</th>
                    <th>Neto</th>
                </tr>
            </thead>
            <tbody>                
                <?php
                $servidorBrasa = new mysqli("192.168.10.152", "jgmysql", "yuij. 487.", "bdbrasa");
                if ($servidorBrasa->connect_error) {
                    die("Connection failed: " . $servidorBrasa->connect_error);
                } 

                $servidorJG = new mysqli("192.168.10.26", "jgmysql", "$4cc3t0/.", "jgefectivo");
                if ($servidorJG->connect_error) {
                    die("Connection failed: " . $ervidorJG->connect_error);
                }

                $strSql = "SELECT sql_migracion_pago_nomina_detalle.* FROM sql_migracion_pago_nomina_detalle WHERE codigo = '" . $_GET['codigo'] . "'";
                $arNominas = $servidorJG->query($strSql);
                $douTotalNeto = 0;
                if ($arNominas->num_rows > 0) {
                    while($arNomina = $arNominas->fetch_assoc()) {
                        $douTotalNeto = $douTotalNeto + $arNomina['neto'];
                        echo "<tr>";
                        echo "<td><a href='verNominaDetalleConceptos.php?consecutivo=" . $arNomina['consecutivo'] . "'>" . $arNomina['consecutivo'] . "</a></td>";                        
                        echo "<td>" . $arNomina['cedemple'] . "</td>";   
                        echo "<td>" . $arNomina['nombre_corto'] . "</td>";   
                        echo "<td>" . $arNomina['desde'] . "</td>";
                        echo "<td>" . $arNomina['hasta'] . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['pagado'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['neto'], 0, ',', ',') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $arNominas->close();
                ?>    
                <?php

                    echo "<tr>";
                    echo "<td></td>";                        
                    echo "<td></td>"; 
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td style='text-align: right'></td>";
                    echo "<td style='text-align: right'>" .  number_format($douTotalNeto, 0, ',', '.') . "</td>";
                    echo "</tr>";
                ?>                
            </tbody>
        </table>   <br /><br /><br />
        
        <table border="1">

            <caption>Tiempo suplementario</caption>
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Empleado</th>
                    <th>codsala</th>
                    <th>Concepto</th>
                    <th>Abreviatura</th>
                    <th>Horas</th>
                    <th>Valor</th>
                    <th>Deduccion</th>
                </tr>
            </thead>



            <tbody>                
                <?php                
                $strSql = "SELECT sql_migracion_tiempo_suplementario.* FROM sql_migracion_tiempo_suplementario WHERE codigo = '" . $_GET['codigo'] . "' ORDER BY abreviatura, desala, nombre_corto";
                $arNominas = $servidorJG->query($strSql);

                if ($arNominas->num_rows > 0) {
                    while($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";                        
                        echo "<td>" . $arNomina['cedemple'] . "</td>"; 
                        echo "<td>" . $arNomina['nombre_corto'] . "</td>";
                        echo "<td>" . $arNomina['codsala'] . "</td>";
                        echo "<td>" . $arNomina['desala'] . "</td>";
                        echo "<td>" . $arNomina['abreviatura'] . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['nrohora'], 1, ',', '.') . "</td>";                        
                        echo "<td style='text-align: right'>" . number_format($arNomina['salario'], 0, ',', '.') . "</td>";                        
                        echo "<td style='text-align: right'>" . number_format($arNomina['deduccion'], 0, ',', '') . "</td>";                        
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $arNominas->close();                
                ?>                   
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Informacion nominas</td>
                </tr>
            </tfoot>            
        </table>   <br /> <br />
        <a href="verNomina.php">Volver</a>
    </body>
</html>

