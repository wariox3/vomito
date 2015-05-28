<table border="1">
    <caption>Retiros</caption>
    <thead>
        <tr>
            <th>codretiro</th>                   
        </tr>
    </thead>
    <tbody>                
        <?php
        $strSuplementario = "";
        $strSql = "SELECT retiroprovision.* FROM retiroprovision WHERE fechare >= '2015-05-16' AND fechare >= '2015-05-30'";
        $arRetiros = $servidorJG->query($strSql);
        if ($arRetiros->num_rows > 0) {
            while ($arRetiro = $arRetiros->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $arRetiro['codretiro'] . "</td>";
                echo "</tr>";

            }
        } else {
            echo "0 results";
        }
        $arRetiros->close();
        ?>                   
    </tbody>            
</table>   <br /> <br />