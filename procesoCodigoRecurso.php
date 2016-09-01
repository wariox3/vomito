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

        /*$strSql = "SELECT tur_recurso.* FROM tur_recurso where codigo_recurso_pk < 3000";
        $arRecursos = $servidorSeracis->query($strSql);
        if ($arRecursos->num_rows > 0) {
            $codigoNuevo = 10000;
            $codigoTemporal = 9999;
            while($arRecurso = $arRecursos->fetch_assoc()) {                               
                $strActualizar = "UPDATE tur_programacion_detalle set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                 
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_soporte_pago set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_soporte_pago_detalle set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_pedido_detalle_recurso set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_servicio_detalle_recurso set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_costo_recurso set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_novedad set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_novedad set codigo_recurso_reemplazo_fk  = " . $codigoTemporal . " WHERE codigo_recurso_reemplazo_fk = " . $arRecurso['codigo_recurso_pk'];                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_simulacion_detalle set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }           
                
                $strActualizar = "UPDATE tur_recurso set codigo_recurso_pk  = " . $codigoNuevo . " WHERE codigo_recurso_pk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }                
                
                $strActualizar = "UPDATE tur_programacion_detalle set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_soporte_pago set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_soporte_pago_detalle set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_pedido_detalle_recurso set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_servicio_detalle_recurso set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_costo_recurso set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_novedad set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_novedad set codigo_recurso_reemplazo_fk  = " . $codigoNuevo . " WHERE codigo_recurso_reemplazo_fk = " . $codigoTemporal;                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_simulacion_detalle set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }                
                $codigoNuevo++;
                echo $arRecurso['codigo_recurso_pk'] . "<br />";
            }
        } else {
            echo "0 results <br />";
        }
        */

        /*$strSql = "SELECT tur_recurso.* FROM tur_recurso where codigo_recurso_pk <> 9999";
        $arRecursos = $servidorSeracis->query($strSql);
        if ($arRecursos->num_rows > 0) {
            $codigoTemporal = 9999;
            while($arRecurso = $arRecursos->fetch_assoc()) {                               
                $strActualizar = "UPDATE tur_programacion_detalle set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_soporte_pago set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_soporte_pago_detalle set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_pedido_detalle_recurso set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_servicio_detalle_recurso set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_costo_recurso set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_novedad set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_novedad set codigo_recurso_reemplazo_fk  = " . $codigoTemporal . " WHERE codigo_recurso_reemplazo_fk = " . $arRecurso['codigo_recurso_pk'];                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_simulacion_detalle set codigo_recurso_fk  = " . $codigoTemporal . " WHERE codigo_recurso_fk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }           
                $codigoNuevo = $arRecurso['codigo_empleado_fk'];
                $strActualizar = "UPDATE tur_recurso set codigo_recurso_pk  = " . $codigoNuevo . " WHERE codigo_recurso_pk = " . $arRecurso['codigo_recurso_pk'];                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }                
                
                $strActualizar = "UPDATE tur_programacion_detalle set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_soporte_pago set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_soporte_pago_detalle set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_pedido_detalle_recurso set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_servicio_detalle_recurso set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_costo_recurso set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_novedad set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_novedad set codigo_recurso_reemplazo_fk  = " . $codigoNuevo . " WHERE codigo_recurso_reemplazo_fk = " . $codigoTemporal;                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }
                $strActualizar = "UPDATE tur_simulacion_detalle set codigo_recurso_fk  = " . $codigoNuevo . " WHERE codigo_recurso_fk = " . $codigoTemporal;                                                
                if ($servidorSeracis->query($strActualizar) === FALSE) {
                    echo "Error: " .$servidorSeracis->error . $strActualizar . "<br />";
                }                
            }
        } else {
            echo "0 results <br />";
        }        
        */
                
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>
    </body>
</html>

