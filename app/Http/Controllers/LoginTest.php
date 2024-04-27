<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class LoginTest extends Controller
{
    public function index(Request $request) {
        error_log("TEST de LOGIN TEST O SI");

        //LEEMOS DATA DESDE FRONT
        $usuarioEncontrado= "false";
        $url = $request->fullUrl();
        $array = $request->all();
        $string = implode(",",$array); //Importante guardar un json y tal
        $ubicacionComa = strpos($string, ",");error_log($ubicacionComa); 
        $largo = strlen($string);error_log("Largo string");error_log($largo);
        $ctomar = $largo-$ubicacionComa-1;error_log("a");error_log($ctomar); 
        $contrasena = substr($string,$ubicacionComa+1,$ctomar); error_log($contrasena); 
        $usuario=substr($string,0,$ubicacionComa);;error_log("user");error_log($usuario); 
        error_log("usuario:");error_log($usuario);
        
        //LEEMOS DATA DESDE BD
        $dbhost = "127.0.0.1";$dbuser = "root";$dbpass = "";$dbname = "negring-test";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$dbname) or die("Connect failed: %s\n". $conn -> error);
        // $sql = "SELECT id, nombre, contrasena FROM usuario WHERE nombre={$usuario} and contrasena=$contrasena";
        // $result = $conn->query($sql);
      
        // if ($result->num_rows > 0) {
        //   // output data of each row
        //   while($row = $result->fetch_assoc()) {
        //     //echo "id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]. "<br>";
        //     error_log("id: " . $row["id"]. " - Name: " . $row["nombre"]. " " . $row["contrasena"]);
        //   }
        //   $usuarioEncontrado="true";
        // } else {
        //   echo "Usuario No encontrado";
        //   error_log("Usuario No encontrado");
        //   $usuarioEncontrado="false";
      
        // }
      
        // $conn->close();
        return  93240392490342 ;
        // return  $usuarioEncontrado ;
         
    } 
}
