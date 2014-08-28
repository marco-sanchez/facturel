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

if(isset($_POST['tabla']) and isset($_POST['ids'])) {
    leer_datos($_POST['tabla'], $_POST['ids']);
}

function validate_user($login_values){
    $resultArray = array();
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
        $_SESSION["current_user"] = $res;
        session_regenerate_id(true);
        session_write_close();
        $resultArray['validation'] = true;
    } else {
        $resultArray['validation'] = false;
    }

    if ($login_values['axn'] != 'verify')
        echo json_encode($resultArray);
    return $resultArray['validation'];
}

function verify_usr(){
    if(isset($_SESSION['current_user']) && $_SESSION['current_user']['activo']) {
        $login_values = [
            'usuario' => $_SESSION['current_user']['usuario'],
            'password' => $_SESSION['current_user']['password'],
            'axn' => 'verify'
        ];

        if(!validate_user($login_values))
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
        echo ("ERROR: No existen parámetros de conexión para: ".$_SERVER['HTTP_HOST']);
        $Conn = '';
    }

    if (!$Conn) {
        die('Error al conectar con Base de Datos: ' . mysql_error());
    }

    return $Conn;
}

// Cierra conexión con BD /////////////////////////////////////////////////////////////////
function closeBD($Conn)
{	#	 NO quitar las llaves
    mysql_close($Conn);
}
function ecrypt($s){for($x=0;$x<=10;$x++){$s=md5(md5(md5(md5(md5($s)))));}return $s;}
// EJECUTA una consulta en MySql y retorna el resultado ////////////////////////////////////
function SQL_exec($sql)
{
    $CNX = openBD();
    $resultArray = array();
    $result = mysql_query($sql);
    if ($result){
        while ($row = mysql_fetch_assoc($result)) {
            array_push($resultArray, $row);
        }
        closeBD($CNX);

        // Si solo hay un registro, devolver solo datos
        // y NO un array dentro de otro array
        if (count($resultArray) > 1){
            return $resultArray;
        }else{
            return $resultArray[0];
        }
    } else {
        $resultArray['ERROR'] = "ERROR: SQL query inválido: ". $sql;
        return $resultArray;
    }
}

// Redirecciona con JS /////////////////////////////////////////////////////////////////////
function redir ($Pag){
    ?><script>window.location = '<?php echo $Pag?>';</script><?php
    exit();
}

function msgJS ($msg){
    echo "<script>alert('".$msg."');</script>";
}

function guardar_datos($datos, $tabla){
    if ($tabla == 'usuarios' && $datos['usuario']){
        $datos['usuario'] = ecrypt($datos['usuario']);
        $datos['password'] = ecrypt($datos['password']);
    }
    $keys = array_keys($datos);
    $i = 0;
    if (isset ($datos['id'])) { # IF TRUE: Editar registro existente
        foreach ($datos as $dato){
            if ($i > 0){
                $SQL = "UPDATE ".$tabla." SET ".$keys[$i]." = '".$dato."', fecha_cambio = '".date("Y-m-d H:i:s")."', uid = '".$datos['uid']."' WHERE id = ".$datos['id'];
                SQL_exec($SQL);
                $sqlRes = SQL_exec($SQL);
                echo json_encode($sqlRes);
            }
            $i++;
        }
    } else { # IF FALSE: Insertar nuevo registro
        $cols = "";
        foreach ($keys as $col){
            if ($i == 0) $cols = $col;
            else $cols .= " ,".$col;
            $i++;
        }
        $i = 0;
        $vals = "";
        foreach ($datos as $dato){
            if ($i == 0) $vals = $dato;
            else $vals .= " ,".$dato;
            $i++;
        }

        $SQL = "INSERT INTO ".$tabla." (".$cols.") VALUES (".$vals.")";
        $sqlRes = SQL_exec($SQL);
        echo json_encode($sqlRes);
    }
}

function leer_datos($tabla, $ids){
    if ($ids) {
        if (gettype($ids) == "array"){
            $SQL = "";
            $i = 0;
            foreach ($ids as $id){
                if ($i == 0) $SQL = "SELECT * FROM ".$tabla." WHERE id = ".(int) $ids[$id];
                else $SQL .= " OR id = ".(int) $ids[$id];
                $i++;
            }
        } else $SQL = "SELECT * FROM ".$tabla." WHERE id= ".(int) $ids;
    } else $SQL = "SELECT * FROM ".$tabla;

    $sqlRes = SQL_exec($SQL);
    echo json_encode($sqlRes);
    return $sqlRes;
}