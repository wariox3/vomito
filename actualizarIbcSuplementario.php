<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Actualizar</title>
    </head>
    <body>
        <h1>Actualizar ibc tiempo suplementario</h1>
        <?php
        set_time_limit(0);
        include("conexion.php");               
        
        $strSql = "SELECT nomina.* FROM nomina WHERE nomina.fechap >= '2015-06-01' ORDER BY consecutivo DESC";
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
        }        
        
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>                
    </body>
</html>

