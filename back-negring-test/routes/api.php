<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/login', function (Request $request)  {
  //Leemos data desde FRONT-url
  $usuarioEncontrado= "false";
  $url = $request->fullUrl();
 
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
 
  $array = $request->all();
  $string = implode(",",$array); //Importante guardar un json y tal
  $ubicacionComa = strpos($string, ",");error_log($ubicacionComa); 
  $largo = strlen($string);error_log("Largo string");error_log($largo);
  $ctomar = $largo-$ubicacionComa-1;error_log("a");error_log($ctomar); 
  $contrasena = substr($string,$ubicacionComa+1,$ctomar); error_log($contrasena); 
  $usuario=substr($string,0,$ubicacionComa);;error_log("user");error_log($usuario); 

  //Leemos data de BD  
  $sql = "SELECT id, nombre, contrasena FROM usuario WHERE nombre={$usuario} and contrasena=$contrasena";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      //echo "id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]. "<br>";
      error_log("id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]);
    }
    $usuarioEncontrado="true";
  } else {
    echo "Usuario No encontrado";
    error_log("Usuario No encontrado");
    $usuarioEncontrado="false";

  }
  $conn->close();
  return  $usuarioEncontrado ;
});

Route::get('/getLastProducto', function (Request $request)  {
  //Leemos data desde FRONT-url
  $idNew= 0;
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
  //Leemos data de BD  
  $sql = "SELECT MAX(id) from producto";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      error_log("ENMTRO");
       $idNew=$row["MAX(id)"];
       error_log($idNew);
    }
  } else {
    echo "Usuario No encontrado";
    error_log("Usuario No encontrado");
  }
  $conn->close();
  $idNew= $idNew+1;
  error_log($idNew);
  return   $idNew;
});

Route::post('/insertarProducto', function (Request $request)  {
  error_log("POST:");
  //url
  $url = $request->fullUrl();
  $array = $request->all();
  $string = implode(",",$array); //Importante guardar un json y tal
  error_log("VALUE STRING;:");error_log($string);
  $ubicacionComa = strpos($string, ",");error_log("ubicOma");error_log($ubicacionComa);
  $largo = strlen($string);
  $ctomar = $largo-$ubicacionComa-1;
  $idX=substr($string,0,$ubicacionComa);
  error_log("IDX");error_log($idX);

  $idYExtra = substr($string,$ubicacionComa+1,$ctomar); error_log("id");error_log($idYExtra);
  $ubicacionComa = strpos($idYExtra, ",");
  $id=intval(substr($idYExtra,1,$ubicacionComa-1));error_log("id");error_log($id);

  $nombreYExtra = substr($idYExtra,$ubicacionComa+1,$ctomar); error_log("nombreYExtra");error_log($nombreYExtra);
  $ubicacionComa = strpos($nombreYExtra,",");
  $nombre=substr($nombreYExtra,0,$ubicacionComa);error_log("name");error_log( $nombre);
  
  $detalleYExtra = substr($nombreYExtra,$ubicacionComa+1,$ctomar); error_log("detalleYExtra");error_log($detalleYExtra);
  $ubicacionComa = strpos($detalleYExtra,",");
  $detalle=substr($detalleYExtra,0,$ubicacionComa);error_log("detalle");error_log($detalle);
  
  $stockYExtra = substr($detalleYExtra,$ubicacionComa+1,$ctomar); error_log("sock");error_log($stockYExtra);
  $ubicacionComa = strpos($stockYExtra, ",");
  $stock=intval(substr($stockYExtra,1,$ubicacionComa-1));error_log("stockid");error_log($stock);

  //bd
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
  //  $sql = "INSERT INTO `producto`(`id`, `nombre`, `detalle`, `stock`) VALUES ("+$id+",'"+$nombre+"','"+$detalle+"',"+$stock+")";
  $sql ="INSERT INTO `producto`(`id`, `nombre`, `detalle`, `stock`) VALUES ({$id},{$nombre},{$detalle},{$stock})";
   $result = $conn->query($sql);
  $conn->close();
  return   0;
});


















Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/ejemplo', 'App\Http\Controllers\EjemploController@index');
Route::get('/ejemplo2', 'App\Http\Controllers\Ejemplo2Controller@index');

Route::get('/loginTest', 'App\Http\Controllers\LoginTest@index');




