<?php
if(!isset($_SESSION))
    session_start();
ob_start();
?>
<!DOCTYPE html>
<?php
include (__DIR__."/php/server_functions.php");
verify_usr();
?>
<html>
<head>
    <title>FACTUREL</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/_main.css">
    <script src="js/_main.js"></script>

    <script>
        $(document).ready(function(){
            set_defaults();
        });
    </script>
</head>

<body>
<div id="div_logo">
    <img src="img/logo_empresa.png" style="width: 60%">
</div>

<div id="div_top">
    <div id="top_name_help_out">
                <span id="top_usr_name" class="">
                    <?php echo $_SESSION['current_user']['nombres']
                        . " " . $_SESSION['current_user']['apPat']
                        . " " . $_SESSION['current_user']['apMat'] ?>
                </span>
        &nbsp;&nbsp;
        <button class="opt_button" id="ayuda">Ayuda</button>
        <button class="opt_button btn_negativo" id="salir">Salir</button>
    </div>

    <div id="top_menu" class="horizontal_menu">
        <ul>
            <li><a class="round_left" href="main.php">Ventas</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a class="selected" href="#">Clientes</a></li>
            <li><a class="round_right" href="reportes.php">Reportes</a></li>
        </ul>
    </div>
</div>

<div id="div_left">
    <div class="vertical_menu">
        <ul>
            <li><a class="round_left" href="#" id="op1">Opción 1</a></li>
            <li><a class="round_left" href="#" id="op2">Opción 2</a></li>
        </ul>
    </div>
</div>

<div id="div_content" class="list_table">
    <div id="content_controls" class="horizontal_menu">
        <ul>
            <li><a class="round_left" href="#">Lista</a></li>
            <li><a class="round_right" href="#">Individual</a></li>
        </ul>
    </div>
    <table class="zebra">
        <caption>Mi Tabla - Lista</caption>
        <thead>
        <tr>
            <th>Date</th>
            <th>Start time</th>
            <th>End time</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>02.06.2010</td>
            <td>10:00</td>
            <td>12:00</td>
            <td>Cleaning</td>
        </tr>
        <tr>
            <td>02.06.2010</td>
            <td>12:00</td>
            <td>15:00</td>
            <td>Training</td>
        </tr>
        <tr>
            <td>02.06.2010</td>
            <td>15:00</td>
            <td>17:00</td>
            <td>Rest</td>
        </tr>
        <tr>
            <td>02.06.2010</td>
            <td>17:00</td>
            <td>21:00</td>
            <td>Work</td>
        </tr>
        <tr>
            <td>02.06.2010</td>
            <td>21:00</td>
            <td>07:00</td>
            <td>Sleep</td>
        </tr>
        </tbody>
    </table>
</div>

<div id="div_footer">

</div>

<!-- ############################################################### -->
<!-- ################## DIÁLOGOS & POPUPS ########################## -->

<div id="cover"></div>

<div class="msgBox" id="msgConfirmar">
    <div class="msgTop">
        <span class="msgTl"></span>
    </div>
            <span class="msgTxt">
            </span>
    <div class="msgFooter">
        <button class="btnSI"></button>
        <button class="btnNO btn_negativo"></button>
    </div>
</div>

<div class="msgBox" id="msgError">
    <div class="msgTop">
                <span class="msgTl">
                </span>
    </div>
            <span class="msgTxt">
            </span>
    <div class="msgFooter">
        <button class="btnSI">Aceptar</button>
    </div>
</div>
</body>
</html>