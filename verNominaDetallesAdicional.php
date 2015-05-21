<table border="1">
    <caption>Descuentos, bonificaciones, comisiones</caption>
    <thead>
        <tr>
            <th>codsala</th>
            <th>Concepto</th>
            <th>Abreviatura</th>
            <th>tp</th>
            <th>Horas</th>
            <th>Valor</th>
            <th>Deduccion</th>
            <th>Empleado</th>
            <th>Cedula</th>                    
        </tr>
    </thead>
    <tbody>                
        <?php
        $strAdicionales = "";
        $strSql = "SELECT sql_migracion_nomina_detalles.* FROM sql_migracion_nomina_detalles WHERE codigo = '" . $_GET['codigo'] . "' AND (abreviatura = '1BONI' OR abreviatura = '2DCTO' OR abreviatura = '3COMI') ";
        $arDetalles = $servidorJG->query($strSql);
        if ($arDetalles->num_rows > 0) {
            while ($arDetalle = $arDetalles->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $arDetalle['codsala'] . "</td>";
                echo "<td>" . $arDetalle['desala'] . "</td>";
                echo "<td>" . $arDetalle['abreviatura'] . "</td>";
                echo "<td>" . $arDetalle['subtipo'] . "</td>";
                echo "<td style='text-align: right'>" . number_format($arDetalle['nrohora'], 1, ',', '.') . "</td>";
                echo "<td style='text-align: right'>" . number_format($arDetalle['salario'], 0, ',', '.') . "</td>";
                echo "<td style='text-align: right'>" . number_format($arDetalle['deduccion'] * -1, 0, ',', '') . "</td>";
                echo "<td>" . $arDetalle['nombre_corto'] . "</td>";
                echo "<td>" . $arDetalle['cedemple'] . "</td>";
                echo "</tr>";
                $douValor = 0;
                if($arDetalle['abreviatura'] == '1BONI' || $arDetalle['abreviatura'] == '3COMI') {
                    $douValor = $arDetalle['salario'];
                }
                if($arDetalle['abreviatura'] == '2DCTO') {
                    $douValor = $arDetalle['deduccion'] * -1;
                }    
                $arPagoAdicionalSubtipos = $servidorBrasa->query("SELECT rhu_pago_adicional_subtipo.* FROM rhu_pago_adicional_subtipo WHERE codigo_pago_adicional_subtipo_pk = " . $arDetalle['subtipo']);
                $arPagoAdicionalSubtipo = $arPagoAdicionalSubtipos->fetch_assoc();
                $arEmpleados = $servidorBrasa->query("SELECT rhu_empleado.* FROM rhu_empleado WHERE numero_identificacion = '" . $arDetalle['cedemple'] . "'");
                $arEmpleado = $arEmpleados->fetch_assoc();
                $strAdicionales = $strAdicionales . "INSERT INTO rhu_pago_adicional (codigo_pago_concepto_fk, codigo_empleado_fk, valor, codigo_centro_costo_fk, codigo_pago_adicional_tipo_fk, codigo_pago_adicional_subtipo_fk) "
                . "VALUES (" . $arPagoAdicionalSubtipo['codigo_pago_concepto_fk'] . ", " . $arEmpleado['codigo_empleado_pk'] . ", " . $douValor . ", " . $arEmpleado['codigo_centro_costo_fk'] . ", " . $arPagoAdicionalSubtipo['codigo_pago_adicional_tipo_fk'] . ", " . $arPagoAdicionalSubtipo['codigo_pago_adicional_subtipo_pk'] . ");" . "<br />";                
            }
        } else {
            echo "0 results";
        }
        $arDetalles->close();        
        ?>                   
    </tbody>            
</table>   <br /> <br />