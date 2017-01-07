<?php
                //$servidor = new mysqli("192.168.2.199", "soporte", "WilsonMika@@2016", "bdseracis");
                //$servidor = new mysqli("localhost", "root", "70143086", "bdseracis");
                //$servidor = new mysqli("192.168.10.105", "soporte", "70143086", "bd1teg");
                $servidor = new mysqli("localhost", "root", "70143086", "bdeurovic");
                if ($servidor->connect_error) {
                    die("Connection failed: " . $servidor->connect_error);
                }
