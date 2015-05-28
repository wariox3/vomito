<!DOCTYPE html>
<html>
    <head>        
        <meta charset="UTF-8">
        <title>Ver pago nomina</title>
        <style type="text/css">
            body{
                font-family: verdana;
                font-size: 11px;
            }
        </style>        
    </head>
    <body>
        <a href="verNomina.php">Volver</a> <br /> <br />        
        <h1>Ver pago nomina <?php echo $_GET['codigo']; ?></h1>
        <?php 
        include("conexion.php");  
        $arNominaMaestros = $servidorJG->query("SELECT sql_migracion_pago_nomina.* FROM sql_migracion_pago_nomina WHERE codigo = '" . $_GET['codigo'] . "'");
        $arNominaMaestro = $arNominaMaestros->fetch_assoc();
        echo $arNominaMaestro['zona'] . " [" . $arNominaMaestro['desde'] . " " . $arNominaMaestro['hasta'] . "]";
        include("verNominaDetalleEmpleados.php");
        include("verNominaDetallesSinClasificar.php");
        include("verNominaDetallesNovedades.php");
        include("verNominaDetallesAdicional.php");
        include("verNominaDetallesSuplementario.php");
        include("verNominaDetallesRetiros.php");
        echo "#SQL Adicionales<br />" . $strAdicionales;
        echo "<br /><br />";
        echo "#SQL Suplementario<br />" . $strSuplementario;
        //echo "<br /><br />";
        //echo "#SQL tiempo laborado<br />" . $strTiempoLaborado;
        echo "<br /><br />";
        echo "#SQL incapacidades<br />" . $strNovedadesIncapacidades;
        echo "<br /><br />";
        echo "#SQL licencias<br />" . $strNovedadesLicencias;        
        ?>
    </body>
</html>

