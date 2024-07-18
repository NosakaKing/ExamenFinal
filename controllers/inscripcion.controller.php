<?php
require_once('../config/cors.php');
require_once('../models/inscripcion.model.php');

$inscripcion = new Inscripcion();
$metodo = $_SERVER['REQUEST_METHOD'];

switch($_GET["op"]){
    //TODOS LOS REGISTROS
    case 'todos':
        $datos = $inscripcion->todos();
        $todos = array();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    // UN REGISTRO
    case 'uno':
        if (isset($_GET["id"])) {
            $idInscripcion = intval($_GET["id"]);
            $datos = $inscripcion->uno($idInscripcion);
            echo json_encode($datos);
        } else {
            echo json_encode(array("message" => "ID no proporcionado"));
        }
        break;

    // INSERTAR
    case 'insertar':
        $curso = $_POST["curso"] ?? null;
        $estudiante = $_POST["estudiante"] ?? null;
        $fechaInscripcion = $_POST["fecha_inscripcion"] ?? null;
       
        if($curso && $estudiante && $fechaInscripcion){
            $insertar = $inscripcion->insertar($curso, $estudiante, $fechaInscripcion);
            if($insertar==0){
                echo json_encode(array("Mensaje" => "Registro insertado"));
            } else {
                echo json_encode(array("Mensaje" => "Error al insertar"));
            }
        } else {
            echo json_encode(array("Mensaje" => "Faltan datos"));
        }
        break;

        // ACTUALIZAR
    case 'actualizar':
        $id = $_POST["idInscripcion"] ?? null;
        $curso = $_POST["curso"] ?? null;
        $estudiante = $_POST["estudiante"] ?? null;
        $fechaInscripcion = $_POST["fecha_inscripcion"] ?? null;
        
        if($id && $curso && $estudiante && $fechaInscripcion){
            $actualizar = $inscripcion->actualizar($id, $curso, $estudiante, $fechaInscripcion);
            if($actualizar==0){
                echo json_encode(array("Mensaje" => "Registro actualizado"));
            } else {
                echo json_encode(array("Mensaje" => "Error al actualizar"));
            }
        } else {
            echo json_encode(array("Mensaje" => "Faltan datos"));
        }
        break;

        // ELIMINAR
        case 'eliminar':
            if(isset($_POST["id"])){
                $id = $_POST["id"];
                $eliminar = $inscripcion->eliminar($id);
                if($eliminar){
                    echo json_encode(array("Mensaje" => "Registro eliminado"));
                } else {
                    echo json_encode(array("Mensaje" => "Error al eliminar"));
                }
            } else {
                echo json_encode(array("Mensaje" => "Falta el ID"));
            }
            break;
        
        default:
            echo json_encode(array("Mensaje" => "Falta la operación"));
        break;
}