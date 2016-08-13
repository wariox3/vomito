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
        $strSql = "SELECT rhu_pago_detalle.*, rhu_pago_concepto.compone_salario, rhu_pago_concepto.por_porcentaje_tiempo_extra FROM rhu_pago_detalle LEFT JOIN rhu_pago_concepto ON rhu_pago_detalle.codigo_pago_concepto_fk = rhu_pago_concepto.codigo_pago_concepto_pk";        
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
        }       
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>                
    </body>
</html>

