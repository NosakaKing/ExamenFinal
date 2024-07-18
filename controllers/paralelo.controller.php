<?php
require_once('../config/cors.php');
require_once('../models/paralelo.model.php');

$paralelo = new Paralelo();
$metodo = $_SERVER['REQUEST_METHOD'];

switch($_GET["op"]){
    //TODOS LOS REGISTROS
    case 'todos':
        $datos = $paralelo->todos();
        $todos = array();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

        case 'uno':
            if (isset($_GET["id"])) {
                $idParal = intval($_GET["id"]);
                $datos = $paralelo->uno($idParal);
                echo json_encode($datos);
            } else {
                echo json_encode(array("message" => "ID no proporcionado"));
            }
            break;
     
        case 'insertar':
            $nombreParalelo = $_POST["nombreParalelo"] ?? null;
        
            if($nombreParalelo){
                    $insertar = $paralelo->insertar($nombreParalelo);
                if($insertar==0){
                        echo json_encode(array("Mensaje" => "Registro insertado"));
                } else {
                        echo json_encode(array("Mensaje" => "Error al insertar"));
                }
            } else {
                    echo json_encode(array("Mensaje" => "Faltan datos"));
            }
            break;
    }