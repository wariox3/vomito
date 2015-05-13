<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Importar contrato</title>
    </head>
    <body>
        <h1>Importar contrato</h1>
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
        
        $strSql = "SELECT sql_migracion_contratos.* FROM sql_migracion_contratos WHERE 1";
        $arContatos = $servidorJG->query($strSql);

        if ($arContatos->num_rows > 0) {
            while($arContrato = $arContatos->fetch_assoc()) {
                $arEmpleados = $servidorBrasa->query("SELECT codigo_empleado_pk FROM rhu_empleado WHERE numero_identificacion = '" . $arContrato['cedemple'] . "'");
                $arEmpleado = $arEmpleados->fetch_assoc();
                $codigoEmpleado = $arEmpleado['codigo_empleado_pk'];
                
                $strInsertar = "INSERT INTO rhu_contrato "
                    . " (codigo_empleado_fk, fecha, fecha_desde, fecha_hasta, numero, vr_salario, estado_activo, comentarios, codigo_tipo_tiempo_fk) "                        
                    . "  VALUES (" . $codigoEmpleado . ", '2015-05-08', '" . $arContrato['fechainic'] . "', '" . $arContrato['fechater'] . "', '" . $arContrato['contrato'] . "', " . $arContrato['salario'] . ", " . $arContrato['estado_activo'] . ", '" . $arContrato['nota'] . "', " . $arContrato['codigo_tipo_tiempo_fk'] . ")";
                if ($servidorBrasa->query($strInsertar) === TRUE) {
                    $strActMigracion = "UPDATE contrato SET exportado_migracion = 1 WHERE contrato.contrato = '" . $arContrato['contrato'] . "'";
                    $servidorJG->query($strActMigracion);
                } else {
                    echo "Error: " . $arContrato['contrato'] . ":" .$servidorBrasa->error . "<br />";
                }            
            }
            //Actualizar los estados
            $strActualizar = "update rhu_contrato set estado_activo = 0  where fecha_hasta < NOW() AND fecha_hasta <> '0000-00-00'";
            $strActualizar2 = "update rhu_contrato set fecha_hasta = fecha_desde, indefinido = 1  where fecha_hasta = '0000-00-00'";
            if ($servidorBrasa->query($strActualizar) === TRUE && $servidorBrasa->query($strActualizar2) === TRUE) {
                echo "Se creacion y actualizaron correctamente los contratos <br />";
                $strActualizar = "UPDATE  rhu_empleado 
                                    LEFT JOIN rhu_contrato ON rhu_empleado.codigo_empleado_pk = rhu_contrato.codigo_empleado_fk 
                                    SET rhu_empleado.estado_activo = 1, rhu_empleado.contrato_indefinido = 1, rhu_empleado.fecha_contrato = rhu_contrato.fecha_desde,
                                    rhu_empleado.fecha_finaliza_contrato = rhu_contrato.fecha_hasta, rhu_empleado.vr_salario = rhu_contrato.vr_salario, rhu_empleado.codigo_tipo_tiempo_fk = rhu_contrato.codigo_tipo_tiempo_fk   
                                    WHERE rhu_contrato.estado_activo = 1";
                if ($servidorBrasa->query($strActualizar) === TRUE) {
                    echo "Se creacion y actualizaron correctamente los empleados <br />";
                } else {
                    echo "Error en la actualizacion de empleados:" .$servidorBrasa->error . "<br />";
                }                 
            } else {
                echo "Error en la actualizacion de contratos:" .$servidorBrasa->error . "<br />";
            }            
        } else {
            echo "0 results";
        }
        $arContatos->close();
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>
    </body>
</html>

