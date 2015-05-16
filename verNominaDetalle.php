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
                $strCodigo = $_GET['codigo'];
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
                    while ($arNomina = $arNominas->fetch_assoc()) {
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
                echo "<td style='text-align: right'>" . number_format($douTotalNeto, 0, ',', '.') . "</td>";
                echo "</tr>";
                ?>                
            </tbody>
        </table>   <br /><br /><br />

        <table border="1">
            <caption>Tiempo suplementario</caption>
            <thead>
                <tr>
                    <th>codsala</th>
                    <th>Concepto</th>
                    <th>Abreviatura</th>
                    <th>Horas</th>
                    <th>Valor</th>
                    <th>Deduccion</th>
                    <th>Empleado</th>
                    <th>Cedula</th>                    
                </tr>
            </thead>
            <tbody>                
                <?php
                //Incapacidades, licencias
                $strExcluir = " AND codsala <> '64' AND codsala <> '32' AND codsala <> '26' AND codsala <> '65' AND codsala <> '63' AND codsala <> '25' AND codsala <> '24' AND codsala <> '03' AND codsala <> '86'";
                $strSql = "SELECT sql_migracion_tiempo_suplementario.* FROM sql_migracion_tiempo_suplementario WHERE codigo = '" . $_GET['codigo'] . "'" . $strExcluir . " ORDER BY abreviatura, desala, nombre_corto";
                $arNominas = $servidorJG->query($strSql);

                if ($arNominas->num_rows > 0) {
                    while ($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $arNomina['codsala'] . "</td>";
                        echo "<td>" . $arNomina['desala'] . "</td>";
                        echo "<td>" . $arNomina['abreviatura'] . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['nrohora'], 1, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['salario'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['deduccion'] * -1, 0, ',', '') . "</td>";
                        echo "<td>" . $arNomina['nombre_corto'] . "</td>";
                        echo "<td>" . $arNomina['cedemple'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $arNominas->close();
                ?>                   
            </tbody>            
        </table>   <br /> <br />

        <table border="1">
            <caption>Descuentos a exportar</caption>
            <thead>
                <tr>
                    <th>codsala</th>
                    <th>Concepto</th>
                    <th>Abreviatura</th>
                    <th>Horas</th>
                    <th>Valor</th>
                    <th>Deduccion</th>
                    <th>Empleado</th>
                    <th>Cedula</th>                    
                </tr>
            </thead>
            <tbody>                
                <?php
                $strExcluir = " AND codsala <> '12' AND codsala <> '95'";
                $strSql = "SELECT sql_migracion_tiempo_suplementario.* FROM sql_migracion_tiempo_suplementario WHERE codigo = '" . $_GET['codigo'] . "'" . $strExcluir . " ORDER BY abreviatura, desala, nombre_corto";
                $arNominas = $servidorJG->query($strSql);
                if ($arNominas->num_rows > 0) {
                    while ($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $arNomina['codsala'] . "</td>";
                        echo "<td>" . $arNomina['desala'] . "</td>";
                        echo "<td>" . $arNomina['abreviatura'] . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['nrohora'], 1, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['salario'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['deduccion'] * -1, 0, ',', '') . "</td>";
                        echo "<td>" . $arNomina['nombre_corto'] . "</td>";
                        echo "<td>" . $arNomina['cedemple'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $arNominas->close();
                ?>                   
            </tbody>            
        </table>   <br /> <br />
        <a href="exportarDescuentos.php?codigo=<?php echo $strCodigo; ?>">Exportar</a> <br />
        <a href="verNomina.php">Volver</a>
    </body>
</html>

