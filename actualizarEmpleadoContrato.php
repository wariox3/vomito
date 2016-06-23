<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Actualizar</title>
    </head>
    <body>
        <h1>Actualizar empleados con datos de contratos activos</h1>
        <?php
        set_time_limit(0);
        include("conexion.php");               
        
        $strSql = "SELECT rhu_contrato.* FROM rhu_contrato WHERE estado_activo = 1";
        $arContratos = $servidorSeracis->query($strSql);
        if ($arContratos->num_rows > 0) {
            while($arContrato = $arContratos->fetch_assoc()) {                
                //echo $arContrato['codigo_contrato_pk'] . "<br/>";
                $strActualizar = "UPDATE rhu_empleado SET codigo_centro_costo_fk = " . $arContrato['codigo_centro_costo_fk'] . ", "
                        . " codigo_tipo_tiempo_fk = " . $arContrato['codigo_tipo_tiempo_fk'] . ", "
                        . " vr_salario = " . $arContrato['vr_salario'] . ", "
                        . " fecha_contrato = '" . $arContrato['fecha_desde'] . "', "
                        . " fecha_finaliza_contrato = '" . $arContrato['fecha_hasta'] . "', "
                        . " fecha_contrato = '" . $arContrato['fecha_desde'] . "', "
                        . " codigo_clasificacion_riesgo_fk = " . $arContrato['codigo_clasificacion_riesgo_fk'] . ", "
                        . " codigo_cargo_fk = " . $arContrato['codigo_cargo_fk'] . ", "
                        . " cargo_descripcion = '" . $arContrato['cargo_descripcion'] . "', "
                        . " codigo_tipo_pension_fk = " . $arContrato['codigo_tipo_pension_fk'] . ", "                        
                        . " codigo_tipo_salud_fk = " . $arContrato['codigo_tipo_salud_fk'] . ", "
                        . " codigo_tipo_cotizante_fk = " . $arContrato['codigo_tipo_cotizante_fk'] . ", "
                        . " codigo_subtipo_cotizante_fk = " . $arContrato['codigo_subtipo_cotizante_fk'] . ", "
                        . " estado_activo = 1, "
                        . " estado_contrato_activo = 1, "
                        . " codigo_contrato_activo_fk = " . $arContrato['codigo_contrato_pk'] . ", "
                        . " codigo_entidad_pension_fk = " . $arContrato['codigo_entidad_pension_fk'] . ", "
                        . " codigo_entidad_salud_fk = " . $arContrato['codigo_entidad_salud_fk'] . ", "
                        . " codigo_entidad_caja_fk = " . $arContrato['codigo_entidad_caja_fk'] . ", "
                        . " codigo_contrato_ultimo_fk = " . $arContrato['codigo_contrato_pk'] . " "
                        . " WHERE codigo_empleado_pk = '" . $arContrato['codigo_empleado_fk'] . "'";                    
                
                if ($servidorSeracis->query($strActualizar) === TRUE) {
                    echo "Se actualiza " . $arContrato['codigo_contrato_pk'] . "<br/>";
                } else {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }                                                  
            }            
        } else {
            echo "0 results <br />";
        }        
        
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>                
    </body>
</html>

