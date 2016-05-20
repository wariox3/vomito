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
      
        
        $strSql = "SELECT rhu_contrato.* FROM rhu_contrato WHERE 1";
        $arContratos = $servidorBrasa->query($strSql);
        if ($arContratos->num_rows > 0) {
            while($arContrato = $arContratos->fetch_assoc()) {                
                $strActualizar = "UPDATE rhu_empleado SET estado_contrato_activo = 1, codigo_contrato_activo_fk = " . $arContrato['codigo_contrato_pk'] . " WHERE codigo_empleado_pk = " . $arContrato['codigo_empleado_fk'];                                    
                if ($servidorBrasa->query($strActualizar) === TRUE) {
                    echo "ejecutada" . $strActualizar . "<br />";
                } else {
                    echo "Error: " .$servidorBrasa->error . $strActualizar . "<br />";
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

