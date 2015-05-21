<table border="1">
    <caption>Items sin clasificar</caption>
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
        $strSql = "SELECT sql_migracion_nomina_detalles.* FROM sql_migracion_nomina_detalles WHERE codigo = '" . $_GET['codigo'] . "' AND abreviatura IS NULL";
        $arDetalles = $servidorJG->query($strSql);
        if ($arDetalles->num_rows > 0) {
            while ($arDetalle = $arDetalles->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $arDetalle['codsala'] . "</td>";
                echo "<td>" . $arDetalle['desala'] . "</td>";
                echo "<td>" . $arDetalle['abreviatura'] . "</td>";
                echo "<td style='text-align: right'>" . number_format($arDetalle['nrohora'], 1, ',', '.') . "</td>";
                echo "<td style='text-align: right'>" . number_format($arDetalle['salario'], 0, ',', '.') . "</td>";
                echo "<td style='text-align: right'>" . number_format($arDetalle['deduccion'] * -1, 0, ',', '') . "</td>";
                echo "<td>" . $arDetalle['nombre_corto'] . "</td>";
                echo "<td>" . $arDetalle['cedemple'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $arDetalles->close();
        ?>                   
    </tbody>            
</table>   <br /> <br />