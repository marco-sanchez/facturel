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
                <li><a class="round_left selected" href="#">Ventas</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="clientes.php">Clientes</a></li>
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

    <div id="div_content" class="">

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