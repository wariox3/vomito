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
        include("conexion.php");               
        
        $strSql = "SELECT sql_migracion_contratos.* FROM sql_migracion_contratos WHERE exportado_migracion = 0 limit 10";
        $arContatos = $servidorJG->query($strSql);

        if ($arContatos->num_rows > 0) {
            while($arContrato = $arContatos->fetch_assoc()) {
                $arEmpleados = $servidorBrasa->query("SELECT codigo_empleado_pk FROM rhu_empleado WHERE numero_identificacion = '" . $arContrato['cedemple'] . "'");
                $arEmpleado = $arEmpleados->fetch_assoc();                
                $strInsertar = "INSERT INTO rhu_contrato "
                    . " (codigo_empleado_fk, fecha, fecha_desde, fecha_hasta, numero, vr_salario, estado_activo, comentarios, codigo_tipo_tiempo_fk, codigo_centro_costo_fk) "                        
                    . "  VALUES (" . $arEmpleado['codigo_empleado_pk'] . ", '2015-05-08', '" . $arContrato['fechainic'] . "', '" . $arContrato['fechater'] . "', '" . $arContrato['contrato'] . "', " . $arContrato['salario'] . ", " . $arContrato['estado_activo'] . ", '" . $arContrato['nota'] . "', " . $arContrato['codigo_tipo_tiempo_fk'] . ", " . $arContrato['codigo_interface_migracion'] . ")";
                
                /*if ($servidorBrasa->query($strInsertar) === TRUE) {
                    $strActMigracion = "UPDATE contrato SET exportado_migracion = 1 WHERE contrato.contrato = '" . $arContrato['contrato'] . "'";
                    $servidorJG->query($strActMigracion);
                } else {
                    echo "Error: " . $arContrato['contrato'] . ":" .$servidorBrasa->error . "<br />";
                }*/            
            }
            //Actualizar los estados
            /*$strActualizar = "update rhu_contrato set estado_activo = 0  where fecha_hasta < NOW() AND fecha_hasta <> '0000-00-00'";
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
            }*/            
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

