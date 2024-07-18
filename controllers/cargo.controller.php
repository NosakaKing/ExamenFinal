<?php
require_once('../config/cors.php');
require_once('../models/cargo.model.php');

$cargo = new Cargo();
$metodo = $_SERVER['REQUEST_METHOD'];

switch($_GET["op"]){
    //TODOS LOS REGISTROS
    case 'todos':
        $datos = $cargo->todos();
        $todos = array();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

        case 'uno':
            if (isset($_GET["id"])) {
                $idCargo = intval($_GET["id"]);
                $datos = $cargo->uno($idCargo);
                echo json_encode($datos);
            } else {
                echo json_encode(array("message" => "ID no proporcionado"));
            }
            break;
     
        case 'insertar':
            $nombreCargo = $_POST["nombreCargo"] ?? null;
        
            if($nombreCargo){
                    $insertar = $cargo->insertar($nombreCargo);
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