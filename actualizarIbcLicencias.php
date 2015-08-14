<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Actualizar</title>
    </head>
    <body>
        <h1>Actualizar ibc licencias</h1>
        <?php
        set_time_limit(0);
        include("conexion.php");               
        
        /*$strSql = "SELECT denomina.* FROM denomina WHERE denomina.codsala = '94' OR denomina.codsala = '95'";
        $arDenominas = $servidorJG->query($strSql);
        if ($arDenominas->num_rows > 0) {
            while($arDenomina = $arDenominas->fetch_assoc()) {                
                $douVlrHora = 0;
                $arDenominaSalarios = $servidorJG->query("SELECT vlrhora FROM denomina WHERE consecutivo = '" . $arDenomina['consecutivo'] . "' AND codsala='01'");                
                if ($arDenominaSalarios->num_rows <= 0) {
                    $arNominas = $servidorJG->query("SELECT basico FROM nomina WHERE consecutivo = '" . $arDenomina['consecutivo'] . "'");
                    $arNomina = $arNominas->fetch_assoc();                    
                    $douVlrHora = $arNomina['basico'] / 30 / 8;
                    //echo "error: " . $arDenomina['consecutivo'] . " " . ($arNomina['basico'] / 30 / 8) ."<br />";
                } else {
                    $arDenominaSalario = $arDenominaSalarios->fetch_assoc();
                    $douVlrHora = $arDenominaSalario['vlrhora'];
                }
                $douIbc = $douVlrHora * $arDenomina['nrohora'];
                $strActualizar = "UPDATE denomina SET vlrhora = " . $douVlrHora . ", ibcprestacional=" . $douIbc . " WHERE consecutivo = '" . $arDenomina['consecutivo'] . "' AND codsala='" . $arDenomina['codsala'] . "'";                    
                if ($servidorJG->query($strActualizar) === TRUE) {
                    echo "Se actualizo centro " .$arDenomina['consecutivo'] . "<br />";
                } else {
                    echo "Error: " .$servidorJG->error . "<br />";
                }              
            }            
        } else {
            echo "0 results <br />";
        }*/

        /*$strSql = "SELECT denomina.* FROM denomina WHERE denomina.codsala = '12'";
        $arDenominas = $servidorJG->query($strSql);
        if ($arDenominas->num_rows > 0) {
            while($arDenomina = $arDenominas->fetch_assoc()) {                
                $douVlrHora = 0;
                $arDenominaSalarios = $servidorJG->query("SELECT vlrhora FROM denomina WHERE consecutivo = '" . $arDenomina['consecutivo'] . "' AND codsala='01'");                
                if ($arDenominaSalarios->num_rows <= 0) {
                    $arNominas = $servidorJG->query("SELECT basico FROM nomina WHERE consecutivo = '" . $arDenomina['consecutivo'] . "'");
                    $arNomina = $arNominas->fetch_assoc();                    
                    $douVlrHora = $arNomina['basico'] / 30 / 8;
                    echo "error: " . $arDenomina['consecutivo'] . " " . ($arNomina['basico'] / 30 / 8) ."<br />";
                } else {
                    $arDenominaSalario = $arDenominaSalarios->fetch_assoc();
                    $douVlrHora = $arDenominaSalario['vlrhora'];
                }
                $douIbc = $douVlrHora * $arDenomina['nrohora'];
                $strActualizar = "UPDATE denomina SET ibcprestacional=" . $douIbc . " WHERE consecutivo = '" . $arDenomina['consecutivo'] . "' AND codsala='" . $arDenomina['codsala'] . "'";                    
                if ($servidorJG->query($strActualizar) === TRUE) {
                    echo "Se actualizo centro " .$arDenomina['consecutivo'] . "<br />";
                } else {
                    echo "Error: " .$servidorJG->error . "<br />";
                }                
                              
            }            
        } else {
            echo "0 results <br />";
        }  */      
        
        set_time_limit(60);
        ?>
                <br /><br />
        <a href="index.php">Volver</a>                
    </body>
</html>

