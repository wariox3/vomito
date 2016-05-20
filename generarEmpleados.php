<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Generar empleados</title>
    </head>
    <body>
        <h1>Generar empleados</h1>
        <?php
        set_time_limit(0);
        include("conexion.php");               
        
        for ($i = 1; $i <= 100; $i++) {            
            $strSql = "insert into `rhu_empleado` "
                    . "(`codigo_centro_costo_fk`, `numero_identificacion`, `nombre_corto`, `nombre1`, `nombre2`, `apellido1`, `apellido2`, `telefono`, `celular`, `direccion`, `codigo_ciudad_fk`, `codigo_rh_fk`, `codigo_sexo_fk`, `correo`, `fecha_nacimiento`, `codigo_estado_civil_fk`, `cuenta`, `codigo_banco_fk`, `auxilio_transporte`, `vr_salario`, `codigo_tipo_identificacion_fk`, `codigo_entidad_salud_fk`, `codigo_entidad_pension_fk`, `estado_activo`, `codigo_clasificacion_riesgo_fk`, `fecha_contrato`, `fecha_finaliza_contrato`, `contrato_indefinido`, `pagado_entidad_salud`, `comentarios`, `codigo_tipo_tiempo_fk`, `horas_laboradas_periodo`, `codigo_cargo_fk`, `cargo_descripcion`, `codigo_tipo_pension_fk`, `codigo_entidad_caja_fk`, `barrio`, `padre_familia`, `camisa`, `jeans`, `calzado`, `codigo_ciudad_nacimiento_fk`, `codigo_ciudad_expedicion_fk`, `libreta_militar`, `cabeza_hogar`, `codigo_empleado_estudio_tipo_fk`, `fecha_expedicion_identificacion`) "
                    . "values('612','70000000" . $i . "','NOMBRE COMPLETO " . $i . "','NOMBRE1 " . $i . "','NOMBRE2 " . $i . "','APELLIDO1 " . $i . "','APELLIDO2 " . $i . "',NULL,NULL,NULL,'2239','1','F','CORREO" . $i ."@GMAIL.COM','1985-01-01','C','12354785411','1','1','900000','C','1','1','1','1','2015-07-03','2015-08-21','0','0',NULL,'1','0','2','212312','1','1','123','0',NULL,NULL,NULL,'2239','2239','70142554','0','1','1985-01-01');";            
            if ($servidorBrasa->query($strSql) === TRUE) {
                $strSql = "SELECT codigo_empleado_pk FROM rhu_empleado WHERE numero_identificacion = '70000000" . $i . "'";
                $arEmpleados = $servidorBrasa->query($strSql);
                $arEmpleado = $arEmpleados->fetch_assoc();
                $codigoEmpleado = $arEmpleado['codigo_empleado_pk'];
                $strSql = "insert into `rhu_contrato` "
                        . "(`codigo_empleado_fk`, `fecha`, `fecha_desde`, `fecha_hasta`, `numero`, `vr_salario`, `estado_activo`, `comentarios`, `indefinido`, `codigo_tipo_tiempo_fk`, `codigo_centro_costo_fk`, `codigo_contrato_tipo_fk`, `codigo_clasificacion_riesgo_fk`, `cargo_descripcion`, `codigo_cargo_fk`, `codigo_tipo_pension_fk`, `fecha_ultimo_pago_cesantias`, `fecha_ultimo_pago_vacaciones`, `fecha_ultimo_pago_primas`, `fecha_ultimo_pago`, `estado_liquidado`, `factor`,`factor_horas_dia`, `vr_salario_pago`) "
                        . "values(" . $codigoEmpleado . ",'2015-01-01','2015-01-01','2015-08-21','R123','900000','1',NULL,'1','1','612','1','1','212312','2','1','2015-07-03','2015-07-03','2015-07-03','2014-12-30','0','0','8', '644350');        ";
                  
                if ($servidorBrasa->query($strSql) === TRUE) {
                    echo "Insertado " . $i . "<br />"; 
                } else {
                    echo "Error: " .$servidorBrasa->error . "<br />";
                }
            } else {
                echo "Error: " .$servidorBrasa->error . "<br />";
            }            
        }
        
        
        /*$strSql = "SELECT nomina.* FROM nomina WHERE nomina.fechap >= '2015-06-01' ORDER BY consecutivo DESC";
        $arNominas = $servidorJG->query($strSql);
        if ($arNominas->num_rows > 0) {
            while($arNomina = $arNominas->fetch_assoc()) {                
                $strSql = "SELECT SUM(denomina.salario) as totalSalario FROM denomina LEFT JOIN salario ON denomina.codsala = salario.codsala WHERE consecutivo = '" . $arNomina['consecutivo'] . "' AND salario.suplementario_pila = 1 GROUP BY consecutivo";
                $arDenominas = $servidorJG->query($strSql);
                $arDenomina = $arDenominas->fetch_assoc();
                $floSuplementario = 0;
                if ($arDenominas->num_rows > 0) {
                    $floSuplementario = $arDenomina['totalSalario'];
                }
                $strActualizar = "UPDATE nomina SET ibc_tiempo_suple = " . $floSuplementario . " WHERE consecutivo = '" . $arNomina['consecutivo'] . "'";                    
                if ($servidorJG->query($strActualizar) === TRUE) {
                    echo "Se nomina " .$arNomina['consecutivo'] . "<br />";
                } else {
                    echo "Error: " .$servidorJG->error . $strActualizar . "<br />";
                }                
            }            
        } else {
            echo "0 results <br />";
        } */       
        
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>                
    </body>
</html>

