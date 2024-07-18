<?php
require_once('../config/cors.php');
require_once('../models/estudiante.model.php');

$estudiante = new Estudiante();
$metodo = $_SERVER['REQUEST_METHOD'];

switch($_GET["op"]){
    //TODOS LOS REGISTROS
    case 'todos':
        $datos = $estudiante->todos();
        $todos = array();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    // UN REGISTRO
    case 'uno':
        if (isset($_GET["id"])) {
            $idEstudiante = intval($_GET["id"]);
            $datos = $estudiante->uno($idEstudiante);
            echo json_encode($datos);
        } else {
            echo json_encode(array("message" => "ID no proporcionado"));
        }
        break;

    // INSERTAR
    case 'insertar':
        $identificacion = $_POST["identificacion"] ?? null;
        $tipoIdentificacion = $_POST["tipo_identificacion"] ?? null;
        $nombre = $_POST["nombre"] ?? null;
        $primerApellido = $_POST["primer_apellido"] ?? null;
        $segundoApellido = $_POST["segundo_apellido"] ?? null;
        $fechaNacimiento = $_POST["fecha_nacimiento"] ?? null;
        $telefono = $_POST["telefono"] ?? null;
        $direccion = $_POST["direccion"] ?? null;
        $correo = $_POST["correo"] ?? null;
       

        if($identificacion && $tipoIdentificacion && $nombre && $primerApellido && $segundoApellido && $fechaNacimiento && $telefono && $direccion && $correo){
            $insertar = $estudiante->insertar($identificacion , $tipoIdentificacion, $nombre, $primerApellido, $segundoApellido, $fechaNacimiento, $telefono, $direccion, $correo);
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
        $id = $_POST["idEstudiante"] ?? null;
        $identificacion = $_POST["identificacion"] ?? null;
        $tipoIdentificacion = $_POST["tipo_identificacion"] ?? null;
        $nombre = $_POST["nombre"] ?? null;
        $primerApellido = $_POST["primer_apellido"] ?? null;
        $segundoApellido = $_POST["segundo_apellido"] ?? null;
        $fechaNacimiento = $_POST["fecha_nacimiento"] ?? null;
        $telefono = $_POST["telefono"] ?? null;
        $direccion = $_POST["direccion"] ?? null;
        $correo = $_POST["correo"] ?? null;
        if($identificacion && $tipoIdentificacion && $nombre && $primerApellido && $segundoApellido && $fechaNacimiento && $telefono && $direccion && $correo){
            $actualizar = $estudiante->actualizar($id, $identificacion , $tipoIdentificacion, $nombre, $primerApellido, $segundoApellido, $fechaNacimiento, $telefono, $direccion, $correo);
            if($actualizar){
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
            $eliminar = $estudiante->eliminar($id);
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

