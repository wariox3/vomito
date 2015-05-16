
        <?php
        set_time_limit(0);
        $servidorBrasa = new mysqli("192.168.10.152", "jgmysql", "yuij. 487.", "bdbrasa");
        if ($servidorBrasa->connect_error) {
            die("Connection failed: " . $servidorBrasa->connect_error);
        } 
        
        $servidorJG = new mysqli("192.168.10.26", "jgmysql", "$4cc3t0/.", "jgefectivo");
        if ($servidorJG->connect_error) {
            die("Connection failed: " . $ervidorJG->connect_error);
        }
        
        $file = fopen("archivo.txt", "r");
        while(!feof($file)) {
            echo fgets($file). "<br />";
        }
        fclose($file);
        
        set_time_limit(60);
        ?>


