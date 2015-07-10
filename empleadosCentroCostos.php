<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Importar contrato</title>
    </head>
    <body>
        <h1>Importar contrato</h1>
        <?php
        /*set_time_limit(0);
        include("conexion.php");      
        $strSql = "SELECT empleado.* FROM empleado WHERE 1";
        $arEmpleados = $servidorJG->query($strSql);
        if ($arEmpleados->num_rows > 0) {
            while ($arEmpleado = $arEmpleados->fetch_assoc()) {
                $arCentrosTrabajo = $servidorJG->query("SELECT cedemple FROM centrotrabajo WHERE cedemple = '" . $arEmpleado['cedemple'] . "'");
                $arCentroTrabajo = $arCentrosTrabajo->fetch_assoc();                
                
                if($arCentroTrabajo != null) {
                    echo "Existe <br />";
                } else {
                    $strInsertar = "INSERT INTO centrotrabajo "
                                . " (codcosto, cedemple, estado) "                        
                                . "  VALUES ('" . $arEmpleado['codcosto'] . "', '" . $arEmpleado['cedemple'] . "', 'ACTIVO')";
                    if ($servidorJG->query($strInsertar) === TRUE) {
                        echo "Inserto <br />";                    
                    } else {
                        echo "Error: " . $arEmpleado['cedemple'] . ":" . $strInsertar . " Descripcion: " .$servidorJG->error . "<br />";
                    }                    
                }
            }
        } else {
            echo "0 results";
        }        
        set_time_limit(60);*/
        ?>
        <br /><br />
        <a href="index.php">Volver</a>
    </body>
</html>

