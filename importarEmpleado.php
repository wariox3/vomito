<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Importar empleado</title>
    </head>
    <body>
        <h1>Importar empleado</h1>
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
        
        $strSql = "SELECT sql_migracion_empleados.* FROM sql_migracion_empleados WHERE 1";
        $arEmpleados = $servidorJG->query($strSql);

        if ($arEmpleados->num_rows > 0) {
            while($arEmpleado = $arEmpleados->fetch_assoc()) {
                $arCentrosCostos = $servidorBrasa->query("SELECT codigo_centro_costo_pk FROM rhu_centro_costo WHERE codigo_interface = '" . $arEmpleado['codzona'] . "'");
                $arCentroCosto = $arCentrosCostos->fetch_assoc();
                $codigoCentroCostos = $arCentroCosto['codigo_centro_costo_pk'];
                $arCentros = $servidorJG->query("SELECT centro.cedemple, decentro.codsala FROM decentro LEFT JOIN centro ON decentro.codcentro = centro.codcentro WHERE decentro.codsala = 20 AND cedemple='" . $arEmpleado['numero_identificacion'] . "'");
                $boolAuxTransporte = 0;
                if($arCentros->num_rows > 0) {
                    $boolAuxTransporte = 1;
                }                                                   
                $strInsertar = "INSERT INTO rhu_empleado "
                    . " (codigo_centro_costo_fk, numero_identificacion, nombre_corto, nombre1, nombre2, apellido1, apellido2, telefono, celular, direccion, barrio, codigo_rh_fk, "
                        . "codigo_sexo_fk, correo, fecha_nacimiento, cuenta, codigo_banco_fk, codigo_entidad_salud_fk, codigo_entidad_pension_fk, estado_activo, codigo_clasificacion_riesgo_fk, codigo_tipo_identificacion_fk, codigo_estado_civil_fk, auxilio_transporte) "
                    . "  VALUES (" . $codigoCentroCostos . ", '" . $arEmpleado['numero_identificacion'] . "', '" . $arEmpleado['nombre_corto'] . "', '" . $arEmpleado['nombre1'] . "', '" . $arEmpleado['nombre2'] . "', '" . $arEmpleado['apellido1'] . "', '" . $arEmpleado['apellido2'] . "', '" . $arEmpleado['telefono'] . "', '" . $arEmpleado['celular'] . "', '" . $arEmpleado['direccion'] . "', '" . $arEmpleado['barrio'] . "', '" . $arEmpleado['rh'] . "', "
                        . "'" . $arEmpleado['codigo_sexo_fk'] . "', '" . $arEmpleado['correo'] . "', '" . $arEmpleado['fecha_nacimiento'] . "', '" . $arEmpleado['cuenta'] . "', " . $arEmpleado['codigo_banco_fk'] . ", " . $arEmpleado['codigo_entidad_salud_fk'] . ", " . $arEmpleado['codigo_entidad_pension_fk'] . ", 0, " . $arEmpleado['codigo_clasificacion_riesgo_fk'] . ", '" . $arEmpleado['codigo_tipo_identificacion_fk'] . "', '" . $arEmpleado['codigo_estado_civil_fk'] . "', " . $boolAuxTransporte . ")";
                if ($servidorBrasa->query($strInsertar) === TRUE) {
                    $strActMigracion = "UPDATE empleado SET exportado_migracion = 1 WHERE cedemple = '" . $arEmpleado['numero_identificacion'] . "'";
                    if ($servidorJG->query($strActMigracion) === TRUE) {
                        //echo "";
                    } else {
                        echo "Error: " . $arEmpleado['numero_identificacion'] . ":" .$servidorJG->error . "<br />";
                    }                    
                } else {
                    echo "Error: " . $arEmpleado['numero_identificacion'] . ":" .$servidorBrasa->error . "<br />";
                }  
            }
        } else {
            echo "0 results";
        }        
        $arEmpleados->close(); 
        
        $strSql = "SELECT retiroprovision.* FROM retiroprovision WHERE estado='ACTIVO' and exportado_migracion = 0";
        $arRetiros = $servidorJG->query($strSql);

        if ($arRetiros->num_rows > 0) {
            while($arRetiro = $arRetiros->fetch_assoc()) {                                                   
                $strActualizar = "UPDATE rhu_empleado SET fecha_finaliza_contrato = '" . $arRetiro['fechare'] . "', contrato_indefinido = 0 WHERE numero_identificacion ='" . $arRetiro['cedemple'] . "'";
                if ($servidorBrasa->query($strActualizar) === TRUE) {
                    $strActMigracion = "UPDATE retiroprovision SET exportado_migracion = 1 WHERE codretiro = '" . $arRetiro['codretiro'] . "'";
                    $servidorJG->query($strActMigracion);
                } else {
                    echo "Error: actualizando retiros" .$servidorBrasa->error . "<br />";
                }  
            }
        } else {
            echo "0 results";
        }        
        $arRetiros->close();         
        
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>
    </body>
</html>

