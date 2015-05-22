<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Importar contrato</title>
    </head>
    <body>
        <h1>Importar contrato</h1>
        <br /><br />
        <a href="index.php">Volver</a> <a href="importarContratoProceso.php">Importar</a>
        
<table border="1">
    <caption>Contratos nuevos</caption>
    <thead>
        <tr>
            <th>Contrato</th>
            <th>Identificacion</th>
            <th>Empleado</th> 
            <th>Desde</th>
            <th>Hasta</th> 
            <th>Salario</th>
        </tr>
    </thead>
    <tbody>                
        <?php
        set_time_limit(0);
        include("conexion.php");
        $strSql = "SELECT sql_migracion_contratos.* FROM sql_migracion_contratos WHERE codigo_interface_migracion is not null";
        $arContatos = $servidorJG->query($strSql);        
        if ($arContatos->num_rows > 0) {
            while ($arContato = $arContatos->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $arContato['contrato'] . "</td>";
                echo "<td>" . $arContato['cedemple'] . "</td>";
                echo "<td></td>";
                echo "<td>" . $arContato['fechainic'] . "</td>";
                echo "<td>" . $arContato['fechater'] . "</td>";
                echo "<td style='text-align: right'>" . number_format($arContato['salario'], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        $arContatos->close();
        ?>                   
    </tbody>
</table>   <br /><br /><br />        
    </body>
</html>

