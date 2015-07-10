<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Actualizar decentro</title>
    </head>
    <body>
        <h1>Actualizar decentro</h1>
        <?php
        set_time_limit(0);
        include("conexion.php");               
        
        $strSql = "SELECT decentro.* FROM decentro WHERE decentro.codsala = '01'";
        $arDecentros = $servidorJG->query($strSql);

        if ($arDecentros->num_rows > 0) {
            while($arDecentro = $arDecentros->fetch_assoc()) {                
                //echo "hola mundo";
                $strActualizar = "UPDATE decentro SET vlrhora = " . $arDecentro['vlrhora'] . " WHERE codcentro = '" . $arDecentro['codcentro'] . "' AND (codsala='94' OR codsala='95')";                    
                //echo $strActualizar;
                if ($servidorJG->query($strActualizar) === TRUE) {
                    echo "Se actualizo centro " .$arDecentro['codcentro'] . "<br />";
                } else {
                    echo "Error: " .$servidorJG->error . "<br />";
                }                
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

