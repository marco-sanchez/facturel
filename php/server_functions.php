<?php
if(!isset($_SESSION))
    session_start();

ob_start();

if(isset($_POST['login_values'])) {
    validate_user($_POST['login_values']);
}

if(isset($_POST['datos']) and isset($_POST['tabla'])) {
    guardar_datos($_POST['datos'], $_POST['tabla']);
}

function validate_user($login_values){
    $aResult = array();
    $SQL='';
    switch ($login_values['axn']){
        case 'login':
            $SQL = "SELECT * FROM usuarios WHERE usuario='" . ecrypt($login_values['usuario']) . "' AND password='" . ecrypt($login_values['password']) . "'";
        break;
        case 'chPass':
            $SQL = "SELECT * FROM usuarios WHERE usuario='" . $login_values['usuario'] . "' AND password='" . ecrypt($login_values['password']) . "'";
        break;
        case 'verify':
            $SQL = "SELECT * FROM usuarios WHERE usuario='" . $login_values['usuario'] . "' AND password='" . $login_values['password'] . "'";
        break;
    }

    $res = SQL_exec($SQL);

    if ($res && $res['activo']){
        if ($login_values['axn']=='login'){
            $_SESSION["current_user"] = $res;
        }
        session_regenerate_id(true);
        session_write_close();
        $aResult['validation'] = true;
    } else {
        $aResult['validation'] = false;
    }

    if ($login_values['axn'] != 'verify')
        echo json_encode($aResult);
    return $aResult['validation'];
}

function verify_usr(){
    if(isset($_SESSION['current_user'])) {
        $login_values = [
            'usuario' => $_SESSION['current_user']['usuario'],
            'password' => $_SESSION['current_user']['password'],
            'axn' => 'verify'
        ];

        if(!validate_user($login_values) || !$_SESSION['current_user']['activo'])
            redir("index.php");

    } else redir("index.php");
}

function openBD()
{
    // BD en LocalHost
    if (substr_count($_SERVER['HTTP_HOST'], 'localhost') > 0) {
    	$Conn = mysql_connect("localhost","root","sample");
        mysql_select_db("bdfel", $Conn);
        mysql_query("SET NAMES 'utf8'"); //para caracteres especiales del español (áé..ñ..öü)
    }

    //BD en www.marco-sanchez.com
    elseif (substr_count($_SERVER['HTTP_HOST'], 'marco-sanchez') > 0) {
        $Conn = mysql_connect("localhost","marcosan","4879907lp");
        mysql_select_db("marcosan_bdfel", $Conn);
        mysql_query("SET NAMES 'utf8'"); //para caracteres especiales del español (áé..ñ..öü)
    }

    //BD en www.marco-sanchez.com
    elseif (substr_count($_SERVER['HTTP_HOST'], '192.168.') > 0) {
        $Conn = mysql_connect("localhost","root","sample");
        mysql_select_db("bdfel", $Conn);
        mysql_query("SET NAMES 'utf8'"); //para caracteres especiales del español (áé..ñ..öü)
    }

    // URL desconocido
    else {
        msgJS ("ERROR: No hay conexión BD con el sitio ".$_SERVER['HTTP_HOST']);
        $Conn = '';
    }
    return $Conn;
}

// Cierra conección con BD /////////////////////////////////////////////////////////////////
function closeBD($Conn)
{	#	 NO quitar las llaves
    mysql_close($Conn);
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

function guardar_datos($datos, $tabla){
    if ($datos['id']) {
        foreach ($datos as $dato){
            $dato_ejemplo = $dato;
        }
    }
}