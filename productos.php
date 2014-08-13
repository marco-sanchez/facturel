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

            $(".messageBox").addClass("ui-widget-content");

            $(".usr_name").click(function(){
                window.location = 'usuario.php';
            });

            $("#ayuda").click(function(){

            });
            $("#salir").click(function(){
                salir();
            });

            selfLoadData();
            selfActions();
        });

        function salir(){
            //Setting exp. date of "PHP session cookie" to year zero
            document.cookie = 'PHPSESSID=; expires=Mon, 01-Jan-00 00:00:01 GMT;';
            window.location = 'index.php';
        }

        function selfLoadData(){
            $('#usr_grupo').empty();
            var grupos = leer_datos('usuarios_grupos');
            _.each(grupos, function(grupo){
                $('#usr_grupo').append($('<option>', {
                    value: grupo['id'],
                    text: grupo['nombre']
                }));
            });

            var usuario_actual = leer_datos('usuarios', <?php echo $_SESSION['current_user']['id']?>);

            if (usuario_actual['activo'] == 1)
                $("#usr_activo").prop('checked', true);
            else
                $("#usr_activo").prop('checked', false);

            $('#usr_grupo').val(usuario_actual['grupo']);
            $("#usr_nombres").val(usuario_actual['nombres']);
            $("#usr_apPat").val(usuario_actual['apPat']);
            $("#usr_apMat").val(usuario_actual['apMat']);
            $("#usr_doc").val(usuario_actual['docId']);
            $("#usr_tel").val(usuario_actual['telefonos']);
            $("#usr_email").val(usuario_actual['email']);
            $("#usr_dir").val(usuario_actual['direccion'].replace("/\r\n|\r|\n/",'\n'));
            $("#usr_coms").val(usuario_actual['comentarios'].replace("/\r\n|\r|\n/",'\n'));
        }

        function cancelEdit() {
            if ($("#editar").hasClass('selected')){
                leftPanSelection($("#editar"));
            }
            selfLoadData();
            $('.usr_field').prop('disabled', true);
            $("button.usr_field").fadeOut(500);
        }

        function hidePopup(element) {
            element.hide();
            $(".message").html('');
            $(".cover").hide();
        }

        function selfActions(){
            $("#editar").click(function(){

                leftPanSelection($(this));

                if ($("#editar").hasClass('selected')){
                    $('.usr_field').prop('disabled', false);
                    $("button.usr_field").fadeIn(500);
                } else cancelEdit();
            });

            $("#usrPass").click(function(){
                if ($("#editar").hasClass('selected'))
                    cancelEdit();
                leftPanSelection($(this));
                $(".cover").fadeIn(500);
                $("#passChange").fadeIn(500);
            });

            $("#btnUsrGuardar").click(function(){
                var usuario_actual = leer_datos('usuarios', <?php echo $_SESSION['current_user']['id']?>);
                var datos = {
                    id: usuario_actual['id'],
                    activo: $("#usr_activo").is(':checked'),
                    grupo: $("#usr_grupo").val(),
                    nombres: $("#usr_nombres").val(),
                    apPat: $("#usr_apPat").val(),
                    apMat: $("#usr_apMat").val(),
                    docId: $("#usr_doc").val(),
                    telefonos: $("#usr_tel").val(),
                    email: $("#usr_email").val(),
                    direccion: $("#usr_dir").val(),
                    comentarios: $("#usr_coms").val()
                };
                if (!datos['activo']){
                    if (confirm("Al quedar inactivo su usuario, esta sesión se cerrará.")){
                        guardar_datos(datos, "usuarios");
                        location.reload(true);
                    }
                } else {
                    datos['activo'] = 1;
                    guardar_datos(datos, "usuarios");
                    cancelEdit();
                }
            });

            $("#btnUsrCancelar").click(function(){
                cancelEdit();
            });

            $("#btnPassGuardar").click(function(){
                var oldPass = $('#oldPass').val();
                var newUsr = $("#newUsr").val();
                var newPass1 = $("#newPass1").val();
                var newPass2 = $("#newPass2").val();
                var usuario_actual = leer_datos('usuarios', <?php echo $_SESSION['current_user']['id']?>);
                var datos = {
                    id: usuario_actual['id'],
                    usuario: newUsr,
                    password: newPass1
                };

                $('#passChange input').val('');
                $("#passChange").fadeOut(500);

                if (evalLogin (usuario_actual['usuario'], oldPass, 'chPass')){
                    if (newUsr != ''){
                        if (newPass1 == newPass2 && newPass1 != ''){
                            if(confirm("La sesión actual se cerrará.")){
                                guardar_datos(datos, "usuarios");
                                salir();
                            }
                            $(".cover").fadeOut(500);
                            leftPanSelection($("#usrPass"));
                        } else msgBoxJS("Nueva contraseña no coincide o los campos están vacíos", $(".msgError"));
                    } else msgBoxJS("Inserte nuevo usuario o repita el usuario actual", $(".msgError"));
                } else msgBoxJS("'Contraseña Actual' no es válida", $(".msgError"));
            });

            $(".btnCloseMB").click(function(){
                leftPanSelection($("#usrPass"));
                hidePopup($(this).parent());
            });
        }

    </script>

</head>

<body>

<div class="cover"></div>
<div class="messageBox msgError">
    <img class='btnCloseMB' src='img/close.png'> <br/>
    <span class="message"></span>
</div>
<div class="messageBox msgTxt" id="passChange" draggable="true">
    <img class='btnCloseMB' src='img/close.png'><br/>
    <label>Contraseña actual<br/><input type="password" id="oldPass"/></label><br/><br/>
    <hr/>
    <label>Nuevo Usuario<br/><input type="text" id="newUsr"/></label><br/><br/>
    <label>Nueva contraseña<br/><input type="password" id="newPass1"/></label><br/><br/>
    <label>Repetir contraseña<br/><input type="password" id="newPass2"/></label><br/><br/>
    <br/>
    <button class="btn_positivo" id="btnPassGuardar">Guardar</button>
</div>

<div class="top" >
    <div class="logo_img" >
        <img src="img/logo_cedempre.png" width="200"/>
    </div>
    <div class="top_menu">
            <span class="top_container">
                <span class="usr_name" style="color: orange">
                    <?php echo $_SESSION['current_user']['nombres'] . " " . $_SESSION['current_user']['apPat'] . " " . $_SESSION['current_user']['apMat'] ?>
                </span>
                &nbsp;&nbsp;
                <button class="opt_button" id="ayuda">Ayuda</button>
                <button class="opt_button btn_negativo" id="salir">Salir</button>
            </span>

        <br/><br/>
        <ul>
            <li><a class="round_left" href="main.php">Ventas</a></li>
            <li><a class="selected" href="productos.php">Productos</a></li>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a class="round_right" href="reportes.php">Reportes</a></li>
        </ul>
    </div>
</div>
<div class="central">
    <div class="left_panel">
        <div class="lp_controls">
            <ul>
                <li><a class="round_left" id="agregar">Agregar</a></li>
                <li><a class="round_left" id="editar">Editar</a></li>
                <li><a class="round_left" id="eliminar">Eliminar</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        <table class="" border="1" align="center">
            <tr>
                <td>EN ESTA TABLA DEBE IR EL LISTADO DE PRODUCTOS</td>
            </tr>
        </table>
    </div>
</div>
</body>
</html>