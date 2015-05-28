<table border="1">
    <caption>Retiros</caption>
    <thead>
        <tr>
            <th>codretiro</th>   
            <th>Retiro</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>                
        <?php        
        $strSql = "SELECT retiroprovision.* FROM retiroprovision WHERE fechare >= '" . $arNominaMaestro['desde'] . "' AND fechare <= '" . $arNominaMaestro['hasta'] . "' AND zona='" . $arNominaMaestro['zona'] . "' Order by fechare asc";
        $arRetiros = $servidorJG->query($strSql);
        if ($arRetiros->num_rows > 0) {
            while ($arRetiro = $arRetiros->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $arRetiro['codretiro'] . "</td>";
                echo "<td>" . $arRetiro['fechare'] . "</td>";
                echo "<td>" . $arRetiro['nombres'] . "</td>";
                echo "</tr>";

            }
        } else {
            echo "0 results";
        }
        $arRetiros->close();
        ?>                   
    </tbody>            
</table>   <br /> <br />