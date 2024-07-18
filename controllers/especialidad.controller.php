<?php
require_once('../config/cors.php');
require_once('../models/especialidad.model.php');

$especialidad = new Especialidad();
$metodo = $_SERVER['REQUEST_METHOD'];

switch($_GET["op"]){
    //TODOS LOS REGISTROS
    case 'todos':
        $datos = $especialidad->todos();
        $todos = array();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

        case 'uno':
            if (isset($_GET["id"])) {
                $idEspe = intval($_GET["id"]);
                $datos = $especialidad->uno($idEspe);
                echo json_encode($datos);
            } else {
                echo json_encode(array("message" => "ID no proporcionado"));
            }
            break;
     
        case 'insertar':
            $nombreEspecialidad = $_POST["nombreEspecialidad"] ?? null;
            $descripcionEspecialidad = $_POST["descripcionEspecialidad"] ?? null;
        
            if($nombreEspecialidad && $descripcionEspecialidad){
                    $insertar = $especialidad->insertar($nombreEspecialidad, $descripcionEspecialidad);
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