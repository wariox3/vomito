<?php                
                //$servidorSeracis = new mysqli("192.168.2.199", "soporte", "WilsonMika@@2016", "bdseracis");
                //$servidorSeracis = new mysqli("localhost", "root", "70143086", "bdseracis");
                $servidorSeracis = new mysqli("localhost", "soporte", "70143086", "bdseracis");
                //$servidorSeracis = new mysqli("192.168.10.152", "jgmysql", "srt*145ss..", "bd1teg");
                if ($servidorSeracis->connect_error) {
                    die("Connection failed: " . $servidorSeracis->connect_error);
                }
