<?php                
                $servidorSeracis = new mysqli("181.143.32.34", "soporte", "WilsonMika@@2016", "bdseracis");
                //$servidorSeracis = new mysqli("localhost", "root", "70143086", "bdseracis");
                if ($servidorSeracis->connect_error) {
                    die("Connection failed: " . $servidorSeracis->connect_error);
                }
