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

    <!-- Font : Ubuntu Mono from Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>

    <script src="js/_main.js"></script>
    <script>
        $(document).ready(function(){
            $(".usr_name").click(function(){
                window.location = 'usuario.php';
            })
        });
    </script

</head>

<body>
<div class="cover"></div>

<div class="top" >
    <div class="logo_img" >
        <img src="img/logo_cedempre.png" width="200"/>
    </div>
    <div class="top_menu">
                <span class="usr_name">
                    <?php echo $_SESSION['current_user']['nombres'] . " " . $_SESSION['current_user']['apPat'] . " " . $_SESSION['current_user']['apMat'] ?>
                </span>
        <br/><br/>
        <ul>
            <li><a class="round_left" href="main.php">Ventas</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <li><a class="round_right" href="ayuda.php">Ayuda</a></li>
        </ul>
    </div>
</div>
<div class="central">
    <div class="left_panel">
        <div class="lp_controls">
            <ul>
                <li><a class="round_left" href="#op1">Opción 1</a></li>
                <li><a class="round_left" href="#op2">Opción 2</a></li>
                <li><a class="round_left" href="#op3">Opción 3</a></li>
                <li><a class="round_left" href="#op4">Opción 4</a></li>
                <li><a class="round_left" href="#op5">Opción 5</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <table class="" border="0" align="center">
            <tr>
                <td align="right"><input type="checkbox"/> Activo</td>
                <td align="left">Grupo
                    <select id="usr_grupo">
                        <option>Opción 1</option>
                        <option>Opción 2</option>
                        <option>Opción 3</option>
                        <option>Opción 4</option>
                    </select>
            </tr>

            <tr>
                <td align="left">
                    Nombres<br/><input id="usr_nombres" maxlength="20" size="20"/><br/><br/>
                    Apellido Paterno<br/><input id="usr_apPat" maxlength="20" size="20"/><br/><br/>
                    Apellido Materno<br/><input id="usr_apMat" maxlength="20" size="20"/><br/><br/>
                    Doc ID<br/><input id="usr_nombres" maxlength="20" size="20"/>
                </td>
                <td align="left">
                    Teléfonos<br/><input id="usr_apPat" maxlength="20" size="20"/><br/><br/>
                    e-mail<br/><input id="usr_apMat" maxlength="20" size="20"/><br/><br/>
                    Dirección<br/><textarea cols="24" rows="4"></textarea>
                </td>
            </tr>

            <tr><td align="left" colspan="2">Comentarios<br/><textarea cols="52" rows="5"></textarea></td><tr>

        </table>
    </div>
</div>
</body>
</html>