<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/test', function () {
    error_log('Warning para hacer console.log');
    return view('welcome');
});

Route::get('/testInsert', function () {
    error_log('Test insert');
    $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);

    $sql = "INSERT INTO `usuario`  VALUES (2, 'A','3')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    



    $conn->close();

    

    return view('welcome');


});

Route::post('/login', function (Request $request) {
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);

  $sql = "SELECT id, nombre, contrasena FROM usuario";
  $result = $conn->query($sql);

  $array = $request->all();
  $string = implode(",",$array);
  error_log($string); //Importante guardar un json y tal
  

 

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]. "<br>";
      error_log("id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]);
    }
  } else {
    echo "0 results";
  }

  $conn->close();
  return  "aaaaaaaaaaaaaaa" ;
});

Route::get('/login', function (Request $request) {
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);

  $sql = "SELECT id, nombre, contrasena FROM usuario";
  $result = $conn->query($sql);

  $array = $request->all();
  $string = implode(",",$array);
  error_log($string); //Importante guardar un json y tal
  

 

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]. "<br>";
      error_log("id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]);
    }
  } else {
    echo "0 results";
  }

  $conn->close();
  return  "aaaaaaaaaaaaaaa" ;
});

Route::get('/loginParametro', function (Request $request)  {
  $url = $request->fullUrl();
  error_log( $url );//Obtenemos la parametros de la url , con esto se vienen cositas
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);

  $sql = "SELECT id, nombre, contrasena FROM usuario";
  $result = $conn->query($sql);

  $array = $request->all();
  $string = implode(",",$array);
  error_log($string); //Importante guardar un json y tal
  

 

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]. "<br>";
      error_log("id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]);
    }
  } else {
    echo "0 results";
  }

  $conn->close();
  return  "aaaaaaaaaaaaaaa" ;
});

Route::get('/loginAux', function () {
  $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
  $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);

  $sql = "SELECT id, nombre, contrasena FROM usuario";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]. "<br>";
      error_log("id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]);
    }
  } else {
    echo "0 results";
  }

  $conn->close();
  return  $result ;
});

