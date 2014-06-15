<?php
if(!isset($_SESSION))
    session_start();
?>
<!DOCTYPE html>
<?php
    include("php/server_functions.php");
    verify_usr();
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/top_menu.css">

        <!-- Font : Ubuntu Mono from Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>

        <title>FACTUREL</title>

        <script src="/js/libraries/jquery-2.1.1.min.js"></script>
        <script src="/js/libraries/crypt.js"></script>
        <script src="/js/functions.js"></script>
        <script>
            $(document).ready(function(){

            });

        </script

    </head>

    <body>
        <div class="cover"></div>
        <div class="top_menu">
            <ul>
                <li><a href="#inicio">Inicio</a></li>
                <li><a href="#productos">Productos</a></li>
                <li><a href="#reportes">Reportes</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </div>
    </body>
</html>
