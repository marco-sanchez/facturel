function evalLogin (usr, pass) {

    if (!(usr && pass)) {
        $(".message").html("Debe insertar ambos datos.");
        $(".cover").show();
        $(".messageBox").show();
    } else {
        var login_values = {
            usuario: $.md5(usr),
            password: $.md5(pass)
        };

        $.ajax({
            url: '../php/server_functions.php',
            type: 'post',
            data: {"login_values": login_values},
            success: function(resp){
                if (resp == "false"){
                    $(".message").html("Los datos introducidos no<br>corresponden a un usuario activo.");
                    $(".cover").show();
                    $(".messageBox").show();
                }
            }
        });
    }
}