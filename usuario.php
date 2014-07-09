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
            });
            $("a.left_panel_option").click(function(){
                $("a.left_panel_option").each(function() {
                    $(this).removeClass("lp_selected")
                });
                $(this).addClass("lp_selected")
            })

            $("#usr_edit").click(function(){ //habilitando campos para edición
                $("#usr_activo").prop('disabled', false);
                $("#usr_grupo").prop('disabled', false);
                $("#usr_nombres").prop('disabled', false);
                $("#usr_apPat").prop('disabled', false);
                $("#usr_apMat").prop('disabled', false);
                $("#usr_id").prop('disabled', false);
                $("#usr_tels").prop('disabled', false);
                $("#usr_email").prop('disabled', false);
                $("#usr_dir").prop('disabled', false);
                $("#usr_coms").prop('disabled', false);
            });
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
                <li><a class="round_left left_panel_option" id="usr_edit" href="#op1">Editar</a></li>
                <li><a class="round_left left_panel_option" id="usr_pass" href="#op2">Cambiar Usr|Pass</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <table class="" border="0" align="center">
            <tr>
                <td align="left"><input type="checkbox" id="usr_activo" disabled="disabled"/> Activo
                &nbsp;&nbsp;&nbsp;&nbsp;
                Grupo <select id="usr_grupo" disabled="disabled">
                    <option>Opción 1</option>
                    <option>Opción Opción Opción 2</option>
                    <option>Opción 3</option>
                    <option>Opción 4</option>
                </select>
            </tr>

            <tr>
                <td align="left">
                    Nombres<br/><input id="usr_nombres" maxlength="20" size="20" disabled="disabled"/><br/><br/>
                    Apellido Paterno<br/><input id="usr_apPat" maxlength="20" size="20" disabled="disabled"/><br/><br/>
                    Apellido Materno<br/><input id="usr_apMat" maxlength="20" size="20" disabled="disabled"/><br/><br/>
                    Doc ID<br/><input id="usr_id" maxlength="20" size="20" disabled="disabled"/>
                </td>
                <td align="left">
                    Teléfonos<br/><input id="usr_tels" maxlength="20" size="20" disabled="disabled"/><br/><br/>
                    e-mail<br/><input id="usr_email" maxlength="20" size="20" disabled="disabled"/><br/><br/>
                    Dirección<br/><textarea id="usr_dir" cols="24" rows="4" disabled="disabled"></textarea>
                </td>
            </tr>

            <tr><td align="center" colspan="2">Comentarios<br/><textarea id="usr_coms" cols="40" rows="5" disabled="disabled"></textarea></td><tr>

        </table>
    </div>
</div>
</body>
</html>