<?php
session_start();
?>
<!DOCTYPE html>
<?php
    include("php/server_functions.php");
    /* if(isset($_SESSION['current_user'])) {
        validate_loged_user ();
    }*/
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" type="text/css" href="css/styles.css">

        <!-- Font : Ubuntu Mono from Google Fonts -->
        <link href='http://fonts.googleapis.com/css?family=Ubuntu+Mono' rel='stylesheet' type='text/css'>

        <title>FACTUREL</title>

        <script src="/js/libraries/jquery-2.1.1.min.js"></script>
        <script src="/js/libraries/crypt.js"></script>
        <script src="/js/functions.js"></script>
        <script>
            $(document).ready(function(){
                $("#btnLogin").click(function(){
                    evalLogin ($("#usr").val(), $("#pass").val());
                });

                $("#btnCloseMB").click(function(){
                    $("#usr").val('');
                    $("#pass").val('');
                    $(".message").html('');
                    $(".messageBox").hide();
                    $(".cover").hide();
                });
            });

            $(document).keyup(function(event){
                 switch (event.keyCode) {
                     case 13:
                         $("#btnLogin").click();
                     break;
                     case 27:
                         $("#btnCloseMB").click();
                     break;
                     default:
                         // this should be used just for testing purposes
                 }
            });

        </script

    </head>

    <body>
        <div class="cover"></div>
        <div class="main_header">
            <b>SISTEMA DE FACTURACIÓN ELECTRÓNICA</b>
        </div>
        <br>
        <div class="main_body">
            <table class="login" border="0" align="center">
                <tr>
                    <td><label>Usuario: <input id="usr" maxlength="20" size="20"/></label></td>
                </tr>
                <tr>
                    <td><label>Contraseña: <input id="pass" maxlength="17" size="17" type="password"></label></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><button id="btnLogin">Ingresar</button></td>
                </tr>
            </table>
            <div class="messageBox">
                <img id='btnCloseMB' src='/img/close.png'> <br>
                <span class="message"></span>
            </div>
        </div>
        <br>
        <div class="main_foot">
            Sistema desarrollado y distibuido por: <span class="CreDes"><b>CreDes Empresarial s.r.l.</b></span> | tel: 2-245573 | La Paz - Bolivia
        </div>
    </body>
</html>