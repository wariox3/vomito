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
        
        $strSql = "SELECT empleado.*, zona.codigo_sso_sucursal_fk FROM empleado LEFT JOIN zona ON empleado.codzona = zona.codzona  WHERE 1";
        $arEmpleados = $servidorJG->query($strSql);

        if ($arEmpleados->num_rows > 0) {
            while($arEmpleado = $arEmpleados->fetch_assoc()) {                
                $strActualizar = "UPDATE empleado SET codigo_sso_sucursal_fk = " . $arEmpleado['codigo_sso_sucursal_fk'] . " WHERE codemple = " . $arEmpleado['codemple'];                    
                /*if ($servidorJG->query($strActualizar) === TRUE) {
                    echo "Se actualizo cedula " .$arEmpleado['cedemple'] . "<br />";
                } else {
                    echo "Error: " .$servidorJG->error . "<br />";
                }*/                
            }            
        } else {
            echo "0 results <br />";
        }
        //Actualizar las fechas de terminacion
        /*$strSql = "SELECT rhu_contrato.* FROM rhu_contrato WHERE indefinido = 1";
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
         * 
         */
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>                
    </body>
</html>

