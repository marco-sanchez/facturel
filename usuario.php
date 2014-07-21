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

            $("#salir").click(function(){
                //Setting exp. date of "PHP session cookie" to year zero
                document.cookie = 'PHPSESSID=; expires=Mon, 01-Jan-00 00:00:01 GMT;';
                window.location = 'index.php';
            });

            selfLoadData();
            selfActions();
        });

        function selfLoadData(){
            var activo = <?php echo $_SESSION['current_user']['activo']?>;
            if (activo == 1)
                $("#usr_activo").prop('checked', true);
            else
                $("#usr_activo").prop('checked', false);

            $("#usr_nombres").val('<?php echo $_SESSION['current_user']['nombres']?>');
            $("#usr_apPat").val('<?php echo $_SESSION['current_user']['apPat']?>');
            $("#usr_apMat").val('<?php echo $_SESSION['current_user']['apMat']?>');
            $("#usr_doc").val('<?php echo $_SESSION['current_user']['docId']?>');
            $("#usr_tel").val('<?php echo $_SESSION['current_user']['telefonos']?>');
            $("#usr_email").val('<?php echo $_SESSION['current_user']['email']?>');
            $("#usr_dir").val('<?php echo $_SESSION['current_user']['direccion']?>');
            $("#usr_coms").val('<?php echo $_SESSION['current_user']['comentarios']?>');
        }

        function selfActions(){
            $("#editar").click(function(){
                leftPanSel($(this));
                /*$('#usr_field').attr('disabled', 'disabled'); //Disable*/
                $('.usr_field').removeAttr('disabled'); //Enable
                $("button.usr_field").show();
            });

            $("#pass").click(function(){
                leftPanSel($(this));
            })
        }

    </script>

</head>

<body>
<div class="cover"></div>

<div class="top" >
    <div class="logo_img" >
        <img src="img/logo_cedempre.png" width="200"/>
    </div>
    <div class="top_menu">
        <span class="top_container">
            <span class="usr_name">
                <?php echo $_SESSION['current_user']['nombres'] . " " . $_SESSION['current_user']['apPat'] . " " . $_SESSION['current_user']['apMat'] ?>
            </span>
            &nbsp;&nbsp;
            <button class="opt_button">Ayuda</button>
            <button class="opt_button">Salir</button>
        </span>

        <br/><br/>
        <ul>
            <li><a class="round_left" href="main.php">Ventas</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a class="round_right" href="reportes.php">Reportes</a></li>
        </ul>
        <span class="selfTitle">DATOS USUARIO</span><br/><br/>
    </div>

</div>
<div class="central">
    <div class="left_panel">
        <div class="lp_controls">
            <ul>
                <li><a class="round_left" id="editar">Editar Datos</a></li>
                <li><a class="round_left" id="pass">Contraseña</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <table class="" border="0" align="left">
            <tr>
                <td align="left">
                    <div class="slideCheck">
                        <input type="checkbox" class="usr_field" id="usr_activo" disabled/>
                        <label for="usr_activo"></label>
                    </div>
                </td>
                <td> &nbsp;&nbsp;&nbsp;
                <label>Grupo
                    <select class="usr_field" id="usr_grupo" disabled>
                        <option>Select 1</option>
                        <option>Select 2 Select 2</option>
                        <option>Select 3</option>
                        <option>Select 4</option>
                    </select></label>
            </tr>
        </table>
        <br/><br/><br/><br/>
        <table class="" border="0" align="center">
            <tr>
                <td align="left"><label>Nombres<br/><input class="usr_field" id="usr_nombres" maxlength="100" size="20" disabled/></label></td>
                <td align="left"><label>Apellido Paterno<br/><input class="usr_field" id="usr_apPat" maxlength="100" size="20" disabled/></label></td>
                <td align="left"><label>Apellido Materno<br/><input class="usr_field" id="usr_apMat" maxlength="100" size="20" disabled/></label></td>
            </tr>
            <tr>
                <td align="left"><label>Doc ID<br/><input class="usr_field" id="usr_doc" maxlength="100" size="20" disabled/></label></td>
                <td align="left"><label>Teléfonos<br/><input class="usr_field" id="usr_tel" maxlength="100" size="20" disabled/></label></td>
                <td align="left"><label>e-mail<br/><input class="usr_field" id="usr_email" maxlength="100" size="20" disabled/></label></td>
            </tr>
            <tr>
                <td align="left"><label>Dirección<br/><textarea class="usr_field" id="usr_dir" cols="19" rows="4" disabled></textarea></label></td>
                <td align="left" colspan="2"><label>Comentarios<br/><textarea class="usr_field" id="usr_coms" cols="43" rows="4" disabled></textarea></label></td>
            </tr>
            <tr>
                <td align="center" colspan="3">
                    <button class="usr_field">Guardar Cambios</button>
                </td>
            <tr>
        </table>
    </div>
</div>
</body>
</html>