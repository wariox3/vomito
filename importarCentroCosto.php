<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Centro costo</title>
    </head>
    <body>
        <h1>Importar centro costo</h1>
        <?php
        /*$servidorBrasa = new mysqli("192.168.10.152", "jgmysql", "yuij. 487.", "bdbrasa");
        if ($servidorBrasa->connect_error) {
            die("Connection failed: " . $servidorBrasa->connect_error);
        } 
        
        $servidorJG = new mysqli("192.168.10.26", "jgmysql", "$4cc3t0/.", "jgefectivo");
        if ($servidorJG->connect_error) {
            die("Connection failed: " . $ervidorJG->connect_error);
        }
        
        $strSql = "SELECT
                    zona.zona AS nombre,
                    zona.codzona AS codigo_interface,
                    '0' AS pago_abierto,
                    '0' AS generar_pago_automatico,
                    lower(emailzona) AS correo,
                    admon AS valor_administracion,
                    datos AS porcentaje_administracion,
                    '3' AS codigo_tercero_fk,
                    IF(estado = 'ACTIVA', 1, 0) AS etado_activo,
                    IF(pnomina = 'SEMANAL', 1, IF(pnomina='DECADAL', 2, IF(pnomina='CATORCENAL',3, IF(pnomina='QUINCENAL', 4, IF(pnomina='MENSUAL', 5, 4))))) as codigo_periodo_pago_fk
                FROM
                    `zona`
                LEFT JOIN detalladozona ON zona.codzona = detalladozona.codzona";
        $arZonas = $servidorJG->query($strSql);

        if ($arZonas->num_rows > 0) {
            while($arZona = $arZonas->fetch_assoc()) {
                $strInsertar = "INSERT INTO rhu_centro_costo "
                    . " (`codigo_periodo_pago_fk`, `nombre`, `fecha_ultimo_pago_programado`, `pago_abierto`, `estado_activo`, `generar_pago_automatico`, `codigo_tercero_fk`, `porcentaje_administracion`, `valor_administracion`, `correo`, `codigo_interface`) "
                    . "  VALUES (" . $arZona['codigo_periodo_pago_fk'] . ", '" . $arZona['nombre'] . "', '2015-04-30', 0, " . $arZona['codigo_periodo_pago_fk'] . ", 0, 3, " . $arZona['porcentaje_administracion'] . ", " . $arZona['valor_administracion'] . ", '" . $arZona['correo'] . "', '" . $arZona['codigo_interface'] . "')" or die("Error in the consult.." . mysqli_error($serverBrasa));
                if ($servidorBrasa->query($strInsertar) === TRUE) {
                    echo "Creado:" . $arZona['nombre'] . "<br />";
                } else {
                    echo "Error: " . $strInsertar . "<br>" . $conn->error;
                }                
            }
        } else {
            echo "0 results";
        }
        $arZonas->close(); */       
        ?>
    </body>
</html>

