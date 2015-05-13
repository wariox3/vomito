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
        $servidorBrasa = new mysqli("192.168.10.152", "jgmysql", "yuij. 487.", "bdbrasa");
        if ($servidorBrasa->connect_error) {
            die("Connection failed: " . $servidorBrasa->connect_error);
        }  
        
        $servidorJG = new mysqli("192.168.10.26", "jgmysql", "$4cc3t0/.", "jgefectivo");
        if ($servidorJG->connect_error) {
            die("Connection failed: " . $ervidorJG->connect_error);
        }        
        //Actualizar los estados
        /*$strActualizar = "TRUNCATE TABLE rhu_pago_detalle"; 
        if ($servidorBrasa->query($strActualizar) === TRUE) {
            echo "Se borro pagos detalle <br />";
            $strActualizar = "TRUNCATE TABLE rhu_pago"; 
            if ($servidorBrasa->query($strActualizar) === TRUE) {
                echo "Se borro pagos <br />";
            } else {
                echo "Error en borrar pagos detalle:" .$servidorBrasa->error . "<br />";
            }             
            
        } else {
            echo "Error en borrar pagos detalle:" .$servidorBrasa->error . "<br />";
        }
         * 
         */
        //$strActMigracion = "UPDATE empleado SET exportado_migracion = 0 WHERE 1"; 
        //$servidorJG->query($strActMigracion);
        //$strActMigracion = "UPDATE retiroprovision SET exportado_migracion = 0 WHERE 1";
        //$servidorJG->query($strActMigracion);
        $strActMigracion = "UPDATE contrato SET exportado_migracion = 0 WHERE 1";
        $servidorJG->query($strActMigracion);
        //$strActMigracion = "UPDATE credito SET exportado_migracion = 0 WHERE 1";
        //$servidorJG->query($strActMigracion);        
        set_time_limit(60);
        ?>
        <br /><br />
        <a href="index.php">Volver</a>
    </body>
</html>

