<?php
if(!isset($_SESSION))
    session_start();

if(isset($_POST['login_values'])) {
    validate_user($_POST['login_values'], true);
}
 
function validate_user($usr_pass, $login = false){

    $SQL = "SELECT * FROM usuarios WHERE usuario='" . ($login? ecrypt($usr_pass['usuario']) : $usr_pass['usuario']) . "' AND password='" . ($login? ecrypt($usr_pass['password']) : $usr_pass['password']) . "'";
    $res = SQL_exec($SQL);

    if ($res && $res['activo']){
        if ($login) {
            $_SESSION["current_user"] = $res;
        }
        session_regenerate_id(true);
        session_write_close();
        return true;
    } else {
        if ($login)
            echo "false";
        else
            return false;
    }
}

function verify_usr(){
    if(isset($_SESSION['current_user'])) {
        if(!validate_user($_SESSION['current_user']) || !$_SESSION['current_user']['activo'])
            redir("/index.php");

    } else redir("/index.php");
}

function openBD()
{
    // BD en LocalHost
    if (substr_count($_SERVER['HTTP_HOST'], 'localhost') > 0) {
    	$Conexion = mysql_connect("localhost","root","sample");
        mysql_select_db("bdfel", $Conexion);
        mysql_query("SET NAMES 'utf8'"); //para caracteres especiales del español (áé..ñ..öü)
    }

    //BD en www.marco-sanchez.com
    elseif (substr_count($_SERVER['HTTP_HOST'], 'marco-sanchez.com') > 0) {
    	$Conexion = mysql_connect("localhost","root","sample");
        mysql_select_db("bdfel", $Conexion);
    }

    // URL desconocido
    else {
        msgJS ("ERROR: No hay conexión BD con el sitio ".$_SERVER['HTTP_HOST']);
        $Conexion = '';
    }
    return $Conexion;
}

// Cierra conección con BD /////////////////////////////////////////////////////////////////
function closeBD($Conexion)
{	#	 NO quitar las llaves
    mysql_close($Conexion);
}
function ecrypt($s){for($x=0;$x<=10;$x++){$s=md5(md5(md5(md5(md5($s)))));}return $s;}
// EJECUTA una consulta en MySql y retorna el resultado ////////////////////////////////////
function SQL_exec($SQL_query)
{
    $CXN = openBD();
    $res = mysql_query($SQL_query, $CXN);
    closeBD($CXN);
    return @mysql_fetch_array($res);
}

// Redirecciona con JS /////////////////////////////////////////////////////////////////////
function redir ($Pag){
    ?><script>window.location = '<?php echo $Pag?>';</script><?php
    exit();
}

function msgJS ($msg){
    ?><script>alert('<?php echo $msg?>);</script><?php
}