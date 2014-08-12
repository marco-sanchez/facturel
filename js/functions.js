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

function msgBoxJS(msgTxt, msgElement){
    $(".cover").fadeIn(500);
    $(".message").html(msgTxt);
    msgElement.fadeIn(500);
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
    $.ajax({
        url: 'php/server_functions.php',
        type: 'POST',
        async: false,
        dataType: 'json',
        data: {
            datos: datos,
            tabla: tabla
        },
        success: function(resp){
            return true;
        }
    });
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
        success: function(response){
            resp = response;
        }
    });
    return resp;
}