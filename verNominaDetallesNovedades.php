<table border="1">
    <caption>Licencias, incapaciadades, suspenciones</caption>
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
        $strSql = "SELECT sql_migracion_nomina_detalles.* FROM sql_migracion_nomina_detalles WHERE codigo = '" . $_GET['codigo'] . "' AND (abreviatura = '0LICE' OR abreviatura = '0INCA') ORDER BY abreviatura";
        $arDetalles = $servidorJG->query($strSql);
        $strNovedadesIncapacidades = "";
        $strNovedadesLicencias = "";
        $intHorasAdicionales = 0;
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
                $arEmpleados = $servidorBrasa->query("SELECT rhu_empleado.* FROM rhu_empleado WHERE numero_identificacion = '" . $arDetalle['cedemple'] . "'");
                $arEmpleado = $arEmpleados->fetch_assoc();                    
                if($arDetalle['abreviatura'] == '0INCA') {
                    $strNovedadesIncapacidades = $strNovedadesIncapacidades . "INSERT INTO rhu_incapacidad (codigo_empleado_fk, cantidad, cantidad_pendiente, codigo_centro_costo_fk, codigo_pago_adicional_subtipo_fk, codigo_incapacidad_diagnostico_fk) "
                    . "VALUES (" . $arEmpleado['codigo_empleado_pk'] . ", " . $arDetalle['nrohora'] . ", " . $arDetalle['nrohora'] . " , " . $arEmpleado['codigo_centro_costo_fk'] . ", " . $arDetalle['subtipo'] . ", 12630);" . "<br />";                                                    
                }
                if($arDetalle['abreviatura'] == '0LICE') {                
                    $strNovedadesLicencias = $strNovedadesLicencias . "INSERT INTO rhu_licencia (codigo_empleado_fk, cantidad, cantidad_pendiente, codigo_centro_costo_fk, codigo_pago_adicional_subtipo_fk, afecta_transporte) "
                    . "VALUES (" . $arEmpleado['codigo_empleado_pk'] . ", " . $arDetalle['nrohora'] . ", " . $arDetalle['nrohora'] . " , " . $arEmpleado['codigo_centro_costo_fk'] . ", " . $arDetalle['subtipo'] . ", 1);" . "<br />";                                                                        
                }
                $intHorasAdicionales = $intHorasAdicionales + $arDetalle['nrohora'];

            }
            echo "<tr>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "<td style='text-align: right'>" . number_format($intHorasAdicionales, 1, ',', '.') . "</td>";
            echo "<td style='text-align: right'></td>";
            echo "<td style='text-align: right'></td>";
            echo "<td></td>";
            echo "<td></td>";
            echo "</tr>";             
        } else {
            echo "0 results";
        }
        $arDetalles->close();
        ?>                   
    </tbody>            
</table>   <br /> <br />