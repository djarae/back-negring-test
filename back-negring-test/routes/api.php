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
    while($row = $result->fetch_assoc()) {
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

Route::get('/getLastUsuario', function (Request $request)  {
  //Leemos data desde FRONT-url
  $idNew= 0;
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
  //Leemos data de BD  
  $sql = "SELECT MAX(id) from usuario";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      error_log("Entro a obtener usuario");
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

Route::post('/insertarUsuario', function (Request $request)  {
  error_log("POST:");
  //url
  $url = $request->fullUrl();
  $array = $request->all();
  $string = implode(",",$array); //Importante guardar un json y tal
  $ubicacionComa = strpos($string, ",");
  $largo = strlen($string);
  $ctomar = $largo-$ubicacionComa-1;

  $idYExtra = substr($string,$ubicacionComa+1,$ctomar); error_log("idyextra");error_log($idYExtra);
  $ubicacionComa = strpos($idYExtra, ",");
  $id=intval(substr($idYExtra,1,$ubicacionComa-1));error_log("id");error_log($id);

  $usuarioYExtra = substr($idYExtra,$ubicacionComa+1,$ctomar); error_log("usuarioYExtra");error_log($usuarioYExtra);
  $ubicacionComa = strpos($usuarioYExtra,",");
  $usuario=substr($usuarioYExtra,0,$ubicacionComa);error_log("name");error_log($usuario);
  
  $correoYExtra = substr($usuarioYExtra,$ubicacionComa+1,$ctomar); error_log("correoYExtra");error_log($correoYExtra);
  $ubicacionComa = strpos($correoYExtra,",");
  $correo=substr($correoYExtra,0,$ubicacionComa);error_log("correo");error_log($correo);
  
  $cargoYExtra = substr($correoYExtra,$ubicacionComa+1,$ctomar); error_log("cargo y extr");error_log($cargoYExtra);
  $ubicacionComa = strpos($cargoYExtra, ",");error_log("ubicComa");error_log($ubicacionComa);
  $cargo=substr($cargoYExtra,0,$ubicacionComa);error_log("cargoid");error_log($cargo);

  $largo=(strlen($cargoYExtra))- ($ubicacionComa)-1 ;
  $contrasena=substr($cargoYExtra,$ubicacionComa+1,$largo);error_log("cont");error_log($contrasena);

  //bd
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
  $sql ="INSERT INTO `usuario`(`id`, `nombre`, `correo`, `cargo`, `contrasena`,`visibilidad`) VALUES ({$id},{$usuario},{$correo},{$cargo},{$contrasena},0)";
   $result = $conn->query($sql);
  $conn->close();
  return   0;
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

Route::get('/getDetailProducto', function (Request $request)  {
  //URL
  error_log("entro a get detalle");
  $url = $request->fullUrl();
  $array = $request->all();
  $string = implode(",",$array); error_log("sring:");error_log($string);
  $id=intval(substr(  $string,1, strlen($string)-1));error_log("id final");error_log($id);

  //BD
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
  $sql="SELECT * FROM producto WHERE  `id`={$id}";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $datax =array(); 
    while($row = $result->fetch_assoc()) {
        array_push($datax, array('detalle'=> $row['detalle']));
    }
    } else {
      error_log("Error");
    }

    $conn->close();
    error_log( json_encode($datax) );
    return Response::json(array('datax' => $datax));
  
});

Route::get('/getListadoProductos', function (Request $request)  {
  //Leemos data desde FRONT-url
  $url = $request->fullUrl();
  $array = $request->all();

  $string = implode(",",$array);error_log("string");error_log($string); //Importante guardar un json y tal
  $ubicacionComa = strpos($string, ",");
  $largo = strlen($string);
  $ctomar = $largo-$ubicacionComa-1;

  $nombreAux = substr($string,1,$ubicacionComa-2);                error_log("nombreAuxasas");error_log($nombreAux);      
  
  $stockAuxCortado=substr($string,$ubicacionComa+2,$largo-$ubicacionComa-3); error_log("StockAUXCORTADO VALUE:");error_log($stockAuxCortado)  ;
  $ubicacionComa = strpos($stockAuxCortado, ",");
  $largo = strlen($stockAuxCortado);
  $ctomar = $largo-$ubicacionComa-1;

  $stockAux=substr($stockAuxCortado,0,$ubicacionComa-1);error_log("STOCK VALUE:");error_log($stockAux); 

  $paginacionAux=substr($stockAuxCortado,$ubicacionComa+2,$largo-$ubicacionComa-2);error_log("phginacion:");error_log($paginacionAux); 





  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
 
  //Leemos data de BD  
  //nombre
  if ($nombreAux=="'" or $nombreAux==""){
    $nombreAux="nombre";
  }
  else{
    $nombreAux="'%{$nombreAux}%'";
  };

  //stock
  if ($stockAux=="'" or $stockAux==""){
    $stockAux="stock";
  }
  else{
  $stockAux="'%{$stockAux}%'";
  };
  $sql= "SELECT * FROM `producto` WHERE nombre LIKE {$nombreAux} and stock LIKE {$stockAux} and visibilidad=0";
  

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $datax =array(); 
    $count = 0;
    $i=0;
    $paginacionInicio=(($paginacionAux-1)*10);
    // error_log("pag inicio");error_log($paginacionInicio);
    $paginacionFinal=(($paginacionAux)*10);
    // error_log("pag fin");error_log($paginacionFinal);

    while($row = $result->fetch_assoc()) {
      if (($i>($paginacionInicio-1)) and ($i<$paginacionFinal)){
        $count=  $count+1;
        array_push($datax, array('id' => $row['id'],'nombre'=> $row['nombre'],'detalle'=> $row['detalle'],'stock'=> $row['stock'], 'count'=> $count));
      };
      $i=$i+1;
    }
    } else {
      error_log("Error");
    }
  $conn->close();
  error_log( json_encode($datax) );
  
  return Response::json(array('datax' => $datax));

});

Route::post('/insertarProducto', function (Request $request)  {
  error_log("POST:");
  //url
  $url = $request->fullUrl();
  $array = $request->all();
  $string = implode(",",$array); //Importante guardar un json y tal
  $ubicacionComa = strpos($string, ",");
  $largo = strlen($string);
  $ctomar = $largo-$ubicacionComa-1;

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

Route::put('/updateProducto', function (Request $request)  {
  //url
  error_log("entro a update");
  $url = $request->fullUrl();
  $array = $request->all();
  $string = implode(",",$array); 
  $ubicacionComa = strpos($string, ",");
  $largo = strlen($string);
  $ctomar = $largo-$ubicacionComa-1;

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

  //Reemplazamos data si es que esta vacía:
  if ($nombre=="") {$nombre="`nombre`";}
  if ($detalle=="") {$detalle="`detalle`";}
  if ($stock=="") {$stock="`stock`";}

  //bd
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
  // $sql ="INSERT INTO `producto`(`id`, `nombre`, `detalle`, `stock`) VALUES ({$id},{$nombre},{$detalle},{$stock})";
  $sql="UPDATE `producto` SET `nombre`={$nombre},`detalle`={$detalle},`stock`={$stock} WHERE id={$id}";
  $result = $conn->query($sql);
  $conn->close();
  return   0;
});

Route::put('/deleteProducto', function (Request $request)  {
  //url
  error_log("entro a deleted");
  $url = $request->fullUrl();
  $array = $request->all();
  $string = implode(",",$array); 
  $ubicacionComa = strpos($string, ",");
  $largo = strlen($string);
  $ctomar = $largo-$ubicacionComa-1;

  $idYExtra = substr($string,$ubicacionComa+1,$ctomar); error_log("id");error_log($idYExtra);
  $ubicacionComa = strpos($idYExtra, ",");
  $id=intval(substr($idYExtra,1,$ubicacionComa-1));error_log("id");error_log($id);

  //bd
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
  $sql="UPDATE `producto` SET `visibilidad`=1 WHERE id={$id}";
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




