<?php  

if ($_FILES[csv][size] > 0) { 
    set_time_limit(0);
    include("conexion.php");     
    $i = 0;
    $file = $_FILES[csv][tmp_name]; 
    //$handle = fopen($file,"r"); 
    $fp = fopen($file, "r");
    while(!feof($fp)) {
        $linea = fgets($fp);
        $strLinea = strval($linea);
        echo strlen($strLinea) . $linea . "<br />";
    }
    fclose($fp);
    
    //redirect 
    header('Location: validarArchivoPila.php?success=1'); die; 

} 

?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Archivo</title>
    </head>
    <body>
        <h1>Archivo</h1>
        <?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?> 

        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
          Choose your file: <br /> 
          <input name="csv" type="file" id="csv" /> 
          <input type="submit" name="Submit" value="Submit" /> 
        </form>         
        <br /><br />
        <a href="index.php">Volver</a>           
    </body>
</html>

