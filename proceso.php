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
        $strSql = "SELECT tur_recurso.* FROM tur_recurso";        
        $arRecursos = $servidorSeracis->query($strSql);
        if ($arRecursos->num_rows > 0) {
            while($arRecurso = $arRecursos->fetch_assoc()) {                                  
                $strSql = "SELECT
                tur_programacion_detalle.codigo_puesto_fk,
                tur_cliente.nit,
                Sum(tur_programacion_detalle.horas) AS horasTotales
                FROM
                tur_programacion_detalle
                LEFT JOIN tur_puesto ON tur_programacion_detalle.codigo_puesto_fk = tur_puesto.codigo_puesto_pk
                LEFT JOIN tur_cliente ON tur_puesto.codigo_cliente_fk = tur_cliente.codigo_cliente_pk
                WHERE
                tur_programacion_detalle.anio = 2016 AND
                tur_programacion_detalle.mes = 7 AND
                tur_programacion_detalle.codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'] . "
                GROUP BY
                tur_programacion_detalle.codigo_puesto_fk
                ORDER BY Sum(tur_programacion_detalle.horas) DESC";                
                
                $arProgramacionesDetalles = $servidorSeracis->query($strSql);
                if ($arProgramacionesDetalles->num_rows > 0) {
                    $arProgramacionDetalle = $arProgramacionesDetalles->fetch_assoc();
                    echo $arRecurso['codigo_recurso_pk'] . "-" . $arProgramacionDetalle['codigo_puesto_fk'] . "-" . $arProgramacionDetalle['nit'] . "<br/>";                    
                    $strActualizar = "UPDATE rhu_empleado set dato = '" . $arProgramacionDetalle['nit'] . "' WHERE codigo_empleado_pk = " . $arRecurso['codigo_empleado_fk'];                                                            
                    if ($servidorSeracis->query($strActualizar) === TRUE) {
                        echo $strActualizar . "<br/>";
                    } else {
                        echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                    }  
                }
                
                /*if($arPagoDetalle['compone_salario'] == 1) {
                    echo "Salario";
                }
                if($arPagoDetalle['por_porcentaje_tiempo_extra'] > 0) {
                    $ibcExtra = $arPagoDetalle['vr_pago'];
                    //echo $arPagoDetalle['codigo_pago_detalle_pk'] . "<br/>";
                    $strActualizar = "UPDATE rhu_pago_detalle set vr_ingreso_base_cotizacion_adicional = " . $ibcExtra . " WHERE codigo_pago_detalle_pk = " . $arPagoDetalle['codigo_pago_detalle_pk'];                                                            
                    if ($servidorSeracis->query($strActualizar) === TRUE) {
                        echo $strActualizar . "<br/>";
                    } else {
                        echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                    }                        
                } 
                 * 
                 */                                       
            }            
        } else {
            echo "0 results <br />";
        }            
        
        /*$strSql = "SELECT rhu_pago_detalle.*, rhu_pago_concepto.compone_salario, rhu_pago_concepto.por_porcentaje_tiempo_extra FROM rhu_pago_detalle LEFT JOIN rhu_pago_concepto ON rhu_pago_detalle.codigo_pago_concepto_fk = rhu_pago_concepto.codigo_pago_concepto_pk";        
        $arPagosDetalle = $servidorSeracis->query($strSql);
        if ($arPagosDetalle->num_rows > 0) {
            while($arPagoDetalle = $arPagosDetalle->fetch_assoc()) {                  
                if($arPagoDetalle['codigo_pago_concepto_fk'] == 66 || $arPagoDetalle['codigo_pago_concepto_fk'] == 67 || $arPagoDetalle['codigo_pago_concepto_fk'] == 68) {
                    if($arPagoDetalle['compone_salario'] == 1) {
                        echo "Salario";
                    }
                    if($arPagoDetalle['por_porcentaje_tiempo_extra'] > 0) {
                        $ibcExtra = $arPagoDetalle['vr_pago'];
                        //echo $arPagoDetalle['codigo_pago_detalle_pk'] . "<br/>";
                        $strActualizar = "UPDATE rhu_pago_detalle set vr_ingreso_base_cotizacion_adicional = " . $ibcExtra . " WHERE codigo_pago_detalle_pk = " . $arPagoDetalle['codigo_pago_detalle_pk'];                                                            
                        if ($servidorSeracis->query($strActualizar) === TRUE) {
                            echo $strActualizar . "<br/>";
                        } else {
                            echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                        }                        
                    }                                        
                }
            }            
        } else {
            echo "0 results <br />";
        }      
        $strSql = "SELECT rhu_pago.* FROM rhu_pago";        
        $arPagos = $servidorSeracis->query($strSql);
        if ($arPagos->num_rows > 0) {
            while($arPago = $arPagos->fetch_assoc()) {                  
                $strSql = "SELECT SUM(vr_ingreso_base_cotizacion_adicional) vrExtras FROM rhu_pago_detalle WHERE codigo_pago_fk=" . $arPago['codigo_pago_pk'];
                $arPagoDetalle = $servidorSeracis->query($strSql);
                $arPagoDetalle = $arPagoDetalle->fetch_assoc();
                $strActualizar = "UPDATE rhu_pago set vr_adicional_cotizacion = " . $arPagoDetalle['vrExtras'] . " WHERE codigo_pago_pk = " . $arPago['codigo_pago_pk'];                                                            
                if ($servidorSeracis->query($strActualizar) === TRUE) {
                    echo $strActualizar . "<br/>";
                } else {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }                 
            }            
        } else {
            echo "0 results <br />";
        }*/       
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>                
    </body>
</html>

