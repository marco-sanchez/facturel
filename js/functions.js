function evalLogin (ev_usr, ev_pass, ev_axn) {
    var res = false;
    var login_values = {};
    switch (ev_axn) {
        case 'login':
            login_values = {
                usuario: $.md5(ev_usr),
                password: $.md5(ev_pass),
                axn: ev_axn
            };
            break;
        case 'chPass':
            login_values = {
                usuario: ev_usr,
                password: $.md5(ev_pass),
                axn: ev_axn
            };
            break;
        default:
            alert("USR y PASS recibidos");
    }
    $.ajax({
        url: 'php/server_functions.php',
        type: 'POST',
        async: false,
        dataType: 'json',
        data: {login_values: login_values},
        success: function(resp){
            res = resp.validation;
        }
    });
    return res;
}

function msgConfirmar(titulo, texto, btnSI, btnNO, funcSI, funcNO){
    $("#cover").fadeIn(500);
    $("#msgConfirmar").fadeIn(500);
    $(".msgTl").html(titulo);
    $(".msgTxt").html(texto);
    $(".btnSI").html(btnSI);
    $(".btnNO").html(btnNO);
    $(".btnSI").off("click").click(function() {
        $("#cover").fadeOut(500);
        $("#msgConfirmar").fadeOut(500);
        funcSI();
    });
    $(".btnNO").off("click").click(function() {
        $("#cover").fadeOut(500);
        $("#msgConfirmar").fadeOut(500);
        funcNO();
    });
}

function msgError(titulo, texto){
    $("#cover").fadeIn(500);
    $("#msgError").fadeIn(500);
    $(".msgTl").html(titulo);
    $(".msgTxt").html(texto);
    $(".btnSI").off("click").click(function() {
        $("#cover").fadeOut(500);
        $("#msgError").fadeOut(500);
    });
}

function leftPanSelection (elemento){
    if ($(elemento).hasClass("selected")){
        $(elemento).removeClass("selected");
    }
    else {
        $(".lp_controls ul li a").removeClass("selected");
        $(elemento).addClass("selected");
    }
}

function guardar_datos(datos, tabla){
    if (tabla == 'usuarios' && datos['usuario']){
        datos['usuario'] = $.md5(datos['usuario']);
        datos['password'] = $.md5(datos['password']);
    }
    var resp = false;
    $.ajax({
        url: 'php/server_functions.php',
        type: 'POST',
        async: false,
        dataType: 'json',
        data: {
            datos: datos,
            tabla: tabla
        },

        success: function(res){
            resp = res;
        }
    });
    if (resp['ERROR'] != undefined) console.log(resp['ERROR']);
}

function leer_datos(tabla, ids){
    ids = ids || null;
    var resp = false;

    $.ajax({
        url: 'php/server_functions.php',
        type: 'POST',
        async: false,
        dataType: 'json',
        data: {
            tabla: tabla,
            ids: ids
        },

        success: function(res){
            resp = res;
        }
    });
    if (resp['ERROR'] != undefined){
        console.log(resp['ERROR']);
        return false
    }
    else return resp;
}

function set_defaults(){
    $("#top_usr_name").click(function(){
        window.location = 'usuario.php';
    });

    $("#ayuda").click(function(){

    });
    $("#salir").click(function(){
        //Setting exp. date of "PHP session cookie" to year zero
        document.cookie = 'PHPSESSID=; expires=Mon, 01-Jan-00 00:00:01 GMT;';
        window.location = 'index.php';
    });
}

