<?php
if(!isset($_SESSION))
    session_start();
ob_start();
?>
<!DOCTYPE html>
<?php
    include (__DIR__."/php/server_functions.php");
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="css/_main.css">

        <title>FACTUREL</title>

        <script src="js/libraries/jquery-2.1.1.min.js"></script>
        <script src="js/libraries/crypt.js"></script>
        <script src="js/functions.js"></script>
        <script>
            $(document).ready(function(){
                $("#btnLogin").click(function(){
                    var usr = $('#usr').val();
                    var pass = $('#pass').val();

                    if (usr.trim() != '' && pass.trim() != '')
                        if (evalLogin ($("#usr").val(), $("#pass").val(), 'login'))
                            window.location = 'main.php';
                        else {
                            msgError(
                                "Error en Login",
                                "Los datos introducidos no corresponden a un usuario activo."
                            );
                        }
                    else {
                        msgError(
                            "Error en Login",
                            "Debe insertar ambos datos."
                        );
                    }
                });

            });
        </script
    </head>

<body>
    <div class="index_header">
        <b>SISTEMA DE FACTURACIÓN ELECTRÓNICA</b>
    </div>
    <br>
    <div class="index_body">
        <table class="login" border="0" align="center">
            <tr>
                <td align="left"><label>Usuario<br/><input id="usr" maxlength="20" size="20"/></label></td>
            </tr>
            <tr>
                <td align="left"><label>Contraseña<br/><input id="pass" maxlength="20" size="20" type="password"></label></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><button id="btnLogin">Ingresar</button></td>
            </tr>
        </table>
    </div>
    <br>
    <div class="index_foot">
        Sistema desarrollado y distribuido por: <span class="cedempre"><b>CedEmpre s.r.l.</b></span> | tel: 2-245573 | La Paz - Bolivia
    </div>

<!-- ####################### DIVS PARA MENSAJES -->
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
        <div class="msgBottom">
            <button class="btnSI">Aceptar</button>
        </div>
    </div>

</body>
</html>