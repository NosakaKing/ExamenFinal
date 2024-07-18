<?php
require_once('../config/cors.php');
require_once('../models/curso.model.php');

$curso = new Curso();
$metodo = $_SERVER['REQUEST_METHOD'];

switch($_GET["op"]){

        //TODOS LOS REGISTROS
    case 'todos':
        $datos = $curso->todos();
        $todos = array();
        while($row = mysqli_fetch_assoc($datos)){
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;
        
         // UN REGISTRO
    case 'uno':
        if (isset($_GET["id"])) {
            $idCurso = intval($_GET["id"]);
            $datos = $curso->uno($idCurso);
            echo json_encode($datos);
        } else {
            echo json_encode(array("message" => "ID no proporcionado"));
        }
        break;

    case 'insertar':
        $idProfesor = $_POST["idProfesor"] ?? null;
        $idParalelo = $_POST["idParalelo"] ?? null;
        $idEspecialidad = $_POST["idEspecialidad"] ?? null;
        $nombreCurso = $_POST["nombreCurso"] ?? null;
        $descripcionCurso = $_POST["descripcionCurso"] ?? null;
        $fechaInicio = $_POST["fechaInicio"] ?? null;
        $fechaFin = $_POST["fechaFin"] ?? null;
    
        if($idParalelo && $idEspecialidad && $nombreCurso && $descripcionCurso && $fechaInicio && $fechaFin){
                $insertar = $curso->insertar($idProfesor, $idEspecialidad, $idParalelo, $nombreCurso, $descripcionCurso, $fechaInicio, $fechaFin);
            if($insertar==0){
                    echo json_encode(array("Mensaje" => "Registro insertado"));
            } else {
                    echo json_encode(array("Mensaje" => "Error al insertar"));
            }
        } else {
                echo json_encode(array("Mensaje" => "Faltan datos"));
        }
        break;
      
 // ELIMINAR
 case 'eliminar':
    if(isset($_POST["id"])){
        $id = $_POST["id"];
        $eliminar = $curso->eliminar($id);
        if($eliminar){
            echo json_encode(array("Mensaje" => "Registro eliminado"));
        } else {
            echo json_encode(array("Mensaje" => "Error al eliminar"));
        }
    } else {
        echo json_encode(array("Mensaje" => "Falta el ID"));
    }
    break;
}