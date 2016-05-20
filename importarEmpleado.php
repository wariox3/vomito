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
        include("conexion.php");
        
        $strSql = "SELECT empleado.*, eps.codigo_interface_pila as pila_salud, pension.codigo_interface_pila as pila_pension FROM empleado "
                . "LEFT JOIN eps ON empleado.codeps = eps.codeps "
                . "LEFT JOIN pension ON empleado.codpension = pension.codpension "
                . "WHERE 1 ORDER BY codemple DESC LIMIT 1000";
        $arEmpleados = $servidorJG->query($strSql);
        $i = 1;
        if ($arEmpleados->num_rows > 0) {
            while($arEmpleado = $arEmpleados->fetch_assoc()) {
                $arEntidadesSalud = $servidorBrasa->query("SELECT codigo_entidad_salud_pk FROM rhu_entidad_salud WHERE codigo_interface = '" . $arEmpleado['pila_salud'] . "'");
                $arEntidadSalud = $arEntidadesSalud->fetch_assoc();
                $codigoEntidadSalud = $arEntidadSalud['codigo_entidad_salud_pk'];

                $arEntidadesPension = $servidorBrasa->query("SELECT codigo_entidad_pension_pk FROM rhu_entidad_pension WHERE codigo_interface = '" . $arEmpleado['pila_pension'] . "'");
                $arEntidadPension = $arEntidadesPension->fetch_assoc();
                $codigoEntidadPension = $arEntidadPension['codigo_entidad_pension_pk'];                
                
                $strNombreCorto = $arEmpleado['nomemple'] . " " . $arEmpleado['nomemple1'] . " " . $arEmpleado['apemple'] . " " . $arEmpleado['apemple1'];
                $strInsertar = "INSERT INTO rhu_empleado "
                    . " (codigo_empleado_pk, numero_identificacion, nombre_corto, nombre1, nombre2, apellido1, apellido2, telefono, celular, direccion, barrio, correo, fecha_nacimiento, cuenta, codigo_entidad_salud_fk, codigo_entidad_pension_fk, "
                        . "codigo_centro_costo_fk, codigo_tipo_tiempo_fk, vr_salario, fecha_contrato, fecha_finaliza_contrato, codigo_clasificacion_riesgo_fk, codigo_cargo_fk, cargo_descripcion, codigo_tipo_pension_fk, codigo_tipo_cotizante_fk, codigo_subtipo_cotizante_fk, auxilio_transporte) "
                    . "  VALUES (". $i . ",'" . $arEmpleado['cedemple'] . "', '" . $strNombreCorto . "', '" . $arEmpleado['nomemple'] . "', '" . $arEmpleado['nomemple1'] . "', '" . $arEmpleado['apemple'] . "', '" . $arEmpleado['apemple1'] . "', '" . $arEmpleado['telemple'] . "', '" . $arEmpleado['celular'] . "', '" . $arEmpleado['diremple'] . "', '" . $arEmpleado['municipio'] . "', '" . $arEmpleado['email'] . "', '" . $arEmpleado['fechanac'] . "', '" . $arEmpleado['cuenta'] . "', " . $codigoEntidadSalud . ", " . $codigoEntidadPension . ", "
                        . "612, 1, 644350, '2015-01-01', '2015-01-01', 1, 16, 'ANALISTA', 1, 1, 0, 1)";
                //echo $strInsertar . "<br/>"; 
                if ($servidorBrasa->query($strInsertar) === TRUE) {                      
                    echo $arEmpleado['cedemple'] . "<br/>";  
                    $strInsertar = "insert into rhu_contrato (codigo_empleado_fk, fecha, fecha_desde, fecha_hasta, numero, vr_salario, estado_activo, comentarios, indefinido, codigo_tipo_tiempo_fk, codigo_centro_costo_fk, codigo_contrato_tipo_fk, codigo_clasificacion_riesgo_fk, cargo_descripcion, codigo_cargo_fk, codigo_tipo_pension_fk, fecha_ultimo_pago_cesantias, fecha_ultimo_pago_vacaciones, fecha_ultimo_pago_primas, fecha_ultimo_pago, estado_liquidado, vr_salario_pago, factor, factor_horas_dia, codigo_tipo_cotizante_fk, codigo_subtipo_cotizante_fk, horario_trabajo) "
                            . "values(" . $i . ",'2015-01-01','2015-01-01','2015-01-01','001','644350','1',NULL,'1','1','612','1','1','ANALISTA','16','1','2015-01-01','2015-01-01','2015-01-01','2014-12-31','0','644350','0','8','1','0','HORARIO FIJO')";
                    if ($servidorBrasa->query($strInsertar) === TRUE) {
                        echo "Insertado el contrato<br/>";                          
                    }
                } else {
                    echo "Error: " . $arEmpleado['cedemple'] . ":" .$servidorBrasa->error . "<br />";
                }
                $i++;
            }
            $strSqlActualizar = "UPDATE rhu_empleado SET "
                    . "codigo_estado_civil_fk = 'S', "
                    . "codigo_rh_fk = 2,"
                    . "codigo_entidad_caja_fk = 3";
            if ($servidorBrasa->query($strSqlActualizar) === TRUE) {
                echo "Registros actualizados";
            }            
        } else {
            echo "0 results";
        }        
        $arEmpleados->close();                
        
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>
    </body>
</html>

