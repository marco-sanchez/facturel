function evalLogin (usr, pass) {

    if (!(usr && pass)) {
        msgBoxJS("Debe insertar ambos datos.");
    } else {
        var login_values = {
            usuario: $.md5(usr),
            password: $.md5(pass)
        };

        $.ajax({
            url: 'php/server_functions.php',
            type: 'post',
            cache: false,
            data: {"login_values": login_values},
            success: function(resp){
                if (resp=="false") {
                    msgBoxJS("Los datos introducidos no<br>corresponden a un usuario activo.");
                } else {
                    window.location = 'main.php';
                }
            }
        });
    }
}

function msgBoxJS(msg){
    $(".message").html(msg);
    $(".cover").show();
    $(".messageBox").show();
}

function leftPanSel (elemento){
    if ($(elemento).hasClass("selected")){
        $(elemento).removeClass("selected");
    }
    else {
        $(".lp_controls ul li a").removeClass("selected");
        $(elemento).addClass("selected");
    }
}