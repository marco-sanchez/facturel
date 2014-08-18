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
            selfLoadData();
            selfActions();
        });

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
                    msgConfirmar("Editar Datos", "Al desactivar su usuario la sesión deberá cerrarse.",
                        "Cerrar Sesión", "Cancelar",
                        function(){
                            guardar_datos(datos, "usuarios");
                            location.reload(true);
                        },
                        function(){}
                    )
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

    </script>
</head>

<body>
    <div id="div_logo">
        <img src="img/logo_empresa.png" style="width: 60%">
    </div>

    <div id="div_top">
        <div id="top_name_help_out">
            <span id="top_usr_name" class="selected">
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
                <li><a href="clientes.php">Clientes</a></li>
                <li><a class="round_right" href="reportes.php">Reportes</a></li>
            </ul>
        </div>
    </div>

    <div id="div_left">
        <div class="vertical_menu">
            <ul>
                <li><a class="round_corners" href="#" id="editar">Editar datos personales</a></li>
                <li><a class="round_corners" href="#" id="usrPass">Cambiar usuario-contraseña</a></li>
            </ul>
        </div>
    </div>

    <div id="div_content" class="">
        <table class="usr_table" border="0" align="left">
            <tr>
                <td align="left">
                    <div class="chkSlide">
                        <span class="chkSlide_txt" id="usr_activo_txt">Activo</span>
                        <input id="usr_activo" class="usr_field" type="checkbox" disabled/>
                        <label for="usr_activo"></label>
                    </div>
                </td>
                <td> &nbsp;&nbsp;&nbsp;
                    <label>Grupo
                        <select class="usr_field" id="usr_grupo" disabled></select>
                    </label>
                </td>
            </tr>
        </table>
        <br/><br/><br/><br/>
        <table class="usr_table" border="0" align="center">
            <tr>
                <td align="left"><label>Nombres<br/><input class="usr_field" id="usr_nombres" maxlength="100" size="23" disabled/></label></td>
                <td align="left"><label>Apellido Paterno<br/><input class="usr_field" id="usr_apPat" maxlength="100" size="23" disabled/></label></td>
                <td align="left"><label>Apellido Materno<br/><input class="usr_field" id="usr_apMat" maxlength="100" size="23" disabled/></label></td>
            </tr>
            <tr>
                <td align="left"><label>Doc ID<br/><input class="usr_field" id="usr_doc" maxlength="100" size="23" disabled/></label></td>
                <td align="left"><label>Teléfonos<br/><input class="usr_field" id="usr_tel" maxlength="100" size="23" disabled/></label></td>
                <td align="left"><label>e-mail<br/><input class="usr_field" id="usr_email" maxlength="100" size="23" disabled /></label></td>
            </tr>
            <tr>
                <td align="left"><label>Dirección<br/><textarea class="usr_field" id="usr_dir" cols="23" rows="4" disabled></textarea></label></td>
                <td align="left" colspan="2"><label>Comentarios<br/><textarea class="usr_field" id="usr_coms" cols="49" rows="4" disabled></textarea></label></td>
            </tr>
            <tr>
                <td align="center" colspan="3">
                    <br/>
                    <button class="usr_field" id="btnUsrGuardar">Guardar</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <button class="usr_field btn_negativo" id="btnUsrCancelar">Cancelar</button>
                </td>
            <tr>
        </table>
    </div>

    <div id="div_footer">

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