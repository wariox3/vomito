<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

                $servidorBrasa = new mysqli("181.143.57.90", "jgmysql", "yuij. 487.", "bdbrasa");
                if ($servidorBrasa->connect_error) {
                    die("Connection failed: " . $servidorBrasa->connect_error);
                } 

                $servidorJG = new mysqli("181.143.57.90", "jgmysql", "yuij. 487.", "jgefectivo");
                if ($servidorJG->connect_error) {
                    die("Connection failed: " . $ervidorJG->connect_error);
                }
                /*
                $servidorBrasa = new mysqli("192.168.10.152", "jgmysql", "yuij. 487.", "bdbrasa");
                if ($servidorBrasa->connect_error) {
                    die("Connection failed: " . $servidorBrasa->connect_error);
                }

                $servidorJG = new mysqli("192.168.10.26", "jgmysql", "$4cc3t0/.", "jgefectivo");
                if ($servidorJG->connect_error) {
                    die("Connection failed: " . $ervidorJG->connect_error);
                } 
                 * 
                 */               