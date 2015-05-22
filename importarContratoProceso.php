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
        
        $strSql = "SELECT sql_migracion_contratos.* FROM sql_migracion_contratos WHERE codigo_interface_migracion is not null";
        $arContatos = $servidorJG->query($strSql);

        if ($arContatos->num_rows > 0) {
            while($arContrato = $arContatos->fetch_assoc()) {
                if($arContrato['codigo_interface_migracion'] != "") {
                    $arEmpleados = $servidorBrasa->query("SELECT codigo_empleado_pk FROM rhu_empleado WHERE numero_identificacion = '" . $arContrato['cedemple'] . "'");
                    $arEmpleado = $arEmpleados->fetch_assoc();                
                    $strInsertar = "INSERT INTO rhu_contrato "
                        . " (codigo_empleado_fk, fecha, fecha_desde, fecha_hasta, numero, vr_salario, estado_activo, comentarios, codigo_tipo_tiempo_fk, codigo_centro_costo_fk) "                        
                        . "  VALUES (" . $arEmpleado['codigo_empleado_pk'] . ", '2015-05-08', '" . $arContrato['fechainic'] . "', '" . $arContrato['fechater'] . "', '" . $arContrato['contrato'] . "', " . $arContrato['salario'] . ", " . $arContrato['estado_activo'] . ", '" . $arContrato['nota'] . "', " . $arContrato['codigo_tipo_tiempo_fk'] . ", " . $arContrato['codigo_interface_migracion'] . ")";

                    if ($servidorBrasa->query($strInsertar) === TRUE) {
                        $strActMigracion = "UPDATE contrato SET exportado_migracion = 1 WHERE contrato.contrato = '" . $arContrato['contrato'] . "'";
                        $servidorJG->query($strActMigracion);
                    } else {
                        echo "Error: " . $arContrato['contrato'] . ":" . $strInsertar . " Descripcion: " .$servidorBrasa->error . "<br />";
                    }                       
                }        
            }            
        } else {
            echo "0 results <br />";
        }
        //Actualizar las fechas de terminacion
        $strSql = "SELECT rhu_contrato.* FROM rhu_contrato WHERE indefinido = 1";
        $arContatos = $servidorBrasa->query($strSql);                    
        if ($arContatos->num_rows > 0) {
            while($arContrato = $arContatos->fetch_assoc()) {                
                $arContratosJG = $servidorJG->query("SELECT fechater FROM contrato WHERE contrato = '" . $arContrato['numero'] . "'");
                $arContratoJG = $arContratosJG->fetch_assoc();                     
                if($arContratoJG['fechater'] != '0000-00-00') {                        
                    $strActContratoBrasa = "UPDATE rhu_contrato SET indefinido = 0, estado_activo = 0, fecha_hasta = '" . $arContratoJG['fechater'] . "' WHERE codigo_contrato_pk = " . $arContrato['codigo_contrato_pk'];
                    $servidorBrasa->query($strActContratoBrasa);                        
                }
            }
        }
        //Actualizar los estados
        $strActualizar = "update rhu_contrato set estado_activo = 0  where fecha_hasta < NOW() AND fecha_hasta <> '0000-00-00'";
        $strActualizar2 = "update rhu_contrato set fecha_hasta = fecha_desde, indefinido = 1  where fecha_hasta = '0000-00-00'";
        $servidorBrasa->query($strActualizar);
        $servidorBrasa->query($strActualizar2);        
        $arContatos->close();
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>                
    </body>
</html>

