
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
            <th>Adic</th>
        </tr>
    </thead>
    <tbody>                
        <?php
        $strCodigo = $_GET['codigo'];        
        $strSqlNominaDetalle = "SELECT sql_migracion_pago_nomina_detalle.* FROM sql_migracion_pago_nomina_detalle WHERE codigo = '" . $_GET['codigo'] . "'";
        $arNominas = $servidorJG->query($strSqlNominaDetalle);
        $strTiempoLaborado = "";
        $douTotalNeto = 0;
        $intNumero = 0;
        $intHorasAdicionales = 0;
        if ($arNominas->num_rows > 0) {
            while ($arNomina = $arNominas->fetch_assoc()) {
                $douTotalNeto = $douTotalNeto + $arNomina['neto'];
                $intNumero++;
                echo "<tr>";
                echo "<td><a href='verNominaDetalleConceptos.php?consecutivo=" . $arNomina['consecutivo'] . "'>" . $arNomina['consecutivo'] . "</a></td>";
                echo "<td>" . $arNomina['cedemple'] . "</td>";
                echo "<td>" . $arNomina['nombre_corto'] . "</td>";
                echo "<td>" . $arNomina['desde'] . "</td>";
                echo "<td>" . $arNomina['hasta'] . "</td>";
                echo "<td style='text-align: right'>" . number_format($arNomina['pagado'], 0, ',', '.') . "</td>";
                echo "<td style='text-align: right'>" . number_format($arNomina['neto'], 0, ',', '') . "</td>";
                echo "<td>" . $arNomina['nrohorasdiurnas'] . "</td>";   
                echo "<td>" . $arNomina['nrohorasadic'] . "</td>";                   
                if($arNomina['nrohorasadic'] > 0) {
                   $intHorasAdicionales = $intHorasAdicionales + $arNomina['nrohorasadic'];
                }
                if($arNomina['nrohorasadic']+$arNomina['nrohorasdiurnas'] != 120) {
                    $strTiempoLaborado = $strTiempoLaborado . "UPDATE rhu_empleado SET horas_laboradas_periodo = " . ($arNomina['nrohorasadic'] + $arNomina['nrohorasdiurnas']) . " WHERE numero_identificacion = " . $arNomina['cedemple'] . ";#" . $arNomina['cedemple'] . "<br />";
                }
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $arNominas->close();
        ?>    
        <?php
        echo "<tr>";
        echo "<td>" . number_format($intNumero, 0, ',', '.') . "</td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td style='text-align: right'></td>";
        echo "<td style='text-align: right'></td>";
        echo "<td style='text-align: right'>" . number_format($douTotalNeto, 0, ',', '.') . "</td>";
        echo "<td></td>";   
        echo "<td>" . $intHorasAdicionales . "</td>";                           
        echo "</tr>";
        ?>                
    </tbody>
</table>   <br /><br /><br />
