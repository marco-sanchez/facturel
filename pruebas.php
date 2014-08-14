<!DOCTYPE html>
<html>
<head>
    <title>PRUEBAS</title>
    <meta charset="UTF-8"/>
    <script src="js/_main.js"></script>
    <style>
        html{
            height: 100%;
        }

        body {
            height: 95%;

            font-family: "Lucida Console", Monaco, monospace;
            font-size: 20px;

            color: white;

            background-color: rgb(40, 40, 40);
        }

        .msgBox{
            /* CENTER DIV IN SCREEN
            margin-left = -(width / 2);
            margin-top: = -(height / 2); */
            position: absolute;
            top: 20%;
            left: 50%;
            width: 300px;
            height: 200px;
            margin-left: -150px;
            /************************/

            display: none;
            color:black;
            background-color: lightgray;
            border-radius: 10px;
            padding: 10px;
        }

        .msgTop{
            position: absolute;
            left:0;
            top: 0;
            width: 94%;
            text-align: left;
            padding: 10px;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .msgTxt{
            position: absolute;
            top: 20%;
        }

        .msgBottom{
            position: absolute;
            left:0;
            bottom: 0;
            width: 94%;
            text-align: right;
            padding: 10px;
            color: white;
            font-size: 15px;
            font-weight: normal;
        }

        #msgConfirmar{
            border: solid 5px #dd7f00;
        }
        #msgConfirmar .msgTop, #msgConfirmar .msgBottom{
            background-color: #dd7f00;
        }

        #msgError{
            border: solid 5px darkred;
        }

        #msgError .msgTop, #msgError .msgBottom{
            background-color: darkred;
        }

    </style>
    <script>
        $(document).ready(function(){
            $("#btnPruebaConfirmar").click(function() {
                msgConfirmar(
                    "Mi Título de Confirmar",
                    "Esto es<br/>un ejemplo de Confirmar",
                    "Aceptar",
                    "Cancelar",
                    function(){
                        alert("presionaste SI");
                    },
                    function(){
                        alert("presionaste NO");
                    }
                );
            });

            $("#btnPruebaError").click(function() {
                msgError(
                    "Mi Título de ERROR",
                    "Esto es<br/>un ejemplo de Error"
                );
            });
        });

        function msgConfirmar(titulo, texto, btnSI, btnNO, funcSI, funcNO){
            $("#msgError").hide();
            $("#msgConfirmar").show();
            $(".msgTl").html(titulo);
            $(".msgTxt").html(texto);
            $(".btnSI").html(btnSI);
            $(".btnNO").html(btnNO);
            $(".btnSI").off("click").click(function() {
                $(".msgBox").hide();
                funcSI();
            });
            $(".btnNO").off("click").click(function() {
                $(".msgBox").hide();
                funcNO();
            });
        }

        function msgError(titulo, texto){
            $("#msgError").show();
            $("#msgConfirmar").hide();
            $(".msgTl").html(titulo);
            $(".msgTxt").html(texto);
            $(".btnSI").off("click").click(function() {
                $(".msgBox").hide();
            });
        }

    </script>
</head>

<body>
<div class="central">
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
</div>

<button id="btnPruebaConfirmar">Prueba Confirmar</button>
<button id="btnPruebaError">Prueba Error</button>

</body>
</html>