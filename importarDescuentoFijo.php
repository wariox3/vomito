<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Credito</title>
<style type="text/css">
body{
   	font-family: verdana;
}
</style>        
    </head>
    <body>
        <h1>Credito</h1>
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
        
        $strActualizar = "UPDATE credito set cuota_actualizada = cuota  WHERE 1";        
        if ($servidorJG->query($strActualizar) === TRUE) {
            echo "Se actualizaron las cuotas correctamente <br />";                        
        } else {
            echo "Error en la actualizacion de cuotas:" . $servidorJG->error . "<br />";
        }
        
        $strSql = "SELECT sql_migracion_descuentos_fijos.* FROM sql_migracion_descuentos_fijos WHERE codsala = '63'";
        $arDecentros = $servidorJG->query($strSql);
        if ($arDecentros->num_rows > 0) {
            while($arDecentro = $arDecentros->fetch_assoc()) {
                echo $arDecentro['cedemple'] . "-" . $arDecentro['deduccion'] . "<br />";
                //$strActualizar = "UPDATE credito set cuota_actualizada = " . $arDecentro['deduccion'] . "  WHERE cedemple='" . $arDecentro['cedemple'] . "' AND codsala ='" . $arDecentro['codsala'] . "'";
                //$servidorJG->query($strActualizar);
            }        
        } else {
            echo "0 results";
        }
        $arDecentros->close();
        /*
        $strSql = "SELECT credito.* FROM credito WHERE exportado_migracion = 0";
        $arCreditos = $servidorJG->query($strSql);
        if ($arCreditos->num_rows > 0) {
            while($arCredito = $arCreditos->fetch_assoc()) {
                $arEmpleados = $servidorBrasa->query("SELECT codigo_empleado_pk FROM rhu_empleado WHERE numero_identificacion = '" . $arCredito['cedemple'] . "'");
                $arEmpleado = $arEmpleados->fetch_assoc();
                $codigoEmpleado = $arEmpleado['codigo_empleado_pk'];
                
                $strInsertar = "INSERT INTO rhu_credito "
                    . " (codigo_empleado_fk, codigo_credito_tipo_fk, fecha, vr_pagar, vr_cuota, saldo, numero_cuotas, comentarios) "                        
                    . "  VALUES (" . $codigoEmpleado . ", 1, '" . $arCredito['fesalida'] . "', " . $arCredito['vlrentregado'] . ", " . $arCredito['cuota_actualizada'] . ", " . $arCredito['nuevo'] . ", " . $arCredito['plazo'] . ", '" . $arCredito['nrocredito'] . "')";
                if ($servidorBrasa->query($strInsertar) === TRUE) {
                    $strActMigracion = "UPDATE credito SET exportado_migracion = 1 WHERE nrocredito = '" . $arCredito['nrocredito'] . "'";
                    $servidorJG->query($strActMigracion);
                } else {
                    echo "Error: " . $arCredito['nrocredito'] . ":" .$servidorBrasa->error . "<br />";
                }
            }            
        } else {
            echo "0 results";
        }
        $arCreditos->close();
        $strActualizar = "UPDATE rhu_credito set vr_cuota = 0, estado_pagado = 1  WHERE saldo = 0";        
        if ($servidorBrasa->query($strActualizar) === TRUE) {
            echo "Se actualizaron correctamente los creditos pagados <br />";                        
        } else {
            echo "Error en la actualizacion de creditos pagados:" . $servidorJG->error . "<br />";
        } */       
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>
    </body>
</html>

