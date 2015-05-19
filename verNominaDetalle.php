<!DOCTYPE html>
<html>
    <head>        
        <meta charset="UTF-8">
        <title>Ver pago nomina</title>
        <style type="text/css">
            body{
                font-family: verdana;
                font-size: 11px;
            }
        </style>        
    </head>
    <body>
        <a href="verNomina.php">Volver</a> <br /> <br />        
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
                    <th>Horas</th>
                </tr>
            </thead>
            <tbody>                
                <?php
                $strCodigo = $_GET['codigo'];
                include("conexion.php");

                $strSql = "SELECT sql_migracion_pago_nomina_detalle.* FROM sql_migracion_pago_nomina_detalle WHERE codigo = '" . $_GET['codigo'] . "'";
                $arNominas = $servidorJG->query($strSql);
                $douTotalNeto = 0;
                if ($arNominas->num_rows > 0) {
                    while ($arNomina = $arNominas->fetch_assoc()) {
                        $douTotalNeto = $douTotalNeto + $arNomina['neto'];
                        $strSql = "SELECT denomina.nrohora FROM denomina WHERE consecutivo = " . $arNomina['consecutivo'] . " AND codsala= '01'";                
                        $arDenominas = $servidorJG->query($strSql);
                        $arDenomina = $arDenominas->fetch_assoc();                        
                        echo "<tr>";
                        echo "<td><a href='verNominaDetalleConceptos.php?consecutivo=" . $arNomina['consecutivo'] . "'>" . $arNomina['consecutivo'] . "</a></td>";
                        echo "<td>" . $arNomina['cedemple'] . "</td>";
                        echo "<td>" . $arNomina['nombre_corto'] . "</td>";
                        echo "<td>" . $arNomina['desde'] . "</td>";
                        echo "<td>" . $arNomina['hasta'] . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['pagado'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['neto'], 0, ',', '') . "</td>";
                        echo "<td>" . $arDenomina['nrohora'] . "</td>";                        
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
            <caption>Incapacidades licencias</caption>
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
                $strExcluir = " AND codsala <> '75' AND codsala <> '31' AND codsala <> '60' AND codsala <> '18' AND codsala <> '16' AND codsala <> '84' AND codsala <> '64' AND codsala <> '32' AND codsala <> '26' AND codsala <> '65' AND codsala <> '63' AND codsala <> '25' AND codsala <> '24' AND codsala <> '03' AND codsala <> '86'";
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
            <caption>Bonos</caption>
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
                //Bonos
                $strExcluir = " AND codsala <> '94' AND codsala <> '31' AND codsala <> '92' AND codsala <> '75' AND codsala <> '60' AND codsala <> '16' AND codsala <> '18' AND codsala <> '84' AND codsala <> '32' AND codsala <> '95' AND codsala <> '12' AND codsala <> '26' AND codsala <> '65' AND codsala <> '63' AND codsala <> '25' AND codsala <> '24' AND codsala <> '03' AND codsala <> '86'";
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
            <caption>Tiempo suplementario</caption>
            <thead>
                <tr>
                    <th>codsala</th>
                    <th>Concepto</th>
                    <th>Abreviatura</th>
                    <th>Subtipo</th>
                    <th>Horas</th>
                    <th>Valor</th>
                    <th>Deduccion</th>
                    <th>Empleado</th>
                    <th>Cedula</th>                    
                </tr>
            </thead>
            <tbody>                
                <?php
                //Tiempo suplementario
                $strExcluir = " AND codsala <> '12' AND codsala <> '94' AND codsala <> '31' AND codsala <> '92' AND codsala <> '75' AND codsala <> '60' AND codsala <> '84' AND codsala <> '64' AND codsala <> '32' AND codsala <> '26' AND codsala <> '65' AND codsala <> '63' AND codsala <> '25' AND codsala <> '24' AND codsala <> '86'";
                $strSql = "SELECT sql_migracion_tiempo_suplementario.* FROM sql_migracion_tiempo_suplementario WHERE codigo = '" . $_GET['codigo'] . "'" . $strExcluir . " ORDER BY abreviatura, desala, nombre_corto";
                $arNominas = $servidorJG->query($strSql);

                if ($arNominas->num_rows > 0) {
                    while ($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $arNomina['codsala'] . "</td>";
                        echo "<td>" . $arNomina['desala'] . "</td>";
                        echo "<td>" . $arNomina['abreviatura'] . "</td>";
                        echo "<td>" . $arNomina['subtipo'] . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['nrohora'], 1, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['salario'], 0, ',', '.') . "</td>";
                        echo "<td style='text-align: right'>" . number_format($arNomina['deduccion'] * -1, 0, ',', '') . "</td>";
                        echo "<td>" . $arNomina['nombre_corto'] . "</td>";
                        echo "<td>" . $arNomina['cedemple'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "0 tiempo suplementario";
                }
                $arNominas->close();
                ?>                   
            </tbody>            
        </table>   <br /> <br />       
        <?php        
        $arNominas = $servidorJG->query($strSql);
        if ($arNominas->num_rows > 0) {
            while ($arNomina = $arNominas->fetch_assoc()) {
                $strSql = "SELECT rhu_pago_adicional_subtipo.* FROM rhu_pago_adicional_subtipo WHERE codigo_pago_adicional_subtipo_pk = " . $arNomina['subtipo'];                
                $arPagoAdicionalSubtipos = $servidorBrasa->query($strSql);
                $arPagoAdicionalSubtipo = $arPagoAdicionalSubtipos->fetch_assoc();
                $arEmpleados = $servidorBrasa->query("SELECT rhu_empleado.* FROM rhu_empleado WHERE numero_identificacion = '" . $arNomina['cedemple'] . "'");
                $arEmpleado = $arEmpleados->fetch_assoc();                
                echo "INSERT INTO rhu_pago_adicional (codigo_pago_concepto_fk, codigo_empleado_fk, cantidad, codigo_centro_costo_fk, codigo_pago_adicional_tipo_fk, codigo_pago_adicional_subtipo_fk) "
                . "VALUES (" . $arPagoAdicionalSubtipo['codigo_pago_concepto_fk'] . ", " . $arEmpleado['codigo_empleado_pk'] . ", " . $arNomina['nrohora'] . ", " . $arEmpleado['codigo_centro_costo_fk'] . ", " . $arPagoAdicionalSubtipo['codigo_pago_adicional_tipo_fk'] . ", " . $arPagoAdicionalSubtipo['codigo_pago_adicional_subtipo_pk'] . ");" . "<br />";
            }
        } else {
                    echo "0 suplementario exportar";
                }
        $arNominas->close();
        ?>        
        <table border="1">
            <caption>Descuentos, bonificaciones a exportar</caption>
            <thead>
                <tr>
                    <th>codsala</th>
                    <th>Concepto</th>
                    <th>Abreviatura</th>
                    <th>Subtipo</th>
                    <th>Horas</th>
                    <th>Valor</th>
                    <th>Deduccion</th>
                    <th>Empleado</th>
                    <th>Cedula</th>                    
                </tr>
            </thead>
            <tbody>                
                <?php
                $strExcluir = " AND codsala <> '60' AND codsala <> '94' AND codsala <> '92' AND codsala <> '03' AND codsala <> '16' AND codsala <> '18' AND codsala <> '12' AND codsala <> '64' AND codsala <> '95'";
                $strSql = "SELECT sql_migracion_tiempo_suplementario.* FROM sql_migracion_tiempo_suplementario WHERE codigo = '" . $_GET['codigo'] . "'" . $strExcluir . " ORDER BY abreviatura, desala, nombre_corto";
                $arNominas = $servidorJG->query($strSql);
                if ($arNominas->num_rows > 0) {
                    while ($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $arNomina['codsala'] . "</td>";
                        echo "<td>" . $arNomina['desala'] . "</td>";
                        echo "<td>" . $arNomina['abreviatura'] . "</td>";
                        echo "<td>" . $arNomina['subtipo'] . "</td>";
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
                ?>                   
            </tbody>            
        </table>   <br /> <br />                
        
        <?php        
        $arNominas = $servidorJG->query($strSql);
        if ($arNominas->num_rows > 0) {
            while ($arNomina = $arNominas->fetch_assoc()) {
                $strSql = "SELECT rhu_pago_adicional_subtipo.* FROM rhu_pago_adicional_subtipo WHERE codigo_pago_adicional_subtipo_pk = " . $arNomina['subtipo'];                
                $arPagoAdicionalSubtipos = $servidorBrasa->query($strSql);
                $arPagoAdicionalSubtipo = $arPagoAdicionalSubtipos->fetch_assoc();
                $arEmpleados = $servidorBrasa->query("SELECT rhu_empleado.* FROM rhu_empleado WHERE numero_identificacion = '" . $arNomina['cedemple'] . "'");
                $arEmpleado = $arEmpleados->fetch_assoc(); 
                if($arNomina['abreviatura'] == '1BONI' || $arNomina['abreviatura'] == '3COMI') {
                    $douValor = $arNomina['salario'];
                }
                if($arNomina['abreviatura'] == '2DCTO') {
                    $douValor = $arNomina['deduccion'] * -1;
                }                
                echo "INSERT INTO rhu_pago_adicional (codigo_pago_concepto_fk, codigo_empleado_fk, valor, codigo_centro_costo_fk, codigo_pago_adicional_tipo_fk, codigo_pago_adicional_subtipo_fk) "
                . "VALUES (" . $arPagoAdicionalSubtipo['codigo_pago_concepto_fk'] . ", " . $arEmpleado['codigo_empleado_pk'] . ", " . $douValor . ", " . $arEmpleado['codigo_centro_costo_fk'] . ", " . $arPagoAdicionalSubtipo['codigo_pago_adicional_tipo_fk'] . ", " . $arPagoAdicionalSubtipo['codigo_pago_adicional_subtipo_pk'] . ");" . "<br />";
            }
        } 
        $arNominas->close();
        ?>
        <br /> <br />
        <table border="1">
            <caption>Creditos</caption>
            <thead>
                <tr>
                    <th>codsala</th>
                    <th>Concepto</th>
                    <th>Abreviatura</th>
                    <th>Subtipo</th>
                    <th>Horas</th>
                    <th>Valor</th>
                    <th>Deduccion</th>
                    <th>Empleado</th>
                    <th>Cedula</th>                    
                </tr>
            </thead>
            <tbody>                
                <?php
                $strExcluir = " AND codsala <> '86' AND codsala <> '65' AND codsala <> '75' AND codsala <> '24' AND codsala <> '31' AND codsala <> '94' AND codsala <> '92' AND codsala <> '03' AND codsala <> '16' AND codsala <> '18' AND codsala <> '12' AND codsala <> '64' AND codsala <> '95'";
                $strSql = "SELECT sql_migracion_tiempo_suplementario.* FROM sql_migracion_tiempo_suplementario WHERE codigo = '" . $_GET['codigo'] . "'" . $strExcluir . " ORDER BY abreviatura, desala, nombre_corto";
                $arNominas = $servidorJG->query($strSql);
                if ($arNominas->num_rows > 0) {
                    while ($arNomina = $arNominas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $arNomina['codsala'] . "</td>";
                        echo "<td>" . $arNomina['desala'] . "</td>";
                        echo "<td>" . $arNomina['abreviatura'] . "</td>";
                        echo "<td>" . $arNomina['subtipo'] . "</td>";
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
                ?>                   
            </tbody>            
        </table>   <br /> <br />         
    </body>
</html>

