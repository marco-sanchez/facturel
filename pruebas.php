<!DOCTYPE html>
<html>
<head>
    <title>FACTUREL</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/_main.css">
</head>

<body>

<div id="div_logo">
    <img src="img/logo_empresa.png" style="width: 60%">
</div>

<div id="div_top">
    <div id="top_name_help_out">
        <span id="top_usr_name">
            Marco Alejandro Sánchez Melgarejo
        </span>
        &nbsp;&nbsp;
        <button class="opt_button" id="ayuda">Ayuda</button>
        <button class="opt_button btn_negativo" id="salir">Salir</button>
    </div>

    <div id="tittle">El Título</div>

    <div id="top_menu" class="horizontal_menu">
        <ul>
            <li><a class="round_left selected" href="">Ventas</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a class="round_right" href="reportes.php">Reportes</a></li>
        </ul>
    </div>
</div>

<div id="div_left" class="round_corners">
    div_left
</div>

<div id="div_content" class="round_corners">

</div>

<div id="div_footer">
    div_footer
</div>

<!-- ############################################################### -->
<!-- ################## DIÁLOGOS & POPUPS ########################## -->

    <div id="cover"></div>

    <div class="msgBox" id="msgConfirmar">
        <div class="msgTop">
                <span class="msgTl">
                </span>
        </div>
            <span class="msgTxt">
            </span>
        <div class="msgBottom">
            <button class="btnSI"></button>
            <button class="btnNO"></button>
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